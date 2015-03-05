<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenidos_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Contenidos_model');
		$this->load->model('Categorias_model');
		$this->load->model('Idiomas_model');
		$this->load->model('Categoria_Idioma_model');
	}
	//----------------- INDEX
	public function index()
	{

		$data['main_content'] = 'admin/contenidos_view';
		$this->load->view('admin/contenidos_view');

	}

	public function get_model () {

		header ('Content-type: application/json; charset=utf-8');

		$categorias = $this->Categorias_model->get_categoriasAsArray_v2();
		$idiomas = $this->Idiomas_model->get_idiomasAsArray();
		//modelo base
		$result = array(
					'list_categoria' => array() ,
					'list_idioma' => array() ,
					'new_categoria' => array() ,
					'new_contenido' => array()
		);
		//1er paso -> get/set listado de categorias
		foreach($categorias as $categoria) {

			$idiomas_fiter = array();
			$traducciones = $this->Categoria_Idioma_model->get_CategoriaIdiomaByIdAsArray($categoria['PK_Categoria']);

			array_push($result['list_categoria'], array(
		    	'PK_Categoria' => $categoria['PK_Categoria'],
		    	'Clave' => $categoria['Clave'],
		    	'list_idioma' => $traducciones
			));

		}
		//2do paso -> get/set listado de idiomas
		foreach($idiomas as $idioma) {

			array_push($result['list_idioma'], array(
				'FK_Idioma' => $idioma['PK_Idioma'] ,
				    'Clave' => $idioma['Clave'] ,
				   'Nombre' => $idioma['Nombre']
				)
			);

		}
		//3er paso -> set default ite usando listado de idiomas de 2do paso
		$result['new_categoria']  = array(

					'PK_Categoria' => 0 ,
					'Clave' => '' ,
					'list_idioma' => $result['list_idioma']
				);	/**/
		//4to paso -> set default item contenido
		$result['new_contenido']  = array(

					'PK_Contenido' => 0 ,
					'Clave' => '' ,
					'list_idioma' => $result['list_idioma']

				);

		echo json_encode($result);

	}

	public function get_contenidos_traducciones(){
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Contenidos_model->get_view_contenidos_traducciones_AsArray());
	}

	public function get_archivosById() {
		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => $this->Contenidos_model->get_archivosById_AsArray(array('FK_Idioma' => $data['PK_Idioma'],'FK_Contenido'=>$data['PK_Contenido'])),
			'data' => $data,
			'errors' => array()
		);
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}
	//INSERT
	public function save_contenido(){

		$data = json_decode(file_get_contents('php://input'), true);
		$arr = array();
		$PK_Contenido = (isset($data['PK_Contenido']))?$data['PK_Contenido']:NULL;
		$PK_Categoria = $data['PK_Categoria'];
		$Clave = $data['Clave'];
		$list_idioma = $data['list_idioma'];
		$IsInsert = (!isset($data['PK_Contenido']) || $data['PK_Contenido'] == 0);

		$arr = array(
			'result' => array(
				'PK_Contenido' => $PK_Contenido,
				'PK_Categoria' => $PK_Categoria
			),
			'Contenido_Categoria' => array(),
			'Traduccion' => array(),
			'errors' => array(),
			'op_contenido' => false,
			'op_contenido_categoria' => false,
			'op_traduccion' => false,
			'op' => false
		);

		// --- 1ER INSERT -> Contenido
		try {
		    $arr['result']['PK_Contenido'] =
		    	( $IsInsert )
		    	? $this->Contenidos_model->insert_contenido($PK_Contenido)
					: $data['PK_Contenido'];

			$arr['op_contenido'] = (isset($arr['result']['PK_Contenido']))?true:false;

		} catch (Exception $e) {
			array_push( $arr['errors'] , $e->getMessage() );
			throw $e;
		}
		// --- 2DO INSERT -> Contenido_Categoria
		try {

		    if($arr['op_contenido'] && isset($data['PK_Categoria'])){

	    	$Contenido_CategoriaArr = array();
				array_push($Contenido_CategoriaArr, array(
			    	'FK_Contenido' => (string)$arr['result']['PK_Contenido'] ,
			    	'FK_Categoria' => (string)$data['PK_Categoria']
				));

				$arr['Contenido_Categoria'] = $Contenido_CategoriaArr;

	    	$arr['op_contenido_categoria'] =
	    		( $IsInsert )
	    		?$this->Contenidos_model->insert_contenido_categoria($Contenido_CategoriaArr)
					:TRUE;

		    } else {
				//delete categoria 1er insert
			}

		} catch (Exception $e) {
			array_push( $arr['errors'] , $e->getMessage() );
			throw $e;
		}
		// --- 3ER INSERT -> Traduccion
		try{

			$TraduccionArr = array();
			foreach ($list_idioma as $idioma) {

				if(isset($idioma['titulo']) && $idioma['titulo'] != "" && strlen($idioma['titulo']) > 0) {

					array_push($TraduccionArr, array(
				    	'FK_Idioma' => $idioma['FK_Idioma'] ,
				    	'FK_Contenido' => $arr['result']['PK_Contenido'] ,
				    	'Titulo' => $idioma['titulo'] ,
				    	'Traduccion' => $idioma['traduccion']
					));

				}

			};

			if(count($TraduccionArr)>0 ) {

				$arr['op'] = $arr['op_traduccion']  =
					( $IsInsert )
					?$this->Contenidos_model->insert_traduccion($TraduccionArr)
					:$this->Contenidos_model->update_traduccion($TraduccionArr ,$data['PK_Contenido'])
					;

				if($arr['op']){
					//$arr['Traduccion'] = json_encode($this->Contenidos_model->get_view_contenidos_traducciones_byId_AsArray($arr['result']));
					$arr['Traduccion'] = $this->Contenidos_model->get_view_contenidos_traducciones_byId_AsArray($arr['result']);
				}

				//$arr['Traduccion'] = $TraduccionArr;

			} else {
				//Delete Categoria @1ER-Insert
			}

		} catch (Exception $e) {
			array_push( $arr['errors'] , $e->getMessage() );
			throw $e;
		}

		echo json_encode($arr);

	}

	public function delete_contenido(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => array(
				'PK_Contenido' => $data
			),
			'errors' => array(),
		);

		$arr['op']= $this->Contenidos_model->delete_contenido($data);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}

	public function upload()
	{
		$FK_Contenido = $this->input->post('FK_Contenido');
		$FK_Idioma = $this->input->post('FK_Idioma');
		$Descripcion = $this->input->post('Descripcion');

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'mp3';
		$config['max_size']	= '200000';//200000KB:20MB
		$config['encrypt_name']  = true;


		$this->load->library('upload', $config);


		if ( !$this->upload->do_upload('file') )
		{
			$arr = array(
				'op' => false ,
				'msg' => $this->upload->display_errors() ,
				'PK_Contenido' => $FK_Contenido ,
				'FK_Idioma' => $FK_Idioma ,
			);
		}
		else
		{
			$file_array = $this->upload->data('file_name');

			$arr = array(
				'msg' => $this->upload->data() ,
				'PK_Contenido' => $FK_Contenido ,
				'FK_Idioma' => $FK_Idioma ,
				'File_Name' => $file_array['file_name'],
				'Descripcion' => $Descripcion
			);

			$arr['op'] = $this->Contenidos_model->insert_file($arr);
		}
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}

}

/* End of file contenidos_controller.php */
/* Location: ./application/controllers/contenidos_controller.php */

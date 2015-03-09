<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categorias_model');
		$this->load->model('Idiomas_model');
		$this->load->model('Categoria_Idioma_model');

		$this->load->library('table');
	}
	//----------------- INDEX v2
	public function index()
	{

		$data['main_content'] = 'admin/categorias_view';
		//$data['categorias'] = $this->Categorias_model->get_categorias();

		//$this->load->view('templates/adminpanel',$data);
		$this->load->view('admin/categorias_view');
	}

	//SELECT
	public function get_categorias_list () {

		header ('Content-type: application/json; charset=utf-8');

		$categorias = $this->Categorias_model->get_categoriasAsArray_v2();
		$idiomas = $this->Idiomas_model->get_idiomasAsArray();
		//modelo base
		$result = array(
					'list_categoria' => array() ,
					'list_idioma' => array() ,
					'new_categoria' => array()
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
				);

		echo json_encode($result);

	}

	//INSERT
	public function save_categorias(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array();

		$PK_Categoria = $data['PK_Categoria'];
		$Clave = $data['Clave'];
		$list_idioma = $data['list_idioma'];

		$arr = array(
			'categoria' => array(
				'Clave' => $data['Clave']
			),

			'errors' => array(),
			'op' => false
		);
		// --- 1ER INSERT : CATEGORIA
		$arr['categoria']['PK_Categoria'] =
			( $data['PK_Categoria'] == 0 )
				? $this->Categorias_model->insert_categoriav2($arr['categoria'])
				: $this->Categorias_model->edit_categoriav2($arr['categoria'] , $data['PK_Categoria'])
				;
		// --- 2DO INSERT : CATEGORIA_IDIOMA
		$idiomasArr = array();
		foreach ($list_idioma as $idioma) {

			array_push($idiomasArr, array(
		    	'FK_Categoria' => $arr['categoria']['PK_Categoria'] ,
		    	'FK_Idioma' => $idioma['FK_Idioma'] ,
		    	'Label' => (isset($idioma['Label']) && $idioma['Label'] != '')?$idioma['Label']:""
			));

		};

		if(count($idiomasArr)>0 ) {
			$arr['op']  =
			( $data['PK_Categoria'] == 0 )
				? $this->Categorias_model->insert_categoriaIdioma($idiomasArr)
				: $this->Categorias_model->update_categoriaIdioma($idiomasArr, $data['PK_Categoria'])
				;

			$arr['categoria']['list_idioma']  = $list_idioma;

		} else {
			//Delete Categoria @1ER-Insert
		}

		echo json_encode($arr);
	}

	//DELETE v2
	public function delete_categoria(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => array(
				'PK_Categoria' => $data['PK_Categoria']
			),
			'datax' => $data ,
			'errors' => array(),
		);

		$arr['op']= $this->Categorias_model->delete_categoriav2($data['PK_Categoria']);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}
	//------------------------------------------------------

	//SELECT ID
	public function get_categoria() {
		$data = json_decode(file_get_contents('php://input'), true);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Categorias_model->get_categoriaAsArray($data));

	}

	//DELETE
	/*public function delete_categoria(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => array(
				'PK_IdCategoria' => $data
			),
			'errors' => array(),
		);

		$arr['op']= $this->Categorias_model->delete_categoria($data);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}*/

}

/* End of file admin_controller.php */
/* Location: ./application/controllers/admin_controller.php */

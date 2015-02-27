<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->library('table');
	}

	public function index()
	{
		$data['main_content'] = 'admin/usuario_view';
		$this->load->view('admin/usuario_view');
	}

	//SELECT
	public function get_usuarios(){
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Usuario_model->get_UsuarioAsArray());
	}

	//SELECT ID
	public function get_usuario() {
		$data = json_decode(file_get_contents('php://input'), true);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Usuario_model->get_UsuarioAsArray($data));

	}

	//SELECT CATEGORIAS BY ID DE USUARIO
	public function get_categorias_usuario() {
		$data = json_decode(file_get_contents('php://input'), true);
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Usuario_model->get_CategoriaUsuarioByIdAsArray($data));

	}

	//INSERT
	public function save_usuario(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => array(
				'UserName' => $data['UserName'] ,
				'Email' => $data['Email'] ,
				'Telefono' => isset($data['Telefono']) ? $data['Telefono'] : '',
				'EsAdmin' =>  isset($data['EsAdmin']) ? $data['EsAdmin'] : 'false',
				'Password' => $data['Password'] ,
				'UsuarioActivo' => isset($data['UsuarioActivo']) ? $data['UsuarioActivo'] : 'false',
			),
			'errors' => array(),
			'op' => true
		);

		$arr['result']['PK_Usuario'] =
			(!isset($data['PK_Usuario']))
				? $this->Usuario_model->insert_usuario($arr['result'])
				: $this->Usuario_model->edit_usuario($arr['result'] , $data['PK_Usuario'])
				;

		echo json_encode($arr);

	}

	//INSERT
	public function save_categoria_usuario(){
		$data = json_decode(file_get_contents('php://input'), true);
		$list_categorias = $data['categorias_list'];
		try{

			$Arr = array();
			foreach ($list_categorias as $categoria) {
				if(isset($categoria['Exist']) && $categoria['Exist'] == "true") {
					array_push($Arr, array(
				    	'FK_Categoria' => $categoria['FK_Categoria'] ,
				    	'FK_Usuario' => $categoria['PK_Usuario']
					));
				}
			};

			$this->Usuario_model->delete_categoria_usuario($data['PK_Usuario']);
			if(count($Arr)>0 ) {
				$this->Usuario_model->insert_categoria_usuario($Arr);
			}

		} catch (Exception $e) {
			array_push( $arr['errors'] , $e->getMessage() );
			throw $e;
		}

		echo 'inserted';
	}
	//DELETE
	public function delete_usuario(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => array(
				'PK_Usuario' => $data
			),
			'errors' => array(),
		);

		$arr['op']= $this->Usuario_model->delete_usuario($data);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}
}

/* End of file admin_controller.php */
/* Location: ./application/controllers/admin_controller.php */

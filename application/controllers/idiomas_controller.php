<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Idiomas_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Idiomas_model');
		$this->load->library('table');
	}

	public function index()
	{
		$data['main_content'] = 'admin/idiomas_view';
		$data['idiomas'] = $this->Idiomas_model->get_idiomas();

		/*if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/adminpanel',$data);
		}
		else
		{
			$formdata = array(
			'Nombre' => $this->input->post('dNombre'),
			'Clave' => $this->input->post('dClave')
			);

			$this->Idiomas_model->insert_idioma($formdata);

			$this->load->view('templates/adminpanel',$data);
		}*/
		$this->load->view('admin/idiomas_view');
	}
	//SELECT
	public function get_idiomas(){
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Idiomas_model->get_idiomasAsArray());
	}
	//SELECT ID
	public function get_idioma() {
		$data = json_decode(file_get_contents('php://input'), true);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Idiomas_model->get_idiomaAsArray($data));

	}

	//INSERT
	public function save_idiomas(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array();

		$dNombre = $data['Nombre'];
		$dClave = $data['Clave'];

		$arr = array(
			'result' => array(
				'Nombre' => $data['Nombre'] ,
				'Clave' => $data['Clave'] ,
			),
			'errors' => array(),
			'op' => true
		);

		$arr['result']['PK_Idioma'] =
			(!isset($data['PK_Idioma']))
				? $this->Idiomas_model->insert_idioma($arr['result'])
				: $this->Idiomas_model->edit_idioma($arr['result'] , $data['PK_Idioma'])
				;

		echo json_encode($arr);

	}
	//DELETE
	public function delete_idioma(){

		$data = json_decode(file_get_contents('php://input'), true);

		$arr = array(
			'result' => array(
				'PK_Idioma' => $data
			),
			'errors' => array(),
		);

		$arr['op']= $this->Idiomas_model->delete_idioma($data);

		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}
}

/* End of file admin_controller.php */
/* Location: ./application/controllers/admin_controller.php */

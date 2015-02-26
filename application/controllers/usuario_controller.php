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
}

/* End of file admin_controller.php */
/* Location: ./application/controllers/admin_controller.php */

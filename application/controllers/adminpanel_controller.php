<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPanel_controller extends CI_Controller {
	public function __construct()	{		parent::__construct();		$this->load->model('Login_model');		$this->load->library('table');	}
	//----------------- INDEX v2
	public function index()	{		$data['main_content'] = 'admin/adminpanel_view';		$this->load->view('templates/adminpanel',$data);
	}
	public function login()	{		$this->load->view('home/login_view');	}	public function dashboard()	{		$this->load->view('admin/dashboard_view');	}	//VALIDACIÓN DE USUARIOS	public function valida_usuarios()	{		$data = json_decode(file_get_contents('php://input'), true);		$user = $data['user'];		$pass = $data['pass'];		$arr = array(			'errors' => array(),			'op' => array('opValid' => -1,			              'EsAdmin' => false,										'menu' => array()),			'user' => $user,		);		$arr['op'] = $this->Login_model->valida_usuarios($user, $pass);		echo json_encode($arr);	}}/* End of file admin_controller.php */
/* Location: ./application/controllers/adminpanel_controller.php */

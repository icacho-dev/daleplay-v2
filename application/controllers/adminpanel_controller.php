<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPanel_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	//----------------- INDEX v2
	public function index()
	{		

		$data['main_content'] = 'admin/adminpanel_view';		
		
		$this->load->view('templates/adminpanel',$data);
	}
	
	public function dashboard()
	{		

		//$data['main_content'] = 'admin/adminpanel_view';		
		
		//$this->load->view('templates/adminpanel',$data);
		$this->load->view('admin/dashboard_view');
	}

	
	
}

/* End of file admin_controller.php */
/* Location: ./application/controllers/adminpanel_controller.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_Idioma_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categoria_Idioma_model');
	}

	public function index()
	{
		
	}
	
	//SELECT
	public function get_categoria_idioma(){
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Categoria_Idioma_model->get_CategoriaIdioma());
	}
	
	//SELECT AS ARRAY
	public function get_categoria_idioma_AsArray(){
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Categoria_Idioma_model->get_CategoriaIdiomaAsArray());
	}
	
	//SELECT AS ARRAY
	public function get_categoria_idioma_ById_AsArray(){ 
		header ('Content-type: application/json; charset=utf-8');
		echo json_encode($this->Categoria_Idioma_model->get_CategoriaIdiomaByIdAsArray());
	}
	
	
}

/* End of file admin_controller.php */
/* Location: ./application/controllers/admin_controller.php */
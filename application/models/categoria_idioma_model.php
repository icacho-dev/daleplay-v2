<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_Idioma_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	
	function get_CategoriaIdioma()
	{
	   return $this->db->get('Categoria_Idioma')->result();	   
	}

	function get_CategoriaIdiomaAsArray()
	{
	   return $this->db->get('Categoria_Idioma')->result_array();	   
	}
	
	function get_CategoriaIdiomaByIdAsArray($data)
	{ 
		$this->db->select('FK_Idioma , Categoria_Idioma.Label , Nombre');
		$this->db->from('Categoria_Idioma');
		$this->db->where('Categoria_Idioma.FK_Categoria',$data);
		$this->db->join('Idioma', 'Idioma.PK_Idioma = Categoria_Idioma.FK_Idioma');
		
		$query = $this->db->get();
		
	   return $query->result_array();	   
	}
	

}

/* End of file Idioma_model.php */
/* Location: ./application/models/Idioma_model.php */
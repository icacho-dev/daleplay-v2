<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}

	function get_Usuario()
	{
	   return $this->db->get('Usuario');
	}

	function get_UsuarioAsArray()
	{
	   return $this->db->get('Usuario')->result_array();
	}
}

/* End of file Idioma_model.php */
/* Location: ./application/models/Idioma_model.php */

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

	function insert_usuario($data)
	{
		$this->db->insert('Usuario', $data);
		return $this->db->insert_id() ;
	}

	function edit_usuario($data , $id)
	{
		$this->db->where('PK_Usuario', $id);
		$this->db->update('Usuario', $data);
		return $id;
	}

	function delete_usuario($id)
	{
		$this->db->where('PK_Usuario', $id);
		$this->db->delete('Usuario');
	return true;
	}
}

/* End of file Idioma_model.php */
/* Location: ./application/models/Idioma_model.php */

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

	function insert_categoria_usuario($data)
	{
		$this->db->trans_start();
	  $this->db->insert_batch('Categorias_Usuario', $data);
	  $this->db->trans_complete();
	  return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
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

	function delete_categoria_usuario($id)
	{
		$this->db->where('FK_Usuario', $id);
		$this->db->delete('Categorias_Usuario');
		return true;
	}

	function get_CategoriaUsuarioByIdAsArray($id)
	{
		$this->db->select('FK_Categoria , Exist , Categoria, PK_Usuario');
		$this->db->from('view_categorias_usuario');
		$this->db->where('view_categorias_usuario.PK_Usuario',$id);

		$query = $this->db->get();
		return $query->result_array();
	}
}

/* End of file Idioma_model.php */
/* Location: ./application/models/Idioma_model.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Idioma_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_last_item()
	{
		$this->db->order_by('PK_Idioma', 'DESC');
		$query = $this->db->get('Nombre', 1);

		return $query->result();
	}

	function insert_idioma($data)
	{
		$this->db->insert('Idioma', $data);
		return $this->db->insert_id() ;
	}

	function edit_idioma($data , $id)
	{
		$this->db->where('PK_Idioma', $id);
		$this->db->update('Idioma', $data); 
		return $id;
	}

	function get_idioma($id)
	{	   
	   return $this->db->where('PK_Idioma', $id);
	}
	
	function get_idiomaAsArray($id)
	{
		$this->db->where('PK_Idioma', $id);
		$this->db->from('Idioma'); 
		$this->db->limit(1);
		$query = $this->db->get();	   
	   return $query->result();
	}
	
	
	function get_Idioma()
	{	   
	   return $this->db->get('Idioma');
	}
	
	function get_IdiomaAsArray()
	{
	   return $this->db->get('Idioma')->result_array();	   
	}
	
	
 	function delete_idioma($id)
  	{	
  		$this->db->where('PK_Idioma', $id);
  		$this->db->delete('Idioma'); 
		return true;
  	}

}

/* End of file Idioma_model.php */
/* Location: ./application/models/Idioma_model.php */
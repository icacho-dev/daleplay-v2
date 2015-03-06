<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_last_item()
	{
		$this->db->order_by('PK_IdCategoria', 'DESC');
		$query = $this->db->get('Nombre', 1);

		return $query->result();
	}
	/*
	function insert_categoria($data)
	{
		$this->db->insert('Categorias', $data);
		return $this->db->insert_id() ;
	}
	*/
	//--------------------------------------------
	function insert_categoriav2($data)
	{
		$this->db->insert('Categoria', $data);
		return $this->db->insert_id() ;
	}
	
	function edit_categoriav2($data , $id)
	{
		$this->db->where('PK_Categoria', $id);
		$this->db->update('Categoria', $data); 
		return $id;
	}
	
	function delete_categoriav2($id)
  	{	
  		$this->db->where('PK_Categoria', $id);
  		$this->db->delete('Categoria'); 
		return true;
  	}
	//--------------------------------------------
	
	function insert_categoriaIdioma($data)
	{
		$this->db->trans_start();
	    $this->db->insert_batch('Categoria_Idioma', $data);
	    $this->db->trans_complete();        
	    return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
	}

	function update_categoriaIdioma($data , $id)
	{
		$this->db->trans_start();
		$this->db->where('FK_Categoria', $id);
  		$this->db->update_batch('Categoria_Idioma', $data,'FK_Idioma');	    
	    $this->db->trans_complete();	
		    
	    return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
	}
	
	function get_categoriasAsArray_v2()
	{
		return $this->db->get('Categoria')->result_array();
	}
	/*
	function edit_categoria($data , $id)
	{
		$this->db->where('PK_IdCategoria', $id);
		$this->db->update('Categorias', $data); 
		return $id;
	}
	*/
	function get_categoria($id)
	{	   
	   return $this->db->where('PK_IdCategoria', $id);
	}
	/*
	function get_categoriaAsArray($id)
	{
		$this->db->where('PK_IdCategoria', $id);
		$this->db->from('Categorias'); 
		$this->db->limit(1);
		$query = $this->db->get();	   
	   return $query->result();
	}
	
	function get_categorias() 
	{	   
	   return $this->db->get('Categorias');
	}
	
	function get_categoriasAsArray()
	{
	   return $this->db->get('Categorias')->result_array();	   
	}
	
	
 	function delete_categoria($id)
  	{	
  		$this->db->where('PK_IdCategoria', $id);
  		$this->db->delete('Categorias'); 
		return true;
  	}
	*/

}

/* End of file categorias_model.php */
/* Location: ./application/models/categorias_model.php */
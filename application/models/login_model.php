<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {
	public function __construct()
	{		parent::__construct();
	}
	function valida_usuarios($user, $pass)	{
		$this->db->select('PK_Usuario, UsuarioActivo, EsAdmin');		$this->db->from('Usuario');    $where = "Usuario.UserName = '" . $user . "' AND Usuario.Password = '" . $pass . "'";
		$this->db->where($where);
		$query = $this->db->get();		$arr = array('opValid' => -1,
			           'EsAdmin' => false,
									'menu' => array());
		if ($query->num_rows() > 0)
		{
		  $row = $query->row();
			if($row->UsuarioActivo == 'false') $arr['op'] =  2;
			else
			{
				$arr['op'] =  0;
				$arr['EsAdmin'] =  $row->EsAdmin == 'true' ? true : false;

				$this->db->select('FK_Categoria, Categoria');
				$this->db->from('view_categorias_usuario');
    		$where = "view_categorias_usuario.PK_Usuario = " . $row->PK_Usuario . " AND Exist = 'true'" ;
				$this->db->where($where);
				$query = $this->db->get();
				$arr['menu'] =  $query->result_array();
			}
		}
		else $arr['op'] = 1;
		return $arr;	}
}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */
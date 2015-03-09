<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {
	public function __construct()
	{		parent::__construct();
	}
	function valida_usuarios($user, $pass)	{
		$this->db->select('PK_Usuario, UsuarioActivo');
		$this->db->from('Usuario');
    $where = "Usuario.UserName = '" . $user . "' AND Usuario.Password = '" . $pass . "'";
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		  $row = $query->row();
			if($row->UsuarioActivo == 'false')
			  return 2;
			return 0;
		}
		return 1;	}
}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */
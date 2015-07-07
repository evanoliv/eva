<?php
Class Usuario_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarUsuario($usuario)
    {
    	$this->load->helper('security');
    	
    	$user['usu_nome']  			= addslashes($usuario['nome']);
    	$user['usu_senha'] 			= do_hash($usuario['senha'].'4rT%yH7uJ$3Fr5&uj9Lç0Ds21#4gf%$g54');
    	$user['usu_email'] 			= addslashes($usuario['email']);
    	$user['usu_roteiro']		= '0';
    	$user['usu_criado_em'] 		= date("Y-m-d H:i:s");
    	$user['usu_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->insert('tbl_usuario',$user);
    	return $this->db->insert_id();
    } 
    
    public function editarDadosUsuario($usuario)
    {
    	$user['usu_nome']  			= addslashes($usuario['nome']);
    	$user['usu_email'] 			= addslashes($usuario['email']);
    	$user['usu_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->where('usu_id',$usuario['usu_id']);
    	$this->db->update('tbl_usuario',$user);
    	
    	$this->session->set_userdata('usu_nome',$usuario['nome']);
    	$this->session->set_userdata('usu_email',$usuario['email']);
    	
    	$resp['res_nome']  			= addslashes($usuario['nome']);
    	$resp['res_email'] 			= addslashes($usuario['email']);
    	$resp['res_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->where('res_id',$this->session->userdata('res_id'));
    	$this->db->update('tbl_responsavel',$resp);
    } 

    public function editarSenhaUsuario($usuario)
    {
    	$this->load->helper('security');
    	
    	$user['usu_senha'] 			= do_hash($usuario['senha'].'4rT%yH7uJ$3Fr5&uj9Lç0Ds21#4gf%$g54');
    	$user['usu_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->where('usu_id',$usuario['usu_id']);
    	$this->db->update('tbl_usuario',$user);
    } 
        
    public function getDadosUsuario($field = '',$value = '')
    {
    	if(!empty($field))
    		$this->db->where($field,$value);

      	$query = $this->db->get('tbl_usuario');
    		
        return $query->result();
    }
    
    public function getUsuario($usuId)
    {
   		$this->db->where('usu_id',$usuId);
      	$query = $this->db->get('tbl_usuario');
    		
        return reset($query->result());
    }
    
    public function editarRoteiro($usuario)
    {
    	$user['usu_id']	= $usuario['usu_id'];
    	$user['usu_roteiro'] = (isset($usuario['roteiro'])) ? '1' : '0';
    	$this->session->set_userdata('usu_roteiro',(isset($usuario['roteiro'])) ? '1' : '0');
    	
     	$this->db->where('usu_id',$usuario['usu_id']);
    	$this->db->update('tbl_usuario',$user);   	
    	
    }
    
    public function getUsuariosByEvento($eveId)
    {
    	$this->db->join('tbl_papel','tbl_papel.pap_usu_id = tbl_usuario.usu_id');
    	$this->db->where('pap_eve_id',$eveId);
    	$query = $this->db->get('tbl_usuario');   	
    	
		return $query->result();    	
    }
    
}
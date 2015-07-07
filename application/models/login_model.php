<?php
Class Login_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
	
    function entrar($user,$pass)
    {
    	
    	$this->load->helper('security');
    	
    	$this->db->where('usu_email',$user);
    	$this->db->where('usu_senha',do_hash($pass.'4rT%yH7uJ$3Fr5&uj9Lç0Ds21#4gf%$g54'));
    	
    	$query = $this->db->get('tbl_usuario');
    	
    	if($query->num_rows() > 0){

    		$userLogado = reset($query->result());
    		
    		$this->load->model('Responsavel_model','responsavel');
    		$responsavel = $this->responsavel->getDadosResponsavelByUsuario($userLogado->usu_id);
    		
    		$this->session->set_userdata('res_id',$responsavel->res_id);
    		$this->session->set_userdata('usu_nome',$userLogado->usu_nome);
    		$this->session->set_userdata('usu_email',$userLogado->usu_email);
    		$this->session->set_userdata('usu_id',$userLogado->usu_id);
    		$this->session->set_userdata('usu_roteiro',$userLogado->usu_roteiro);
    		$this->session->set_userdata('usu_criado_em',$userLogado->usu_criado_em);
    		$this->session->set_userdata('usu_ultimo_login',$userLogado->usu_ultimo_login);
    		$this->ultimoLogin($userLogado->usu_id);
    		return true;
    		
    	} else {
    		
    		return false;
    		
    	}
    	
    }
    
    public function ultimoLogin($usuId)
    {
    	$user['usu_ultimo_login'] 	= date("Y-m-d H:i:s");

    	$this->db->where('usu_id',$usuId);
    	$this->db->update('tbl_usuario',$user);
    }
    
    public function decrypto($string)
    {
    	$this->db->where('enc_string',$string);
    	$this->db->where('enc_ativo','0');
    	$query = $this->db->get('tbl_encrypto');
    	
    	if($query->num_rows() > 0){
    		
   			$dec['enc_ativo']			= '1';
			$dec['enc_modificado_em'] 	= date("Y-m-d H:i:s");
    			
   			$this->db->where('enc_string',$string);
   			$this->db->update('tbl_encrypto',$dec);
    		
    		return reset($query->result());
    	} else {
    		return '';
    	}

    }
         
    public function encrypto($string,$email)
    {
    	$this->load->helper('security');
    	
    	$dec['enc_string'] 			= do_hash($string.$email.'4rT%yH7uJ$3Fr5&uj9Lç0Ds21#4gf%$g54');
		$dec['enc_funcao'] 			= $string;
		$dec['enc_ativo']			= '0';
		$dec['enc_criado_em'] 		= date("Y-m-d H:i:s");
		$dec['enc_modificado_em'] 	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_encrypto',$dec);
    	
    	return $dec['enc_string'];
    }   
}
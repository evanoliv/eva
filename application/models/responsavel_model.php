<?php
Class Responsavel_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarResponsavel($responsavel)
    {
    	$resp['res_usu_id'] 		= $responsavel['usu_id'];
    	$resp['res_nome'] 			= addslashes($responsavel['nome']);
    	$resp['res_email'] 			= addslashes($responsavel['email']);
    	$resp['res_endereco'] 		= addslashes($responsavel['endereco']);
    	$resp['res_numero'] 		= addslashes($responsavel['numero']);
    	$resp['res_complemento'] 	= addslashes($responsavel['complemento']);
    	$resp['res_cep'] 			= preg_replace('/\D/','',$responsavel['cep']);
    	$resp['res_bairro'] 		= addslashes($responsavel['bairro']);
    	$resp['res_cidade'] 		= addslashes($responsavel['cidade']);
    	$resp['res_estado'] 		= $responsavel['estado'];
    	$resp['res_criado_em'] 		= date("Y-m-d H:i:s");
    	$resp['res_modificado_em'] 	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_responsavel',$resp);	    	
    } 
    
    public function editarResponsavel($responsavel)
    {
    	$resp['res_usu_id'] 		= $responsavel['usu_id'];
    	$resp['res_nome'] 			= addslashes($responsavel['nome']);
    	$resp['res_instituicao'] 	= addslashes($responsavel['instituicao']);
		$resp['res_cargo'] 			= addslashes($responsavel['cargo']);
    	$resp['res_email'] 			= addslashes($responsavel['email']);
    	$resp['res_datanasc'] 		= $responsavel['datanasc'];
    	$resp['res_telefone'] 		= preg_replace('/\D/','',$responsavel['telefone']);
    	$resp['res_celular1'] 		= preg_replace('/\D/','',$responsavel['celular1']);
	   	$resp['res_celular2'] 		= preg_replace('/\D/','',$responsavel['celular2']);
    	$resp['res_endereco'] 		= addslashes($responsavel['endereco']);
    	$resp['res_numero'] 		= addslashes($responsavel['numero']);
    	$resp['res_complemento'] 	= addslashes($responsavel['complemento']);
    	$resp['res_cep'] 			= preg_replace('/\D/','',$responsavel['cep']);
    	$resp['res_bairro'] 		= addslashes($responsavel['bairro']);
    	$resp['res_cidade'] 		= addslashes($responsavel['cidade']);
    	$resp['res_estado'] 		= $responsavel['estado'];
    	$resp['res_modificado_em'] 	= date("Y-m-d H:i:s");
    	
    	$this->db->where('res_id',$responsavel['id']);
    	$this->db->update('tbl_responsavel',$resp);	    	
    } 
    
    public function excluirResponsavel($resId)
    {
    	$objetos = $this->getObjetosResponsavel($resId);
    	
    	if(!empty($objetos)){
    		
    		return false;
    		
    	} else {
    		
    		$this->db->where('res_id',$resId);
    		$this->db->delete('tbl_responsavel');

    		return true;
    		
    	}
    	
    }
        
    public function getResponsaveis($usuId)
    {
    	$this->db->where('res_usu_id',$usuId);
    	$query = $this->db->get('tbl_responsavel');
                
        return $query->result();
    }

    public function getResponsaveisByNome($nome)
    {
    	$this->db->like('res_nome',$nome);
    	$query = $this->db->get('tbl_responsavel');
                
        return $query->result();
    }
        
    public function getDadosResponsavel($resId)
    {
    	$this->db->where('res_id',$resId);
    	$query = $this->db->get('tbl_responsavel');
        $query = reset($query->result());
        
        return $query;
    }
    
    public function getDadosResponsavelByUsuario($usuId)
    {
    	$this->db->where('res_usu_id',$usuId);
    	$query = $this->db->get('tbl_responsavel');
        
        return reset($query->result());
    }

    public function getObjetosResponsavel($resId)
    {
    	$this->db->where('obj_res_id',$resId);
    	$query = $this->db->get('tbl_objeto');
                
        return $query->result();
    }    
}
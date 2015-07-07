<?php
Class Hospedagem_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarHospedagem($hospedagem)
    {
    	$hosped['hos_eve_id']		= $hospedagem['eve_id'];
    	$hosped['hos_nome']			= addslashes($hospedagem['nome']);
    	$hosped['hos_descricao']	= addslashes($hospedagem['descricao']);
    	$hosped['hos_solidaria']	= $hospedagem['solidaria'];
    	$hosped['hos_lugares']		= preg_replace('/\D/','',$hospedagem['lugares']);
    	$hosped['hos_email']		= addslashes($hospedagem['email']);
    	$hosped['hos_telefone']		= preg_replace('/\D/','',$hospedagem['telefone']);
    	$hosped['hos_celular1']		= preg_replace('/\D/','',$hospedagem['celular1']);
    	$hosped['hos_celular2']		= preg_replace('/\D/','',$hospedagem['celular2']);
    	$hosped['hos_endereco']		= addslashes($hospedagem['endereco']);
    	$hosped['hos_numero']		= preg_replace('/\D/','',$hospedagem['numero']);
    	$hosped['hos_complemento']	= addslashes($hospedagem['complemento']);
    	$hosped['hos_bairro']		= addslashes($hospedagem['bairro']);
    	$hosped['hos_cidade']		= addslashes($hospedagem['cidade']);
    	$hosped['hos_estado']		= $hospedagem['estado'];
    	$hosped['hos_cep']			= preg_replace('/\D/','',$hospedagem['cep']);
    	
    	$this->db->insert('tbl_hospedagem',$hosped);
    }

    public function editarHospedagem($hospedagem)
    {
    	$hosped['hos_nome']			= addslashes($hospedagem['nome']);
    	$hosped['hos_descricao']	= addslashes($hospedagem['descricao']);
    	$hosped['hos_solidaria']	= $hospedagem['solidaria'];
    	$hosped['hos_lugares']		= preg_replace('/\D/','',$hospedagem['lugares']);
    	$hosped['hos_email']		= addslashes($hospedagem['email']);
    	$hosped['hos_telefone']		= preg_replace('/\D/','',$hospedagem['telefone']);
    	$hosped['hos_celular1']		= preg_replace('/\D/','',$hospedagem['celular1']);
    	$hosped['hos_celular2']		= preg_replace('/\D/','',$hospedagem['celular2']);
    	$hosped['hos_endereco']		= addslashes($hospedagem['endereco']);
    	$hosped['hos_numero']		= preg_replace('/\D/','',$hospedagem['numero']);
    	$hosped['hos_complemento']	= addslashes($hospedagem['complemento']);
    	$hosped['hos_bairro']		= addslashes($hospedagem['bairro']);
    	$hosped['hos_cidade']		= addslashes($hospedagem['cidade']);
    	$hosped['hos_estado']		= $hospedagem['estado'];
    	$hosped['hos_cep']			= preg_replace('/\D/','',$hospedagem['cep']);
    	
    	$this->db->where('hos_id',$hospedagem['id']);
    	$this->db->update('tbl_hospedagem',$hosped);
    }
    
    public function excluirHospedagem($hosId)
    {
    	$this->db->where('hos_id',$hosId);
    	return $this->db->delete('tbl_hospedagem'); 
    }
    
    public function getDadosHospedagem($hosId)
    {
    	$this->db->where('hos_id',$hosId);
    	$query = $this->db->get('tbl_hospedagem');

    	return reset($query->result());
    }
    
    public function getHospedagensByEvento($eveId)
    {
    	$this->db->where('hos_eve_id',$eveId);
    	$this->db->order_by('hos_nome','asc');
    	$query = $this->db->get('tbl_hospedagem');
    	
    	return $query->result();
    }

}
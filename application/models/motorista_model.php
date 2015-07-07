<?php
Class Motorista_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarMotorista($motorista)
    {
    	$motor['mot_eve_id']	= $motorista['eve_id'];
    	$motor['mot_nome']		= addslashes($motorista['nome']);
    	$motor['mot_email']		= addslashes($motorista['email']);
    	$motor['mot_celular1']	= preg_replace('/\D/','',$motorista['celular1']);
    	$motor['mot_celular2']	= preg_replace('/\D/','',$motorista['celular2']);
    	$motor['mot_telefone']	= preg_replace('/\D/','',$motorista['telefone']);
    	
    	$this->db->insert('tbl_motorista',$motor);
    }

    public function editarMotorista($motorista)
    {
    	$motor['mot_nome']		= addslashes($motorista['nome']);
    	$motor['mot_email']		= addslashes($motorista['email']);
    	$motor['mot_celular1']	= preg_replace('/\D/','',$motorista['celular1']);
    	$motor['mot_celular2']	= preg_replace('/\D/','',$motorista['celular2']);
    	$motor['mot_telefone']	= preg_replace('/\D/','',$motorista['telefone']);
    	
    	$this->db->where('mot_id',$motorista['id']);
    	$this->db->update('tbl_motorista',$motor);
    }
    
    public function excluirMotorista($motId)
    {
    	$this->db->where('mot_id',$motId);
    	return $this->db->delete('tbl_motorista');	    		
    }
    
    public function getDadosMotorista($motId)
    {
    	$this->db->where('mot_id',$motId);
    	$query = $this->db->get('tbl_motorista');

    	return reset($query->result());
    }
    
    public function getMotoristasByEvento($eveId)
    {
    	$this->db->where('mot_eve_id',$eveId);
    	$this->db->order_by('mot_nome','asc');
    	$query = $this->db->get('tbl_motorista');
    	
    	return $query->result();
    }

}
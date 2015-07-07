<?php
Class Veiculo_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarVeiculo($veiculo)
    {
    	$veic['vei_eve_id']		= $veiculo['eve_id'];
    	$veic['vei_modelo']		= addslashes($veiculo['modelo']);
    	$veic['vei_marca']		= addslashes($veiculo['marca']);
    	$veic['vei_cor']		= addslashes($veiculo['cor']);
    	$veic['vei_placa']		= addslashes($veiculo['placa']);
    	$veic['vei_lugares']	= preg_replace('/\D/','',$veiculo['lugares']);
    	
    	$this->db->insert('tbl_veiculo',$veic);
    }

    public function editarVeiculo($veiculo)
    {
    	$veic['vei_modelo']		= addslashes($veiculo['modelo']);
    	$veic['vei_marca']		= addslashes($veiculo['marca']);
    	$veic['vei_cor']		= addslashes($veiculo['cor']);
    	$veic['vei_placa']		= addslashes($veiculo['placa']);
    	$veic['vei_lugares']	= preg_replace('/\D/','',$veiculo['lugares']);
    	
    	$this->db->where('vei_id',$veiculo['id']);
    	$this->db->update('tbl_veiculo',$veic);
    }
    
    public function excluirVeiculo($veiId)
    {
    	$this->db->where('vei_id',$veiId);
    	return $this->db->delete('tbl_veiculo');	    		
    }
    
    public function getDadosVeiculo($veiId)
    {
    	$this->db->where('vei_id',$veiId);
    	$query = $this->db->get('tbl_veiculo');

    	return reset($query->result());
    }
    
    public function getVeiculosByEvento($eveId)
    {
    	$this->db->where('vei_eve_id',$eveId);
    	$this->db->order_by('vei_modelo','asc');
    	$query = $this->db->get('tbl_veiculo');
    	
    	return $query->result();
    }

}
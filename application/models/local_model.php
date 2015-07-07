<?php
Class Local_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
	public function cadastrarLocal($local)
	{
		$this->db->where('loc_equ_id',$local['equipamento']);
		$this->db->where('loc_eve_id',$local['eve_id']);
    	$query = $this->db->get('tbl_local');
    	
    	if($query->num_rows > 0)
    		return false;
    	
    	$loc['loc_equ_id']		= $local['equipamento'];
    	$loc['loc_eve_id']		= $local['eve_id'];
    	
    	$this->db->insert('tbl_local',$loc);
    	return true;
	
	}

	public function editarLocal($local)
	{
		$this->db->where('loc_equ_id',$local['equipamento']);
		$this->db->where('loc_eve_id',$local['eve_id']);
		$this->db->where('loc_id !=',$local['id']);
    	$query = $this->db->get('tbl_local');
    	
    	if($query->num_rows > 0)
    		return false;
    	
    	$loc['loc_equ_id']		= $local['equipamento'];
    	
    	$this->db->where('loc_id',$local['id']);
    	$this->db->update('tbl_local',$loc);
    	return true;
	
	}
		
    public function getLocaisEvento($eveId)
    {
    	$this->db->join('tbl_equipamento','tbl_equipamento.equ_obj_id = tbl_objeto.obj_id');
    	$this->db->join('tbl_local','tbl_local.loc_equ_id = tbl_equipamento.equ_id');
    	$this->db->where('loc_eve_id',$eveId);
    	$this->db->order_by('obj_nome','asc');
    	$query = $this->db->get('tbl_objeto');
	    	
    	return $query->result();
    }
    
    public function excluirLocal($locId)
    {
		$this->db->where('loc_id',$locId);
		return $this->db->delete('tbl_local');
    }
    
    public function getDadosLocal($locId)
    {
    	$this->db->join('tbl_equipamento','tbl_equipamento.equ_id = tbl_local.loc_equ_id');
    	$this->db->join('tbl_objeto','tbl_objeto.obj_id = tbl_equipamento.equ_obj_id');
    	$this->db->where('loc_id',$locId);
    	$query = $this->db->get('tbl_local');
    	
    	return reset($query->result());
    }
    
}
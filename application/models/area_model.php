<?php
Class Area_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
    public function getAreas()
    {
    	$this->db->order_by('are_nome');
    	$query = $this->db->get('tbl_area');
                
        return $query->result();
    }
    
    public function getObjetoAreas($objId)
    {
    	$this->db->select('tbl_area.are_id, tbl_area.are_nome');
    	$this->db->from('tbl_atuacao');
    	$this->db->join('tbl_area','tbl_area.are_id = tbl_atuacao.atu_are_id');
    	$this->db->where('tbl_atuacao.atu_obj_id',$objId);
    	$query = $this->db->get();

    	return $query->result();
    }
    
    public function excluirAtuacaoObjeto($objId)
    {
    	$this->db->where('atu_obj_id',$objId);
    	$this->db->delete('tbl_atuacao');
    }
    
}
<?php
Class Financiamento_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
    public function getFinanciamentos()
    {
    	$query = $this->db->get('tbl_financiamento');
                
        return $query->result();
    }
    
    public function getObjetoFinancimentos($objId)
    {
    	$this->db->select('tbl_financiamento.fin_id, tbl_financiamento.fin_nome');
    	$this->db->from('tbl_financiamento_objeto');
    	$this->db->join('tbl_financiamento','tbl_financiamento.fin_id = tbl_financiamento_objeto.fio_fin_id');
    	$this->db->where('tbl_financiamento_objeto.fio_obj_id',$objId);
    	$query = $this->db->get();

    	return $query->result();
    }
    
    public function excluirFinanciamentoObjeto($objId)
    {
    	$this->db->where('fio_obj_id',$objId);
    	$this->db->delete('tbl_financiamento_objeto');
    }
    
}
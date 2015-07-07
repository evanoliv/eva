<?php
Class Tipo_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
    public function getTipos()
    {
    	$query = $this->db->get('tbl_tipo');
                
        return $query->result();
    }

    public function getSubtipos($tipId)
    {
    	$this->db->where('sub_tip_id',$tipId);
    	$query = $this->db->get('tbl_subtipo');
                
        return $query->result();
    }

    public function getSubsubtipos($subId)
    {
    	$this->db->where('ssu_sub_id',$subId);
    	$query = $this->db->get('tbl_subsubtipo');
                
        return $query->result();
    }
    
    public function getProdutosEventos($subtipos)
    {
    	foreach ($subtipos as $subtipo){
    		$this->db->or_where('ssu_sub_id',$subtipo->sub_id);	
    	}
    	$query = $this->db->get('tbl_subsubtipo');
                
        return $query->result();
    }
        
    public function getDadosSubsubtipo($ssuId)
    {
    	$this->db->where('ssu_id',$ssuId);
    	$query = $this->db->get('tbl_subsubtipo');
        $result = reset($query->result());        
    	
        return $result;
    }
    
    public function getDadosSubtipo($subId)
    {
    	$this->db->where('sub_id',$subId);
    	$query = $this->db->get('tbl_subtipo');
        $result = reset($query->result());        
    	
        return $result;
    }

    public function getDadosTipo($tipId)
    {
    	$this->db->where('tip_id',$tipId);
    	$query = $this->db->get('tbl_tipo');
        $result = reset($query->result());        
    	
        return $result;
    }
        
    public function getTipo($objeto)
    {
		$this->db->where('ssu_id',$objeto->obj_ssu_id);
		$subsubtipo = $this->db->get('tbl_subsubtipo');
		$subsubtipo = reset($subsubtipo->result()); 
		
		$this->db->where('sub_id',$subsubtipo->ssu_sub_id);
		$subtipo = $this->db->get('tbl_subtipo');
		$subtipo = reset($subtipo->result());
			
		$this->db->where('tip_id',$subtipo->sub_tip_id);
		$tipo = $this->db->get('tbl_tipo');
		$tipo = reset($tipo->result());
			
    	$objeto->subtipo = $subtipo->sub_nome;
    	$objeto->tipo = $tipo->tip_nome;
    }
        
}
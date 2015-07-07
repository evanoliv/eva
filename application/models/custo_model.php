<?php
Class Custo_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
    public function getItens($tipoItem)
    {
    	$this->db->where('ite_tipo',$tipoItem);
    	$query = $this->db->get('tbl_item');
                
        return $query->result();
    }

    public function cadastrarCusto($custo)
    {
    	$cust['cus_eve_id'] 		= $custo['eve_id'];
    	$cust['cus_ite_id'] 		= $custo['item'];
    	$cust['cus_tipo']			= $custo['tipo'];
    	$cust['cus_valor'] 			= str_replace(',','.',str_replace('.','',$custo['valor']));
    	$cust['cus_descricao'] 		= addslashes($custo['descricao']);
    	$cust['cus_criado_em'] 		= date("Y-m-d H:i:s");
    	$cust['cus_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->insert('tbl_custo',$cust);
    	
    	if($custo['tipo'] != '4'){
	    	$this->load->model('Cronograma_model','cronograma');
	    	
	    	$acao['categoria'] 	= 'Coordenação Administrativa e Financeira';
	    	$acao['titulo'] 	= 'Adquirir o item '.$this->getNomeItem($custo['item']);
	    	$acao['descricao']	= addslashes($custo['descricao']);
	    	
	    	$this->cronograma->cadastrarAcao($acao);
    	}

    } 
    
    public function editarCusto($custo)
    {
    	$cust['cus_ite_id'] 		= $custo['item'];
    	$cust['cus_valor'] 			= str_replace(',','.',str_replace('.','',$custo['valor']));
    	$cust['cus_descricao'] 		= addslashes($custo['descricao']);
    	$cust['cus_modificado_em'] 	= date("Y-m-d H:i:s");
    	
    	$this->db->where('cus_id',$custo['id']);
    	$this->db->update('tbl_custo',$cust);	    	
    }
    
    public function getCustos($eveId,$tipoItem)
    {
    	$this->db->join('tbl_item','tbl_custo.cus_ite_id = tbl_item.ite_id');
    	$this->db->where('cus_eve_id',$eveId);
    	$this->db->where('ite_tipo',$tipoItem);
    	$query = $this->db->get('tbl_custo');
                
        return $query->result();    	
    }
    
    public function getSomaCustos($eveId,$tipoItem)
    {
    	$this->db->join('tbl_item','tbl_custo.cus_ite_id = tbl_item.ite_id');
    	$this->db->where('cus_eve_id',$eveId);
    	$this->db->where('ite_tipo',$tipoItem);
    	$this->db->select_sum('cus_valor');
    	$query = $this->db->get('tbl_custo');
                
        return reset($query->result());
    }
    
    public function getCusto($cusId)
    {
    	$this->db->join('tbl_item','tbl_custo.cus_ite_id = tbl_item.ite_id');
    	$this->db->where('cus_id',$cusId);
    	$query = $this->db->get('tbl_custo');
                
        return reset($query->result());    	
    }
    
    public function excluirCusto($cusId)
    {
    	$this->db->where('cus_id',$cusId);
    	$this->db->delete('tbl_custo');
    }
    
    public function getNomeItem($iteId)
    {
    	$this->db->where('ite_id',$iteId);
    	$query = $this->db->get('tbl_item');
    	$item = reset($query->result());
    	return $item->ite_descricao;
    }
    
}
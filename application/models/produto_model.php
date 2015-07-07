<?php
Class Produto_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarProduto($produto)
    {
    	$prod['pro_obj_id']			= $produto['obj_id'];
    	$prod['pro_censura']		= addslashes($produto['censura']);
    	$prod['pro_integrantes']	= $produto['integrantes'];
    	$prod['pro_rider']			= addslashes($produto['rider']);
    	$prod['pro_duracao']		= addslashes($produto['duracao']);
    	$prod['pro_ficha_tecnica']	= addslashes($produto['ficha_tecnica']);
    	
    	$this->db->insert('tbl_produto',$prod);
    } 

    public function editarProduto($produto)
    {
    	$prod['pro_obj_id']			= $produto['obj_id'];
    	$prod['pro_censura']		= addslashes($produto['censura']);
    	$prod['pro_integrantes']	= $produto['integrantes'];
    	$prod['pro_rider']			= addslashes($produto['rider']);
    	$prod['pro_duracao']		= addslashes($produto['duracao']);
    	$prod['pro_ficha_tecnica']	= addslashes($produto['ficha_tecnica']);
    	
    	$this->db->where('pro_id',$produto['id']);
    	$this->db->update('tbl_produto',$prod);
    } 

    public function excluirProduto($objId)
    {
    	$this->db->where('pro_obj_id',$objId);
    	$this->db->delete('tbl_produto');
    }
    
    public function getDadosProduto($objId)
    {
    	$this->db->where('pro_obj_id',$objId);
    	$query = $this->db->get('tbl_produto');
        $query = reset($query->result());
        
        return $query;
    }
    
    public function getProdutos($usuId)
    {
    	$this->db->join('tbl_objeto','tbl_objeto.obj_id = tbl_produto.pro_obj_id');
    	$this->db->where('obj_publico >','0');
    	$this->db->where('obj_usu_id',$usuId);
    	$query = $this->db->get('tbl_produto');
    	
    	return $query->result();
    }
    
}
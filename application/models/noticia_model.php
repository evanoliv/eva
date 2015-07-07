<?php
Class Noticia_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarNoticia($noticia)
    {
    	$notic['not_eve_id']		= $noticia['eve_id'];
    	$notic['not_usu_id']		= $noticia['usu_id'];
    	$notic['not_titulo']		= addslashes($noticia['titulo']);
    	$notic['not_descricao']		= addslashes($noticia['descricao']);
    	$notic['not_criado_em']		= date("Y-m-d H:i:s");
    	$notic['not_modificado_em']	= date("Y-m-d H:i:s");
    	    	
    	$this->db->insert('tbl_noticia',$notic);
    }

    public function editarNoticia($noticia)
    {
    	$notic['not_titulo']		= addslashes($noticia['titulo']);
    	$notic['not_descricao']		= addslashes($noticia['descricao']);
    	$notic['not_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('not_id',$noticia['id']);
    	$this->db->update('tbl_noticia',$notic);
    }
    
    public function excluirNoticia($notId)
    {
    	$this->db->where('not_id',$notId);
    	$this->db->delete('tbl_noticia');	    		
    }
    
    public function getDadosNoticia($notId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_noticia.not_usu_id');
    	$this->db->where('not_id',$notId);
    	$query = $this->db->get('tbl_noticia');

    	return reset($query->result());
    }
    
    public function getNoticiasByEvento($eveId,$limite)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_noticia.not_usu_id');
    	$this->db->where('not_eve_id',$eveId);
    	$this->db->order_by('not_criado_em','desc');
    	$this->db->limit($limite);
    	$query = $this->db->get('tbl_noticia');
    	
    	return $query->result();
    }
    
    public function getNoticiasByFiltro($filtro)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_noticia.not_usu_id');
    	$this->db->where('not_eve_id',$filtro['eve_id']);
    	
    	if(!empty($filtro['data'])){
    		$this->db->where('not_criado_em >=',$filtro['data'].' 00:00:00');
    		$this->db->where('not_criado_em <=',$filtro['data'].' 23:59:59');
    	}
    	
   		$this->db->like('usu_nome',$filtro['usuario']);
   		$this->db->like('not_titulo',$filtro['titulo']);
    	$this->db->order_by('not_criado_em','desc');
    	$this->db->limit('50');
    	$query = $this->db->get('tbl_noticia');
    	
    	return $query->result();
    }
}
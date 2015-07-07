<?php
Class Papel_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarPapel($papel)
    {
    	$pap['pap_eve_id']			= $papel['evento'];
    	$pap['pap_usu_id']			= $papel['usuario'];
    	$pap['pap_papel']			= $papel['papel'];
    	$pap['pap_criado_em']		= date("Y-m-d H:i:s");
    	$pap['pap_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_papel',$pap);
    }

    public function editarPapel($papel)
    {
    	if($papel['cargo'] == 'Coordenação Geral')
    		$pap['pap_papel'] = 'admin';
    	elseif($papel['cargo'] == 'Produção')
    		$pap['pap_papel'] = 'produtor';
    	else 
    		$pap['pap_papel'] = 'coordenador';
    	
    	$pap['pap_cargo']			= $papel['cargo'];
    	$pap['pap_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('pap_id',$papel['id']);
    	$this->db->update('tbl_papel',$pap);
    }
    
    public function excluirPapel($papId)
    {
    	$this->db->where('pap_id',$papId);
    	return $this->db->delete('tbl_papel');	    		
    }
    
    public function getDadosPapel($papId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('pap_id',$papId);
    	$query = $this->db->get('tbl_papel');

    	return reset($query->result());
    }
    
    public function getPapeisByEvento($eveId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('pap_eve_id',$eveId);
    	$this->db->order_by('usu_nome','asc');
    	$query = $this->db->get('tbl_papel');
    	
    	return $query->result();
    }
    
    public function verificaPapelByEvento($eveId,$usuEmail)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('pap_eve_id',$eveId);
    	$this->db->where('usu_email',$usuEmail);
    	$query = $this->db->get('tbl_papel');
    	
    	if($query->num_rows > 0)
    		return true;
    	else 
    		return false;
    }
    
    public function getCoordenadoresEvento($eveId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('pap_eve_id = "'.$eveId.'" AND (pap_papel = "admin" OR pap_papel = "coordenador")');
    	$query = $this->db->get('tbl_papel');
    	
    	return $query->result();
    }

    public function getProdutoresEvento($eveId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('pap_eve_id',$eveId);
    	$this->db->where('pap_papel','produtor');
    	$query = $this->db->get('tbl_papel');
    	
    	return $query->result();
    }
    
    public function getPapelByEvento($eveId,$usuId)
    {
    	$this->db->where('pap_eve_id',$eveId);
    	$this->db->where('pap_usu_id',$usuId);
    	$query = $this->db->get('tbl_papel');
    	
    	return reset($query->result());
    	
    }
 
}
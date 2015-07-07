<?php
Class Participacao_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarParticipacao($participacao)
    {
    	if($this->verificaParticipacaoByEvento($participacao['apresentacao'],$participacao['papel']))
    		return false;
    	
    	$parti['par_eve_id']		= $participacao['evento'];
    	$parti['par_apr_id']		= $participacao['apresentacao'];
    	$parti['par_pap_id']		= $participacao['papel'];
		$parti['par_observacao']	= addslashes($participacao['observacao']);
    	$parti['par_criado_em']		= date("Y-m-d H:i:s");
    	$parti['par_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_participacao',$parti);
    	
    	return true;
    }

    public function editarParticipacao($participacao)
    {
    	$parti['par_apr_id']		= $participacao['apresentacao'];
    	$parti['par_pap_id']		= $participacao['papel'];
		$parti['par_observacao']	= addslashes($participacao['observacao']);
    	$parti['par_criado_em']		= date("Y-m-d H:i:s");
    	$parti['par_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('par_id',$participacao['id']);
    	$this->db->update('tbl_participacao',$parti);
    	
    	return true;
    }
    
    public function excluirParticipacao($parId)
    {
    	$this->db->where('par_id',$parId);
    	$this->db->delete('tbl_participacao');	    		
    }
    
    public function getDadosParticipacao($parId)
    {
    	$this->db->where('par_id',$parId);
    	$query = $this->db->get('tbl_participacao');

    	return reset($query->result());
    }
    
    public function verificaParticipacaoByEvento($aprId,$papId)
    {
    	$this->db->where('par_apr_id',$aprId);
    	$this->db->where('par_pap_id',$papId);
    	$query = $this->db->get('tbl_participacao');
    	
    	if($query->num_rows > 0)
    		return true;
    	else 
    		return false;
    }
    
    public function getParticipacaoCoordenacao($eveId)
    {
    	$this->db->join('tbl_papel','tbl_papel.pap_id = tbl_participacao.par_pap_id');
    	$this->db->join('tbl_apresentacao','tbl_apresentacao.apr_id = tbl_participacao.par_apr_id');
    	$this->db->where('par_eve_id = "'.$eveId.'" AND (pap_papel = "admin" OR pap_papel = "coordenador")');
    	$this->db->order_by('apr_data');
    	$this->db->order_by('apr_hora');
    	$query = $this->db->get('tbl_participacao');
    	
    	$participacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Usuario_model','usuario');
    	$this->load->model('Local_model','local');
    	
    	foreach ($participacoes as $participacao){
	    	$participacao->atracao = $this->evento->getDadosAtracao($participacao->apr_atr_id);
	    	$participacao->usuario = $this->usuario->getUsuario($participacao->pap_usu_id);
	    	$participacao->local = $this->local->getDadosLocal($participacao->apr_loc_id);
    	}
	    	
    	return $participacoes;
    	
    }

    public function getParticipacaoProducao($eveId)
    {
    	$this->db->join('tbl_papel','tbl_papel.pap_id = tbl_participacao.par_pap_id');
    	$this->db->join('tbl_apresentacao','tbl_apresentacao.apr_id = tbl_participacao.par_apr_id');
    	$this->db->where('par_eve_id',$eveId);
    	$this->db->where('pap_papel','produtor');
    	$this->db->order_by('apr_data');
    	$this->db->order_by('apr_hora');
    	$query = $this->db->get('tbl_participacao');
    	
    	$participacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Usuario_model','usuario');
    	$this->load->model('Local_model','local');
    	
    	foreach ($participacoes as $participacao){
	    	$participacao->atracao = $this->evento->getDadosAtracao($participacao->apr_atr_id);
	    	$participacao->usuario = $this->usuario->getUsuario($participacao->pap_usu_id);
	    	$participacao->local = $this->local->getDadosLocal($participacao->apr_loc_id);
    	}
	    	
    	return $participacoes;
    }
    
    public function getParticipacaoUsuario($usuId,$eveId)
    {
    	$this->db->join('tbl_papel','tbl_papel.pap_id = tbl_participacao.par_pap_id');
    	$this->db->join('tbl_apresentacao','tbl_apresentacao.apr_id = tbl_participacao.par_apr_id');
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('par_eve_id',$eveId);
    	$this->db->where('usu_id',$usuId);
    	$this->db->order_by('apr_data');
    	$this->db->order_by('apr_hora');
    	$query = $this->db->get('tbl_participacao');
    	
    	$participacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Local_model','local');
    	
    	foreach ($participacoes as $participacao){
	    	$participacao->atracao = $this->evento->getDadosAtracao($participacao->apr_atr_id);
	    	$participacao->local = $this->local->getDadosLocal($participacao->apr_loc_id);
    	}
	    	
    	return $participacoes;
    }
    
    public function getCoordenadoresByApresentacao($aprId)
    {
    	$this->db->join('tbl_papel','tbl_papel.pap_id = tbl_participacao.par_pap_id');
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('par_apr_id = "'.$aprId.'" AND (pap_papel = "admin" OR pap_papel = "coordenador")');
    	$query = $this->db->get('tbl_participacao');
    	
    	return $query->result(); 
    }
    
    public function getProdutoresByApresentacao($aprId)
    {
    	$this->db->join('tbl_papel','tbl_papel.pap_id = tbl_participacao.par_pap_id');
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('par_apr_id',$aprId);
    	$this->db->where('pap_papel','produtor');
    	$query = $this->db->get('tbl_participacao');
    	
    	return $query->result(); 
    }
}
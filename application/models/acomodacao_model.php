<?php
Class Acomodacao_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarAcomodacao($acomodacao)
    {
    	$acomod['aco_eve_id']			= $acomodacao['eve_id'];
    	$acomod['aco_atr_id']			= $acomodacao['atracao'];
    	$acomod['aco_hos_id']			= $acomodacao['hospedagem'];
    	$acomod['aco_chegada']			= $acomodacao['chegada'];
    	$acomod['aco_saida']			= $acomodacao['saida'];
    	$acomod['aco_almoco']			= $acomodacao['almoco'];
    	$acomod['aco_janta']			= $acomodacao['janta'];
    	$acomod['aco_catering']			= $acomodacao['catering'];
    	$acomod['aco_observacao']		= addslashes($acomodacao['observacao']);
    	$acomod['aco_criado_em']		= date("Y-m-d H:i:s");
    	$acomod['aco_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_acomodacao',$acomod);
    	$id = $this->db->insert_id();
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($acomodacao['atracao']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> cadastrou a <a href="base_urlplanejamento/showAcomodacao/'.$id.'">acomodação</a> para a atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    }

    public function editarAcomodacao($acomodacao)
    {
    	$acomod['aco_atr_id']			= $acomodacao['atracao'];
    	$acomod['aco_hos_id']			= $acomodacao['hospedagem'];
    	$acomod['aco_chegada']			= $acomodacao['chegada'];
    	$acomod['aco_saida']			= $acomodacao['saida'];
    	$acomod['aco_almoco']			= $acomodacao['almoco'];
    	$acomod['aco_janta']			= $acomodacao['janta'];
    	$acomod['aco_catering']			= $acomodacao['catering'];
    	$acomod['aco_observacao']		= addslashes($acomodacao['observacao']);
    	$acomod['aco_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('aco_id',$acomodacao['id']);
    	$this->db->update('tbl_acomodacao',$acomod);
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($acomodacao['atracao']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> editou a <a href="base_urlplanejamento/showAcomodacao/'.$acomodacao['id'].'">acomodação</a> da atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    }
    
    public function excluirAcomodacao($acoId)
    {
    	$acomodacao = $this->getDadosAcomodacao($acoId);
    	
    	$this->db->where('aco_id',$acoId);
    	$this->db->delete('tbl_acomodacao');

    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($acomodacao->aco_atr_id);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> excluiu uma acomodação da atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    }
    
    public function getDadosAcomodacao($acoId)
    {
    	$this->db->where('aco_id',$acoId);
    	$query = $this->db->get('tbl_acomodacao');

    	return reset($query->result());
    }
    
    public function getAcomodacoesByEvento($eveId)
    {
		$this->db->join('tbl_hospedagem','tbl_hospedagem.hos_id = tbl_acomodacao.aco_hos_id');
    	$this->db->where('aco_eve_id',$eveId);
    	$this->db->order_by('aco_chegada','asc');
    	$query = $this->db->get('tbl_acomodacao');

    	$acomodacoes = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($acomodacoes as $acomodacao){
	    	$acomodacao->atracao = $this->evento->getDadosAtracao($acomodacao->aco_atr_id);
    	}
	    	
    	return $acomodacoes;
    }
    
    public function getAcomodacoesByLugares()
    {
		$this->db->join('tbl_atracao','tbl_atracao.atr_id = tbl_acomodacao.aco_atr_id');
		$this->db->join('tbl_produto','tbl_produto.pro_id = tbl_atracao.atr_pro_id');
		$this->db->join('tbl_objeto','tbl_objeto.obj_id = tbl_produto.pro_obj_id');
    	$this->db->join('tbl_hospedagem','tbl_hospedagem.hos_id = tbl_acomodacao.aco_hos_id');
    	$this->db->where('aco_eve_id',$this->session->userdata('eve_id'));
    	$this->db->where('hos_lugares >','pro_integrantes');
    	$query = $this->db->get('tbl_acomodacao');
	    
    	return $query->result();
    }

    public function getAcomodacoesByAtracao($atrId)
    {
		$this->db->join('tbl_hospedagem','tbl_hospedagem.hos_id = tbl_acomodacao.aco_hos_id');
    	$this->db->where('aco_atr_id',$atrId);
    	$this->db->order_by('aco_chegada','asc');
    	$query = $this->db->get('tbl_acomodacao');

    	return $query->result(); 
    }
    
    public function getAcomodacoesByDatas($campo,$data_inicial,$data_final)
    {
		$this->db->join('tbl_hospedagem','tbl_hospedagem.hos_id = tbl_acomodacao.aco_hos_id');
    	$this->db->where('aco_eve_id',$this->session->userdata('eve_id'));
    	$this->db->where($campo.' >=',$data_inicial.' 00:00:00');
   		$this->db->where($campo.' <=',$data_final.' 23:59:59');
    	$this->db->order_by($campo,'asc');
    	$query = $this->db->get('tbl_acomodacao');

    	$acomodacoes = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($acomodacoes as $acomodacao){
	    	$acomodacao->atracao = $this->evento->getDadosAtracao($acomodacao->aco_atr_id);
    	}
	    	
    	return $acomodacoes;
    }
    
    public function getAcomodacoesRestantes($eveId)
    {
    	$this->db->join('tbl_atracao','tbl_atracao.atr_id = tbl_acomodacao.aco_atr_id','right');
    	$this->db->where('atr_hospedagem','1');
    	$this->db->where('atr_selecionado','1');
    	$this->db->where('atr_eve_id',$eveId);
    	$this->db->where('aco_id is null');
    	$query = $this->db->get('tbl_acomodacao');
    	
    	$acomodacoes = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($acomodacoes as $acomodacao){
	    	$acomodacao->atracao = $this->evento->getDadosAtracao($acomodacao->atr_id);
    	}
	    	
    	return $acomodacoes;
    }
    
    public function getAcomodacoesNaoSolidarias($eveId)
    {
    	$this->db->join('tbl_atracao','tbl_atracao.atr_id = tbl_acomodacao.aco_atr_id');
    	$this->db->join('tbl_hospedagem','tbl_hospedagem.hos_id = tbl_acomodacao.aco_hos_id');
    	$this->db->where('aco_eve_id',$eveId);
    	$this->db->where('atr_solidaria','0');
    	$this->db->where('atr_selecionado','1');
    	$this->db->where('hos_solidaria','1');
    	$query = $this->db->get('tbl_acomodacao');
    	
    	$acomodacoes = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($acomodacoes as $acomodacao){
	    	$acomodacao->atracao = $this->evento->getDadosAtracao($acomodacao->atr_id);
    	}
	    	
    	return $acomodacoes;
    }
    
    public function getAcomodacoesLugares($eveId)
    {
    	$this->db->join('tbl_atracao','tbl_atracao.atr_id = tbl_acomodacao.aco_atr_id', 'inner');
    	$this->db->join('tbl_produto','tbl_produto.pro_id = tbl_atracao.atr_pro_id', 'inner');
    	$this->db->join('tbl_objeto','tbl_objeto.obj_id = tbl_produto.pro_obj_id', 'inner');
    	$this->db->join('tbl_hospedagem','tbl_hospedagem.hos_id = tbl_acomodacao.aco_hos_id', 'inner');
    	$this->db->where('aco_eve_id',$eveId);
    	$this->db->having('pro_integrantes >','hos_lugares');
    	$query = $this->db->get('tbl_acomodacao');
    	
    	return $query->result(); 
    }
            
}
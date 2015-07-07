<?php
Class Apresentacao_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarApresentacao($apresentacao)
    {
    	$apres['apr_eve_id']		= $apresentacao['evento'];
    	$apres['apr_atr_id']		= $apresentacao['atracao'];
    	$apres['apr_loc_id']		= $apresentacao['local'];
		$apres['apr_data']			= $apresentacao['data'];
		$apres['apr_hora']			= $apresentacao['hora'];
		$apres['apr_duracao']		= $apresentacao['duracao'];
		$apres['apr_observacao']	= addslashes($apresentacao['observacao']);
    	$apres['apr_criado_em']		= date("Y-m-d H:i:s");
    	$apres['apr_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_apresentacao',$apres);
    	$id = $this->db->insert_id();
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($apresentacao['atracao']);
    	
    	$this->load->model('Local_model','local');
    	$local = $this->local->getDadosLocal($apresentacao['local']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-apple" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> marcou a <a href="base_urlplanejamento/showApresentacao/'.$id.'">apresentação</a> para atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a> no local <a href="base_urlevento/local/'.$local->loc_id.'">'.addslashes($local->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    }

    public function editarApresentacao($apresentacao)
    {
    	$apres['apr_atr_id']		= $apresentacao['atracao'];
    	$apres['apr_loc_id']		= $apresentacao['local'];
		$apres['apr_data']			= $apresentacao['data'];
		$apres['apr_hora']			= $apresentacao['hora'];
		$apres['apr_duracao']		= $apresentacao['duracao'];
		$apres['apr_observacao']	= addslashes($apresentacao['observacao']);
    	$apres['apr_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('apr_id',$apresentacao['id']);
    	$this->db->update('tbl_apresentacao',$apres);
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($apresentacao['atracao']);
    	
    	$this->load->model('Local_model','local');
    	$local = $this->local->getDadosLocal($apresentacao['local']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-apple" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> editou a <a href="base_urlplanejamento/showApresentacao/'.$apresentacao['id'].'">apresentação</a> da atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a> no local <a href="base_urlevento/local/'.$local->loc_id.'">'.addslashes($local->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    	
    }
    
    public function excluirApresentacao($aprId)
    {
    	$apresentacao = $this->getDadosApresentacao($aprId);
    	
    	$this->db->where('apr_id',$aprId);
    	
    	if($this->db->delete('tbl_apresentacao')){
    		    		
    		$this->load->model('Evento_model','evento');
	    	$atracao = $this->evento->getDadosAtracao($apresentacao->apr_atr_id);
	    	
	    	$this->load->model('Local_model','local');
	    	$local = $this->local->getDadosLocal($apresentacao->apr_loc_id);
	    	
	    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
	    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
	    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-apple" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> excluiu uma apresentação da atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a> no local <a href="base_urlevento/local/'.$local->loc_id.'">'.addslashes($local->obj_nome).'</a>.';
	    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
	    	
		    $this->db->insert('tbl_atividade',$ativ);
	    
    		return true;
    	} else {
    		return false;
    	}
    	
    }
    
    public function getDadosApresentacao($aprId)
    {
    	$this->db->where('apr_id',$aprId);
    	$query = $this->db->get('tbl_apresentacao');

    	return reset($query->result());
    }
    
    public function getApresentacoesByEvento($eveId)
    {
    	$this->db->where('apr_eve_id',$eveId);
    	$this->db->order_by('apr_hora','asc');
    	$query = $this->db->get('tbl_apresentacao');

    	$apresentacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Local_model','local');
    	
    	foreach ($apresentacoes as $apresentacao){
	    	$apresentacao->atracao = $this->evento->getDadosAtracao($apresentacao->apr_atr_id);
	    	$apresentacao->local = $this->local->getDadosLocal($apresentacao->apr_loc_id);
    	}
	    	
    	return $apresentacoes;
    }

    public function getApresentacoesByLocal($locId)
    {
    	$this->db->where('apr_loc_id',$locId);
    	$this->db->order_by('apr_hora','asc');
    	$query = $this->db->get('tbl_apresentacao');

    	$apresentacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Local_model','local');
    	
    	foreach ($apresentacoes as $apresentacao){
	    	$apresentacao->atracao = $this->evento->getDadosAtracao($apresentacao->apr_atr_id);
	    	$apresentacao->local = $this->local->getDadosLocal($apresentacao->apr_loc_id);
    	}
	    	
    	return $apresentacoes;
    }
        
    public function getApresentacoesByAtracao($atrId)
    {
    	$this->db->where('apr_atr_id',$atrId);
    	$this->db->order_by('apr_hora','asc');
    	$query = $this->db->get('tbl_apresentacao');

    	$apresentacoes = $query->result(); 
    	
    	$this->load->model('Local_model','local');
    	
    	foreach ($apresentacoes as $apresentacao)
	    	$apresentacao->local = $this->local->getDadosLocal($apresentacao->apr_loc_id);
	    	
    	return $apresentacoes;
    }
    
    public function getApresentacoesByDatas($data_inicial,$data_final)
    {
    	$this->db->where('apr_eve_id',$this->session->userdata('eve_id'));
    	$this->db->where('apr_data >=',$data_inicial);
   		$this->db->where('apr_data <=',$data_final);
    	$this->db->order_by('apr_data','asc');
    	$this->db->order_by('apr_hora','asc');
    	$query = $this->db->get('tbl_apresentacao');

    	$apresentacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Local_model','local');
    	
    	foreach ($apresentacoes as $apresentacao){
	    	$apresentacao->atracao = $this->evento->getDadosAtracao($apresentacao->apr_atr_id);
	    	$apresentacao->local = $this->local->getDadosLocal($apresentacao->apr_loc_id);
    	}
	    	
    	return $apresentacoes;
    }
    
    public function getApresentacoesConcorrentes()
    {
    	$this->db->where('apr_eve_id',$this->session->userdata('eve_id'));
    	$this->db->where('apr_data >=',$data_inicial);
   		$this->db->where('apr_data <=',$data_final);
    	$this->db->order_by('apr_data','asc');
    	$this->db->order_by('apr_hora','asc');
    	$query = $this->db->get('tbl_apresentacao');

    	$apresentacoes = $query->result(); 
    	
    	$this->load->model('Evento_model','evento');
    	$this->load->model('Local_model','local');
    	
    	foreach ($apresentacoes as $apresentacao){
	    	$apresentacao->atracao = $this->evento->getDadosAtracao($apresentacao->apr_atr_id);
	    	$apresentacao->local = $this->local->getDadosLocal($apresentacao->apr_loc_id);
    	}
	    	
    	return $apresentacoes;
    }    
}
<?php
Class Deslocamento_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarDeslocamento($deslocamento)
    {
    	$desloc['des_eve_id']			= $deslocamento['eve_id'];
    	$desloc['des_atr_id']			= $deslocamento['atracao'];
    	$desloc['des_mot_id']			= $deslocamento['motorista'];
    	$desloc['des_vei_id']			= $deslocamento['veiculo'];
    	$desloc['des_saida']			= $deslocamento['saida'];
    	$desloc['des_chegada']			= $deslocamento['chegada'];
    	$desloc['des_origem']			= $deslocamento['origem'];
    	$desloc['des_destino']			= $deslocamento['destino'];
    	$desloc['des_observacao']		= $deslocamento['observacao'];
    	$desloc['des_criado_em']		= date("Y-m-d H:i:s");
    	$desloc['des_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_deslocamento',$desloc);
    	$id = $this->db->insert_id();
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($deslocamento['atracao']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-road" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> cadastrou o <a href="base_urlplanejamento/showDeslocamento/'.$id.'">deslocamento</a> para a atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    }

    public function editarDeslocamento($deslocamento)
    {
    	$desloc['des_atr_id']			= $deslocamento['atracao'];
    	$desloc['des_mot_id']			= $deslocamento['motorista'];
    	$desloc['des_vei_id']			= $deslocamento['veiculo'];
    	$desloc['des_saida']			= $deslocamento['saida'];
    	$desloc['des_chegada']			= $deslocamento['chegada'];
    	$desloc['des_origem']			= $deslocamento['origem'];
    	$desloc['des_destino']			= $deslocamento['destino'];
    	$desloc['des_observacao']		= $deslocamento['observacao'];
    	$desloc['des_modificado_em']	= date("Y-m-d H:i:s");
    	    	
    	$this->db->where('des_id',$deslocamento['id']);
    	$this->db->update('tbl_deslocamento',$desloc);
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($deslocamento['atracao']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-road" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> editou o <a href="base_urlplanejamento/showDeslocamento/'.$deslocamento['id'].'">deslocamento</a> da atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);
    }
    
    public function excluirDeslocamento($desId)
    {
    	$deslocamento = $this->getDadosDeslocamento($desId);
    	
    	$this->db->where('des_id',$desId);
    	$this->db->delete('tbl_deslocamento');
    	
    	$this->load->model('Evento_model','evento');
    	$atracao = $this->evento->getDadosAtracao($deslocamento->des_atr_id);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-road" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> excluiu um deslocamento da atração <a href="base_urlevento/atracao/'.$atracao->atr_id.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    $this->db->insert('tbl_atividade',$ativ);    	
    }
    
    public function getDadosDeslocamento($desId)
    {
    	$this->db->where('des_id',$desId);
    	$query = $this->db->get('tbl_deslocamento');

    	return reset($query->result());
    }
    
    public function getDeslocamentosByEvento($eveId)
    {
		$this->db->join('tbl_motorista','tbl_motorista.mot_id = tbl_deslocamento.des_mot_id');
		$this->db->join('tbl_veiculo','tbl_veiculo.vei_id = tbl_deslocamento.des_vei_id');
		$this->db->where('des_eve_id',$eveId);
    	$this->db->order_by('des_saida','asc');
    	$query = $this->db->get('tbl_deslocamento');

    	$deslocamentos = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($deslocamentos as $deslocamento){
	    	$deslocamento->atracao = $this->evento->getDadosAtracao($deslocamento->des_atr_id);
    	}
	    	
    	return $deslocamentos;
    }

    public function getDeslocamentosByAtracao($atrId)
    {
		$this->db->join('tbl_motorista','tbl_motorista.mot_id = tbl_deslocamento.des_mot_id');
		$this->db->join('tbl_veiculo','tbl_veiculo.vei_id = tbl_deslocamento.des_vei_id');
		$this->db->where('des_atr_id',$atrId);
    	$this->db->order_by('des_saida','asc');
    	$query = $this->db->get('tbl_deslocamento');

    	return $query->result(); 
    }
    
    public function getDeslocamentosByDatas($campo,$data_inicial,$data_final)
    {
		$this->db->where('des_eve_id',$this->session->userdata('eve_id'));
		$this->db->where($campo.' >=',$data_inicial.' 00:00:00');
   		$this->db->where($campo.' <=',$data_final.' 23:59:59');
    	$this->db->order_by($campo,'asc');
    	$query = $this->db->get('tbl_deslocamento');

    	$deslocamentos = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($deslocamentos as $deslocamento){
	    	$deslocamento->atracao = $this->evento->getDadosAtracao($deslocamento->des_atr_id);
    	}
	    	
    	return $deslocamentos;
    }

    public function getDeslocamentosRestantes($eveId)
    {
    	$this->db->join('tbl_atracao','tbl_atracao.atr_id = tbl_deslocamento.des_atr_id','right');
    	$this->db->where('atr_transporte','1');
    	$this->db->where('atr_selecionado','1');
    	$this->db->where('atr_eve_id',$eveId);
    	$this->db->where('des_id is null');
    	$query = $this->db->get('tbl_deslocamento');
    	
    	$deslocamentos = $query->result(); 
	    
    	$this->load->model('Evento_model','evento');    	
    	
    	foreach ($deslocamentos as $deslocamento){
	    	$deslocamento->atracao = $this->evento->getDadosAtracao($deslocamento->atr_id);
    	}
	    	
    	return $deslocamentos;
    }
}
<?php
Class Evento_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
	public function getEventosRealizados($eveId)
    {
    	$this->db->where('eve_obj_id',$eveId);
    	$query = $this->db->get('tbl_evento');
        $query = $query->result();
        
        return $query;
    }
    
    public function getEventosAndamento($usuId)
    {
    	$this->db->join('tbl_papel', 'tbl_papel.pap_eve_id = tbl_evento.eve_id');
    	$this->db->where('pap_usu_id',$usuId);
    	$this->db->where('eve_finalizado','0');    	
    	$query = $this->db->get('tbl_evento');
        $query = $query->result();
        
        return $query;
    }
    
    public function getEventosFinalizados($usuId)
    {
    	$this->db->join('tbl_papel', 'tbl_papel.pap_eve_id = tbl_evento.eve_id');
    	$this->db->where('pap_usu_id',$usuId);
    	$this->db->where('eve_finalizado','1');
    	$query = $this->db->get('tbl_evento');
        $query = $query->result();
        
        return $query;
    }
 
    public function getEventosCadastrados($usuId)
    {
    	$this->db->where('obj_tip_id','1');
    	$this->db->where('obj_usu_id',$usuId);
    	$query = $this->db->get('tbl_objeto');
        $query = $query->result();
        
        return $query;
    }
    
    public function cadastrarEvento($evento,$usuId)
    {
    	$even['eve_obj_id']			= $evento['obj_id'];
    	$even['eve_nome']			= $evento['nome'];
    	$even['eve_descricao']		= $evento['resumo'];
    	$even['eve_publico']		= $evento['publico'];
    	$even['eve_finalizado']		= '0';
    	$even['eve_criado_em']		= date("Y-m-d H:i:s");
    	$even['eve_modificado_em']	= date("Y-m-d H:i:s");    
    		
    	$this->db->insert('tbl_evento',$even);
    	$eveId = $this->db->insert_id();
    	
    	$this->session->set_userdata('eve_id',$eveId);
    	
    	$papel['pap_usu_id']		= $usuId;
    	$papel['pap_eve_id']		= $eveId;
    	$papel['pap_papel']			= 'admin';
    	$papel['pap_criado_em']		= date("Y-m-d H:i:s");
    	$papel['pap_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_papel',$papel);
    	
    	return $eveId;
    }
    
    public function cadastrarDefinicao($evento)
    {
    	$eve['eve_nome']				= addslashes($evento['nome']);
    	$eve['eve_descricao']			= addslashes($evento['descricao']);
    	$eve['eve_proposta']			= addslashes($evento['proposta']);
    	$eve['eve_justificativa']		= addslashes($evento['justificativa']);
    	$eve['eve_objetivo']			= addslashes($evento['objetivo']);
    	$eve['eve_acessibilidade']		= addslashes($evento['acessibilidade']);
    	$eve['eve_democratizacao']		= addslashes($evento['democratizacao']);
    	$eve['eve_impacto_ambiental']	= addslashes($evento['impacto_ambiental']);
    	$eve['eve_publico_interesse']	= addslashes($evento['publico_interesse']);
    	$eve['eve_data_inicial']		= $evento['data_inicial'];
    	$eve['eve_data_final']			= $evento['data_final'];
    	$eve['eve_orcamento']			= str_replace(',','.',str_replace('.','',$evento['orcamento']));
    	$eve['eve_publico']				= $evento['publico'];
    	$eve['eve_inscricao']			= $evento['inscricao'];
    	$eve['eve_modificado_em']		= date("Y-m-d H:i:s");
    	
    	$this->session->set_userdata('eve_nome',$evento['nome']);
    	
    	$this->db->where('eve_id',$evento['eve_id']);
    	$this->db->update('tbl_evento',$eve);
    }
    
    public function getDadosEvento($eveId)
    {
    	$this->db->join('tbl_objeto','tbl_evento.eve_obj_id = tbl_objeto.obj_id');
		$this->db->join('tbl_responsavel','tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	$this->db->where('eve_id',$eveId);
    	$query = $this->db->get('tbl_evento');

    	return reset($query->result());
    }
    
    public function getDadosAtracao($atrId)
    {
    	$this->db->join('tbl_produto','tbl_atracao.atr_pro_id = tbl_produto.pro_id');
    	$this->db->join('tbl_objeto','tbl_produto.pro_obj_id = tbl_objeto.obj_id');
    	$this->db->join('tbl_evento','tbl_atracao.atr_eve_id = tbl_evento.eve_id');
    	$this->db->where('atr_id',$atrId);
    	$query = $this->db->get('tbl_atracao');
    	
    	return reset($query->result());
   	}
        
    public function getAtracoesEvento($eveId,$selecionado = '')
    {
    	$this->db->join('tbl_atracao','tbl_atracao.atr_eve_id = tbl_evento.eve_id');
    	$this->db->join('tbl_produto','tbl_atracao.atr_pro_id = tbl_produto.pro_id');
    	$this->db->join('tbl_objeto','tbl_produto.pro_obj_id = tbl_objeto.obj_id');
    	$this->db->join('tbl_subsubtipo','tbl_subsubtipo.ssu_id = tbl_objeto.obj_ssu_id');
		$this->db->join('tbl_responsavel','tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	$this->db->where('eve_id',$eveId);
    	
    	if(isset($selecionado))
    		$this->db->where('atr_selecionado',$selecionado);
    		
    	$this->db->order_by('obj_nome');
    		
    	$query = $this->db->get('tbl_evento');
    	
    	return $query->result();
    }
    
    public function getAtracoesByUsuario($usuId)
    {
    	$this->db->join('tbl_produto','tbl_atracao.atr_pro_id = tbl_produto.pro_id');
    	$this->db->join('tbl_objeto','tbl_produto.pro_obj_id = tbl_objeto.obj_id');
    	$this->db->join('tbl_evento','tbl_atracao.atr_eve_id = tbl_evento.eve_id');
    	$this->db->where('obj_usu_id',$usuId);
    	$query = $this->db->get('tbl_atracao');
    	
    	return $query->result();
    }
    
    public function getInscritosByFiltro($eveId,$filtro)
    {
    	$this->db->join('tbl_produto','tbl_atracao.atr_pro_id = tbl_produto.pro_id');
    	$this->db->join('tbl_objeto','tbl_produto.pro_obj_id = tbl_objeto.obj_id');
    	$this->db->join('tbl_subsubtipo','tbl_subsubtipo.ssu_id = tbl_objeto.obj_ssu_id');
    	$this->db->join('tbl_evento','tbl_atracao.atr_eve_id = tbl_evento.eve_id');
    	$this->db->join('tbl_responsavel', 'tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	
    	if((!empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    		$this->db->where('obj_res_id',$filtro['responsavel']);
    	} elseif((!empty($filtro['tipo'])) && (empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    	} elseif((empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->like('res_nome',$filtro['responsavel']);
    	}
    		    	
    	$this->db->where('atr_eve_id',$eveId);
    	$this->db->where('atr_selecionado','0');
    	$this->db->like('obj_nome',$filtro['nome']);
    	$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_atracao');
    	$result = $query->result();
    	
        return $result;
    }   
    
    public function cadastrarAtracao($atracao)
    {
    	$this->db->where('atr_pro_id',$atracao['produto']);
    	$this->db->where('atr_eve_id',$atracao['evento']);
    	$query = $this->db->get('tbl_atracao');
    	
    	if($query->num_rows > 0)
    		return false;
    	
    	$atrac['atr_pro_id']		= $atracao['produto'];
    	$atrac['atr_eve_id']		= $atracao['evento'];
    	$atrac['atr_selecionado']	= '0';
    	$atrac['atr_transporte']	= $atracao['transporte'];
    	$atrac['atr_alimentacao']	= $atracao['alimentacao'];
    	$atrac['atr_hospedagem']	= $atracao['hospedagem'];
    	$atrac['atr_solidaria']		= $atracao['solidaria'];
		$atrac['atr_custo']			= str_replace(',','.',str_replace('.','',$atracao['custo']));
		$atrac['atr_observacao']	= addslashes($atracao['observacao']);    	
    	$atrac['atr_criado_em']		= date("Y-m-d H:i:s");
    	$atrac['atr_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atracao',$atrac);
    	return true;
    }

    public function editarAtracao($atracao)
    {
    	$atrac['atr_pro_id']		= $atracao['produto'];
    	$atrac['atr_transporte']	= $atracao['transporte'];
    	$atrac['atr_alimentacao']	= $atracao['alimentacao'];
    	$atrac['atr_hospedagem']	= $atracao['hospedagem'];
    	$atrac['atr_solidaria']		= $atracao['solidaria'];
		$atrac['atr_custo']			= str_replace(',','.',str_replace('.','',$atracao['custo']));
		$atrac['atr_observacao']	= addslashes($atracao['observacao']);    	
    	$atrac['atr_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('atr_id',$atracao['id']);
    	$this->db->update('tbl_atracao',$atrac);
    }
    
    public function excluirAtracao($atrId)
    {
    	$this->db->where('atr_id',$atrId);
    	return $this->db->delete('tbl_atracao');	    		
    }
    
    public function removerAtracao($atrId)
    {
    	$this->db->where('apr_atr_id',$atrId);
    	$query = $this->db->get('tbl_apresentacao');
    	
    	if($query->num_rows > 0){
    		
    		return false;
    		
    	} else {
    	
    		$atrac['atr_selecionado'] = '0';

    		$this->db->where('atr_id',$atrId);
    		$this->db->update('tbl_atracao',$atrac);
    		
    		$atracao = $this->getDadosAtracao($atrId);
    	
    		$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    		$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    		$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-apple" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> removeu a atração <a href="base_urlevento/atracao/'.$atrId.'">'.addslashes($atracao->obj_nome).'</a>.';
    		$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
	    	$this->db->insert('tbl_atividade',$ativ);

    		return true;
    		
    	}
    }
        
    public function selecionarAtracao($atrId)
    {
    	$atrac['atr_selecionado'] = '1';

    	$this->db->where('atr_id',$atrId);
    	$this->db->update('tbl_atracao',$atrac);
    	
		$atracao = $this->getDadosAtracao($atrId);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-apple" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> selecionou a atração <a href="base_urlevento/atracao/'.$atrId.'">'.addslashes($atracao->obj_nome).'</a>.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    }
    
    public function getSomaCache($eveId)
    {
    	$this->db->where('atr_eve_id',$eveId);
    	$this->db->where('atr_selecionado','1');
    	$this->db->select_sum('atr_custo');
    	$query = $this->db->get('tbl_atracao');
                
        return reset($query->result());
    }
    
	public function getDiasEvento($dataIni,$dataFim)
	{
		$this->db->select('* from (select adddate("1970-01-01",t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
 							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
							where selected_date between "'.$dataIni.'" and "'.$dataFim.'"', FALSE); 
		$query = $this->db->get();

		return $query->result();
	}    
    
    public function importarTarefas($eveId,$usuId)
    {
    	$this->db->where('tar_eve_id','2');
    	$query = $this->db->get('tbl_tarefa');
    	$tarefas = $query->result();
    	
    	foreach ($tarefas as $tarefa){
    		$tar['tar_usu_id'] 			= $usuId;
    		$tar['tar_eve_id'] 			= $eveId;
    		$tar['tar_categoria'] 		= $tarefa->tar_categoria;
    		$tar['tar_titulo'] 			= $tarefa->tar_titulo;
    		$tar['tar_descricao'] 		= $tarefa->tar_descricao;
    		$tar['tar_situacao'] 		= $tarefa->tar_situacao;
    		$tar['tar_prioridade'] 		= $tarefa->tar_prioridade;
    		$tar['tar_criado_em'] 		= date("Y-m-d H:i:s");
    		$tar['tar_modificado_em'] 	= date("Y-m-d H:i:s");

    		$this->db->insert('tbl_tarefa',$tar);
    	}
    	
    }
    
}
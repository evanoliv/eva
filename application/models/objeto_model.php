<?php
Class Objeto_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarObjeto($objeto)
    {
    	$obj['obj_usu_id']			= $objeto['usu_id'];
    	$obj['obj_tip_id']			= $objeto['tipo'];
    	$obj['obj_sub_id']			= $objeto['subtipo'];
    	$obj['obj_ssu_id']			= $objeto['subsubtipo'];
    	$obj['obj_res_id']			= $objeto['responsavel'];
    	$obj['obj_nome']			= addslashes($objeto['nome']);
    	$obj['obj_resumo']			= addslashes($objeto['resumo']);
    	$obj['obj_link_video']		= addslashes($objeto['link_video']);
    	$obj['obj_link_site']		= addslashes($objeto['link_site']);
    	$obj['obj_link_facebook']	= addslashes($objeto['link_facebook']);
    	$obj['obj_link_youtube']	= addslashes($objeto['link_youtube']);
    	$obj['obj_link_redesocial']	= addslashes($objeto['link_redesocial']);
    	$obj['obj_info']			= addslashes($objeto['info']);
    	$obj['obj_publico']			= $objeto['publico'];
    	$obj['obj_criado_em'] 		= date("Y-m-d H:i:s");
    	$obj['obj_modificado_em'] 	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_objeto',$obj);
    	return $this->db->insert_id();  	
    } 
    
    public function editarObjeto($objeto)
    {
    	$obj['obj_usu_id']			= $objeto['usu_id'];
    	$obj['obj_sub_id']			= $objeto['subtipo'];
    	$obj['obj_ssu_id']			= $objeto['subsubtipo'];
    	$obj['obj_res_id']			= $objeto['responsavel'];
    	$obj['obj_nome']			= addslashes($objeto['nome']);
    	$obj['obj_resumo']			= addslashes($objeto['resumo']);
    	$obj['obj_foto1']			= $objeto['id'].'_foto.jpg';
    	$obj['obj_link_video']		= addslashes($objeto['link_video']);
    	$obj['obj_link_site']		= addslashes($objeto['link_site']);
    	$obj['obj_link_facebook']	= addslashes($objeto['link_facebook']);
    	$obj['obj_link_youtube']	= addslashes($objeto['link_youtube']);
    	$obj['obj_link_redesocial']	= addslashes($objeto['link_redesocial']);
    	$obj['obj_info']			= addslashes($objeto['info']);
    	$obj['obj_publico']			= $objeto['publico'];
    	$obj['obj_modificado_em'] 	= date("Y-m-d H:i:s");
    	
    	$this->db->where('obj_id',$objeto['id']);
    	$this->db->update('tbl_objeto',$obj);	    	
    } 
    
    public function excluirObjeto($objId)
    {
    	$this->load->model('Area_model','area');
    	$this->load->model('Financiamento_model','financiamento');
    	$this->load->model('Produto_model','produto');
    	$this->load->model('Equipamento_model','equipamento');
    	
    	$this->area->excluirAtuacaoObjeto($objId);
    	$this->financiamento->excluirFinanciamentoObjeto($objId);
    	$this->produto->excluirProduto($objId);
    	$this->equipamento->excluirEquipamento($objId);
    	
    	if(file_exists('./uploads/obj_img/'.$objId.'_foto.jpg')){
    		@unlink('./uploads/obj_img/'.$objId.'_foto.jpg');
    		@unlink('./uploads/obj_img/'.$objId.'_thumb.jpg');
    	}
    	
    	$this->db->where('obj_id',$objId);
    	$this->db->delete('tbl_objeto');	    		
    }
        
    public function getObjetos($usuId)
    {
    	$this->load->model('Tipo_model','tipo');
    	    	
		$this->db->join('tbl_responsavel','tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	$this->db->where('obj_usu_id',$usuId);
    	$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_objeto');
    	$result = $query->result();
    	
    	foreach ($result as $objeto){
			$subsubtipo = $this->tipo->getDadosSubsubtipo($objeto->obj_ssu_id);
			$objeto->subsubtipo_nome = $subsubtipo->ssu_nome;
    	}
    	
        return $result;
    }
    
    public function getObjetosByResponsavel($resId)
    {
    	$this->load->model('Tipo_model','tipo');
    	    	
		$this->db->join('tbl_responsavel','tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	$this->db->where('obj_res_id',$resId);
    	$this->db->where('obj_publico >','0');
    	$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_objeto');
    	$result = $query->result();
    	
    	foreach ($result as $objeto){
			$subsubtipo = $this->tipo->getDadosSubsubtipo($objeto->obj_ssu_id);
			$objeto->subsubtipo_nome = $subsubtipo->ssu_nome;
    	}
    	
        return $result;
    }
        
    public function getObjetosPublicos()
    {
    	$this->load->model('Tipo_model','tipo');
    	    	
		$this->db->join('tbl_responsavel','tbl_responsavel.res_id = tbl_objeto.obj_res_id');
		$this->db->where('obj_publico >','0');
		$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_objeto');
    	$result = $query->result();
    	
    	foreach ($result as $objeto){
			$subsubtipo = $this->tipo->getDadosSubsubtipo($objeto->obj_ssu_id);
			$objeto->subsubtipo_nome = $subsubtipo->ssu_nome;
    	}
    	
        return $result;
    }

    public function getObjetosPublicosByFiltro($filtro)
    {
    	$this->load->model('Tipo_model','tipo');
    	
   		$this->db->join('tbl_responsavel', 'tbl_responsavel.res_id = tbl_objeto.obj_res_id');

    	if((!empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    		$this->db->like('res_instituicao',$filtro['responsavel']);
    	} elseif((!empty($filtro['tipo'])) && (empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    	} elseif((empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->like('res_instituicao',$filtro['responsavel']);
       	}

    	$this->db->where('obj_publico >','0');
    	$this->db->like('obj_nome',$filtro['nome']);
    	$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_objeto');
    	$result = $query->result();
    	
        foreach ($result as $objeto){
			$subsubtipo = $this->tipo->getDadosSubsubtipo($objeto->obj_ssu_id);
			$objeto->subsubtipo_nome = $subsubtipo->ssu_nome;
    	}
    	
        return $result;
    }
    
    public function getMeusObjetosByFiltro($filtro)
    {
    	$this->load->model('Tipo_model','tipo');
    	
    	$this->db->join('tbl_responsavel', 'tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	    		
    	if((!empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    		$this->db->like('res_instituicao',$filtro['responsavel']);
    	} elseif((!empty($filtro['tipo'])) && (empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    	} elseif((empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->like('res_instituicao',$filtro['responsavel']);
       	}

    	$this->db->where('obj_usu_id',$filtro['usu_id']);
    	$this->db->like('obj_nome',$filtro['nome']);
    	$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_objeto');
    	$result = $query->result();
    	
        foreach ($result as $objeto){
			$subsubtipo = $this->tipo->getDadosSubsubtipo($objeto->obj_ssu_id);
			$objeto->subsubtipo_nome = $subsubtipo->ssu_nome;
    	}
    	
        return $result;
    }
   
        
    public function getObjetosByFiltro($filtro)
    {
    	$this->load->model('Tipo_model','tipo');

    	$this->db->join('tbl_responsavel', 'tbl_responsavel.res_id = tbl_objeto.obj_res_id');
    	
    	if((!empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    		$this->db->where('obj_res_id',$filtro['responsavel']);
    	} elseif((!empty($filtro['tipo'])) && (empty($filtro['responsavel']))){
    		$this->db->where('obj_ssu_id',$filtro['tipo']);
    	} elseif((empty($filtro['tipo'])) && (!empty($filtro['responsavel']))){
    		$this->db->where('obj_res_id',$filtro['responsavel']);
    	}
    		    	
    	$this->db->like('obj_nome',$filtro['nome']);
    	$this->db->order_by('obj_nome');
    	$query = $this->db->get('tbl_objeto');
    	$result = $query->result();
    	
        foreach ($result as $objeto){
			$subsubtipo = $this->tipo->getDadosSubsubtipo($objeto->obj_ssu_id);
			$objeto->subsubtipo_nome = $subsubtipo->ssu_nome;
    	}
    	
        return $result;
    }    
    
    public function getDadosObjeto($objId)
    {
        $this->load->model('Responsavel_model','responsavel');
    	$this->load->model('Financiamento_model','financiamento');
    	$this->load->model('Area_model','area');
    	$this->load->model('Tipo_model','tipo');
    	
    	$this->db->where('obj_id',$objId);
    	$query = $this->db->get('tbl_objeto');
        $result = reset($query->result());
        
        $responsavel = $this->responsavel->getDadosResponsavel($result->obj_res_id);
        $result->responsavel_nome = $responsavel->res_nome;
        $result->responsavel_id = $responsavel->res_id;
        $result->financiamentos = $this->financiamento->getObjetoFinancimentos($objId);
        $result->areas = $this->area->getObjetoAreas($objId);
        
        $subsubtipo = $this->tipo->getDadosSubsubtipo($result->obj_ssu_id);
        $subtipo = $this->tipo->getDadosSubtipo($result->obj_sub_id);
        $tipo = $this->tipo->getDadosTipo($result->obj_tip_id);
        
        $result->subsubtipo_nome = $subsubtipo->ssu_nome;
        $result->subtipo_nome = $subtipo->sub_nome;
        $result->tipo_nome = $tipo->tip_nome;
        
        if($result->obj_tip_id == 3){
        	$this->load->model('Equipamento_model','equipamento');
        	$result->equipamento = $this->equipamento->getDadosEquipamento($objId);
        } else {
        	$this->load->model('Produto_model','produto');
        	$result->produto = $this->produto->getDadosProduto($objId);
        } 
        
        return $result;
    }
    
    public function cadastrarFoto($objId)
    {
    	$obj['obj_foto1'] = $objId.'_foto.jpg';
    	
    	$this->db->where('obj_id',$objId);
    	$this->db->update('tbl_objeto',$obj);	    	
    } 
    
    public function cadastrarAreaAtuacao($areas,$objId)
    {
    	$this->db->where('atu_obj_id',$objId);
    	$this->db->delete('tbl_atuacao');	  	
    	
    	foreach ($areas as $area){
    		$atuacao['atu_obj_id'] = $objId;
    		$atuacao['atu_are_id'] = $area;
    		$this->db->insert('tbl_atuacao',$atuacao);
    	}
    }
    
    public function cadastrarFinanciamento($financiamentos,$objId)
    {
    	$this->db->where('fio_obj_id',$objId);
    	$this->db->delete('tbl_financiamento_objeto');	  	
    	
    	foreach ($financiamentos as $financiamento){
    		$finan['fio_obj_id'] = $objId;
    		$finan['fio_fin_id'] = $financiamento;
    		$this->db->insert('tbl_financiamento_objeto',$finan);
    	}
    }
    
    public function getEventosCount($usuId = '')
    {
    	if($usuId)
    		$this->db->where('obj_usu_id',$usuId);
    	else 
    		$this->db->where('obj_publico >','0');
    	
    	$this->db->where('obj_tip_id','1');	
		    		
    	$result = $this->db->count_all_results('tbl_objeto');
    	
        return $result;
    }
    
    public function getProdutosCount($usuId = '')
    {
    	if($usuId)
    		$this->db->where('obj_usu_id',$usuId);
    	else 
    		$this->db->where('obj_publico >','0');
    		
    	$this->db->where('obj_tip_id','2');	
		    		
    	$result = $this->db->count_all_results('tbl_objeto');
    	
        return $result;
    }

    public function getEquipamentosCount($usuId = '')
    {
    	if($usuId)
    		$this->db->where('obj_usu_id',$usuId);
    	else 
    		$this->db->where('obj_publico >','0');
    		
    	$this->db->where('obj_tip_id','3');	
		    		
    	$result = $this->db->count_all_results('tbl_objeto');
    	
        return $result;
    }
    
        
}
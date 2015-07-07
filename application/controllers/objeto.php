<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Objeto extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_objeto';
		$data['titulo_pagina'] = 'Objetos Culturais';
		$data['redirect'] = true;

		$this->load->helper(array('form', 'url'));
		$this->load->model('Tipo_model','tipo');
		$this->load->model('Objeto_model','objeto');
		$this->load->model('Responsavel_model','responsavel');
		
		$data['tipos'] = $this->tipo->getTipos();
		$data['objetos'] = $this->objeto->getObjetos($this->session->userdata('usu_id'));
		$data['responsaveis'] = $this->responsavel->getResponsaveis($this->session->userdata('usu_id'));
		
		$data['objetosEncontrados'] = count($data['objetos']);
		
		$this->load->view('objeto',$data);
	}

	public function evento($eveId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '';
		$data['titulo_pagina'] = 'Objetos Culturais';
		$data['redirect'] = false;

		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($eveId);
		$data['atracoesEvento'] = $this->evento->getAtracoesEvento($eveId);
		
		$this->load->model('Local_model','local');
		$data['locaisEvento'] = $this->local->getLocaisEvento($eveId);
		
		$this->load->view('objeto_evento',$data);
	}
	
	public function novo()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_objeto';
		$data['titulo_pagina'] = 'Novo Objeto Cultural';
		$data['redirect'] = true;
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Responsavel_model','responsavel');
		$data['responsaveis'] = $this->responsavel->getResponsaveis($this->session->userdata('usu_id'));
		
		$this->load->model('Tipo_model','tipo');
		$data['tipos'] = $this->tipo->getTipos();
		
		$this->load->model('Area_model','area');
		$data['areas'] = $this->area->getAreas();
		
		$this->load->model('Financiamento_model','financiamento');
		$data['financiamentos'] = $this->financiamento->getFinanciamentos();
		
		$this->load->view('objeto_form',$data);
	}
	
	public function editar($objId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_objeto';
		$data['titulo_pagina'] = 'Editar Objeto Cultural';
		$data['redirect'] = true;
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->model('Objeto_model','objeto');
		$data['objeto'] = $this->objeto->getDadosObjeto($objId);
		
		if(($this->session->userdata('usu_id')) && ($data['objeto']->obj_usu_id == $this->session->userdata('usu_id'))){
			
			$data['financiamento_objeto'] = array();
			$data['atuacao'] = array();
			
			foreach ($data['objeto']->financiamentos as $financiamento)
				array_push($data['financiamento_objeto'],$financiamento->fin_id);
	
			foreach ($data['objeto']->areas as $area)
				array_push($data['atuacao'],$area->are_id);
				
			$this->load->model('Tipo_model','tipo');
			$data['tipos'] = $this->tipo->getTipos();
			$data['subtipos'] = $this->tipo->getSubtipos($data['objeto']->obj_tip_id);
			$data['subsubtipos'] = $this->tipo->getSubsubtipos($data['objeto']->obj_sub_id);
			
			$this->load->model('Area_model','area');
			$data['areas'] = $this->area->getAreas();
			
			$this->load->model('Financiamento_model','financiamento');
			$data['financiamentos'] = $this->financiamento->getFinanciamentos();
			
			$this->load->view('objeto_form',$data);
		
		} else {
			$this->session->set_userdata('msg_erro','Acesso negado!');
			redirect('eva');
		}
		
	}
	
	public function cadastrar()
	{
		if(isset($_POST['objeto'])){
			
			$objeto = $_POST['objeto'];
			$objeto['usu_id'] = $this->session->userdata('usu_id');
			
			if(empty($objeto['area']))
				$objeto['area'] = array();
			
			if(empty($objeto['financiamento']))
				$objeto['financiamento'] = array();
				
			$this->load->model('Objeto_model','objeto'); 
			
			if(!empty($objeto['id'])){
				
				$this->objeto->editarObjeto($objeto);
				
				$this->objeto->cadastrarAreaAtuacao($objeto['area'],$objeto['id']);
				$this->objeto->cadastrarFinanciamento($objeto['financiamento'],$objeto['id']);
				
				//edição de equipamento
				if($objeto['tipo'] == '3'){
					
					$equipamento = $_POST['equipamento'];
					$equipamento['obj_id'] = $objeto['id'];
					
					$this->load->model('Equipamento_model','equipamento');
					$this->equipamento->editarEquipamento($equipamento);
					
				} else {

					//edição de produto/evento
					$produto = $_POST['produto'];
					$produto['obj_id'] = $objeto['id'];
					
					$this->load->model('Produto_model','produto');
					$this->produto->editarProduto($produto);

				}

				//upload da imagem
				$config['upload_path'] = './uploads/obj_img/';
				$config['allowed_types'] = 'jpg';
				$config['max_size']	= '4096';
				$config['overwrite'] = true;
				$config['file_name'] = $objeto['id'].'_foto.jpg';
				
				$this->load->library('upload', $config);
					
				if (!$this->upload->do_upload()){
					if($this->upload->display_errors() != "<p>Você não selecionou o arquivo para fazer upload.</p>")		
						$this->session->set_userdata('msg_erro',$this->upload->display_errors());
				}else{
					$config_res['image_library'] = 'gd2';
					$config_res['source_image']	= './uploads/obj_img/'.$objeto['id'].'_foto.jpg';
					$config_res['new_image'] = './uploads/obj_img/'.$objeto['id'].'_thumb.jpg';
					$config_res['maintain_ratio'] = TRUE;
					$config_res['width'] = 82;
					$config_res['height'] = 82;
					
					$this->load->library('image_lib', $config_res); 
					
					$this->image_lib->resize();
					
				}	

				$this->session->set_userdata('msg_sucesso','Objeto editado com sucesso!<br>Você já se inscreveu no <a href="http://www.sistemaeva.com.br/evento/inscricao/6">FICA - Festival Integrado de Cultura e Arte</a>?');
				
			} else {
				
				$objId = $this->objeto->cadastrarObjeto($objeto);
				
				$this->objeto->cadastrarFoto($objId);
				
				$this->objeto->cadastrarAreaAtuacao($objeto['area'],$objId);
				$this->objeto->cadastrarFinanciamento($objeto['financiamento'],$objId);
				
				//cadastro de equipamento
				if($objeto['tipo'] == '3'){
					
					$equipamento = $_POST['equipamento'];
					$equipamento['obj_id'] = $objId;
					
					$this->load->model('Equipamento_model','equipamento');
					$this->equipamento->cadastrarEquipamento($equipamento);
					
				} else {
				
					//cadastro de produto
					$produto = $_POST['produto'];
					$produto['obj_id'] = $objId;
					
					$this->load->model('Produto_model','produto');
					$this->produto->cadastrarProduto($produto);

				}

				//upload da imagem
				$config['upload_path'] = './uploads/obj_img/';
				$config['allowed_types'] = 'jpg';
				$config['max_size']	= '2048';
				$config['overwrite'] = true;
				$config['file_name'] = $objId.'_foto.jpg';
				
				$this->load->library('upload', $config);
					
				if (!$this->upload->do_upload()){
					if($this->upload->display_errors() != "<p>Você não selecionou o arquivo para fazer upload.</p>")
						$this->session->set_userdata('msg_erro',$this->upload->display_errors());
				}else{
					$config_res['image_library'] = 'gd2';
					$config_res['source_image']	= './uploads/obj_img/'.$objId.'_foto.jpg';
					$config_res['new_image'] = './uploads/obj_img/'.$objId.'_thumb.jpg';
					$config_res['maintain_ratio'] = TRUE;
					$config_res['width'] = 82;
					$config_res['height'] = 82;
					
					$this->load->library('image_lib', $config_res); 
					
					$this->image_lib->resize();
					
				}
				
				$this->session->set_userdata('msg_sucesso','Objeto cadastrado com sucesso!<br>Você já pode inscrevê-lo no <a href="http://www.sistemaeva.com.br/evento/inscricao/6">FICA - Festival Integrado de Cultura e Arte</a>!');
				
			}
			
			redirect('objeto');
			
		}		

	}
	
	public function excluir($objId)
	{
		$this->load->model('Objeto_model','objeto');
		$objeto = $this->objeto->getDadosObjeto($objId);
		
		if(($this->session->userdata('usu_id')) && ($objeto->obj_usu_id == $this->session->userdata('usu_id'))){
		
			//TODO ativar/desativar objeto
			$this->load->model('Objeto_model','objeto');
			$this->objeto->excluirObjeto($objId);
					
			$this->session->set_userdata('msg_sucesso','Objeto excluído com sucesso!');
			redirect('objeto');
		
		} else {
			$this->session->set_userdata('msg_erro','Acesso negado!');
			redirect('eva');
		}
	}
	
	public function filtrar()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_objeto';
		$data['titulo_pagina'] = 'Objetos Culturais';
		$data['redirect'] = true;
		
		$filtro = $_GET['objeto'];
		
		$this->load->model('Tipo_model','tipo');
		$data['tipos'] = $this->tipo->getTipos();

		$this->load->model('Responsavel_model','responsavel');
		$data['responsaveis'] = $this->responsavel->getResponsaveis($this->session->userdata['usu_id']);

		$this->load->model('Objeto_model','objeto');
		$data['objetos'] = $this->objeto->getObjetosByFiltro($filtro);
		
		$data['filtro'] = $filtro['nome'];
		$data['tipo_filtro'] = $filtro['tipo'];
		$data['responsavel_filtro'] = $filtro['responsavel'];
		
		$data['objetosEncontrados'] = count($data['objetos']);
		
		$this->load->view('objeto',$data);			
	}
	
	public function show($objId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_objeto';
		$data['titulo_pagina'] = 'Objetos Culturais';
		$data['redirect'] = false;
		
		$this->load->model('Objeto_model','objeto');
		$data['objeto'] = $this->objeto->getDadosObjeto($objId);
		
		if($data['objeto']->obj_tip_id == '1'){
			$this->load->model('Evento_model','evento');
			$data['eventos'] = $this->evento->getEventosRealizados($objId);
		}
	
		$this->load->view('objeto_show',$data);
	}
	
	public function carregaSubtipo($tipId)
	{
		$this->load->model('Tipo_model','tipo');
		$subtipos = $this->tipo->getSubtipos($tipId);
		
		$option = '<option value="">Selecione...</option>';
		
		foreach ($subtipos as $subtipo){
			$option .= '<option value="'.$subtipo->sub_id.'">'.$subtipo->sub_nome.'</option>';
		}
		
		echo $option;
	}

	public function carregaSubsubtipo($subId)
	{
		$this->load->model('Tipo_model','tipo');
		$subsubtipos = $this->tipo->getSubsubtipos($subId);
		
		$option = '<option value="">Selecione...</option>';
		
		foreach ($subsubtipos as $subsubtipo){
			$option .= '<option value="'.$subsubtipo->ssu_id.'">'.$subsubtipo->ssu_nome.'</option>';
		}
		
		echo $option;
	}

}
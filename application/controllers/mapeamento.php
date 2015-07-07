<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapeamento extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_mapeamento';
		$data['titulo_pagina'] = 'Cadastro de Objetos Culturais';
		$data['redirect'] = false;
		$data['roteiro'] = 'roteiro/roteiro_mapeamento';
		
		$this->load->model('Objeto_model','objeto');
		
		if($this->session->userdata('usu_id')){
			$data['meus_eventos'] = $this->objeto->getEventosCount($this->session->userdata('usu_id'));
			$data['meus_produtos'] = $this->objeto->getProdutosCount($this->session->userdata('usu_id'));
			$data['meus_equipamentos'] = $this->objeto->getEquipamentosCount($this->session->userdata('usu_id'));
			$data['meus_total'] = $data['meus_eventos'] + $data['meus_produtos'] + $data['meus_equipamentos'];
			$data['usuId'] = $this->session->userdata('usu_id');
		}
		
		$data['eventos'] = $this->objeto->getEventosCount();
		$data['produtos'] = $this->objeto->getProdutosCount();
		$data['equipamentos'] = $this->objeto->getEquipamentosCount();
		$data['total'] = $data['eventos'] + $data['produtos'] + $data['equipamentos'];
		$data['usuId'] = '';
		
		$this->load->view('mapeamento',$data);
	}
	
	public function show($usuId = ''){
		
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		
		$this->load->model('Objeto_model','objeto');
		$this->load->model('Tipo_model','tipo');
		
		$subtipos1 = $this->tipo->getSubtipos('1');
		$subtipos2 = $this->tipo->getSubtipos('2');
		$subtipos3 = $this->tipo->getSubtipos('3');
		$data['subtipos'] = array_merge($subtipos1,$subtipos2,$subtipos3);
		$data['subsubtipos'] = $this->tipo->getProdutosEventos($data['subtipos']);
		
		if($usuId){
			
			$data['menu_ativo'] = '.im_meusobjetos';
			$data['titulo_pagina'] = 'Meus Objetos Culturais cadastrados';
			$data['redirect'] = true;
			$data['usuId'] = $usuId;
			
			$data['objetos'] = $this->objeto->getObjetos($this->session->userdata('usu_id'));
			$data['objetosEncontrados'] = count($data['objetos']);
			
			$this->load->view('objetosmapeados',$data);
			
		} else {
			
			$data['menu_ativo'] = '.im_objetospublicos';
			$data['titulo_pagina'] = 'Objetos Culturais cadastrados';
			$data['redirect'] = false;
			$data['usuId'] = '';
			
			$data['objetos'] = $this->objeto->getObjetosPublicos();
			$data['objetosEncontrados'] = count($data['objetos']);
			
			$this->load->view('objetosmapeados',$data);
			
		}
			
	}

	public function filtrar($usuId = ''){
		
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		
		$filtro = $_GET['objeto'];
		
		$this->load->model('Objeto_model','objeto');

		$this->load->model('Tipo_model','tipo');
		$subtipos1 = $this->tipo->getSubtipos('1');
		$subtipos2 = $this->tipo->getSubtipos('2');
		$subtipos3 = $this->tipo->getSubtipos('3');
		$data['subtipos'] = array_merge($subtipos1,$subtipos2,$subtipos3);
		$data['subsubtipos'] = $this->tipo->getProdutosEventos($data['subtipos']);

		if($filtro['nome'])
			$data['filtro'] = $filtro['nome'];
		elseif($filtro['tipo']){
			$tipo = $this->tipo->getDadosSubsubtipo($filtro['tipo']);
			$data['filtro'] = $tipo->ssu_nome;
		}else
			$data['filtro'] = $filtro['responsavel'];
				
		if($usuId){
			
			$data['menu_ativo'] = '.im_meusobjetos';
			$data['titulo_pagina'] = 'Meus Objetos Culturais cadastrados';
			$data['redirect'] = true;
			$data['usuId'] = $usuId;
			
			$filtro['usu_id'] = $usuId;
			$data['objetos'] = $this->objeto->getMeusObjetosByFiltro($filtro);
			$data['objetosEncontrados'] = count($data['objetos']);
			
			$this->load->view('objetosmapeados',$data);
			
		} else {
			
			$data['menu_ativo'] = '.im_objetospublicos';
			$data['titulo_pagina'] = 'Objetos Culturais cadastrados';
			$data['redirect'] = false;
			$data['usuId'] = '';
			
			$data['objetos'] = $this->objeto->getObjetosPublicosByFiltro($filtro);
			$data['objetosEncontrados'] = count($data['objetos']);
			
			$this->load->view('objetosmapeados',$data);
			
		}
			
	}
		
}
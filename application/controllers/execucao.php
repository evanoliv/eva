<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Execucao extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'execucao';
		$data['menu_ativo'] = '.im_execucao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_execucao';
		
		$this->load->view('execucao',$data);
	}	
	
	public function coordenacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'execucao';
		$data['menu_ativo'] = '.im_execucao, .im_coordenacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_execucao_coordenacao';
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$data['diasEvento'] = $this->evento->getDiasEvento($data['evento']->eve_data_inicial,$data['evento']->eve_data_final);
		
		$this->load->model('Participacao_model','participacao');
		$data['participacoes'] = $this->participacao->getParticipacaoCoordenacao($this->session->userdata('eve_id'));
		
		$this->load->view('execucao_coordenacao',$data);
	}	
	
	public function novoParticipacao($tipo)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'execucao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Apresentacao_model','apresentacao');
		$data['apresentacoes'] = $this->apresentacao->getApresentacoesByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Papel_model','papel');
		
		if($tipo == "coordenacao"){
			$data['menu_ativo'] = '.im_execucao, .im_coordenacao';
			$data['roteiro'] = 'roteiro/roteiro_execucao_coordenacao';
			$data['papeis'] = $this->papel->getCoordenadoresEvento($this->session->userdata('eve_id'));
		}else{
			$data['menu_ativo'] = '.im_execucao, .im_producao';
			$data['roteiro'] = 'roteiro/roteiro_execucao_producao';
			$data['papeis'] = $this->papel->getProdutoresEvento($this->session->userdata('eve_id'));
		}
		
		$this->load->view('execucao_coordenacao_form',$data);
	}	
	
	public function cadastrarParticipacao()
	{
		if(isset($_POST['participacao'])){
			
			$participacao = $_POST['participacao'];
			$participacao['evento'] = $this->session->userdata('eve_id');
			
			$this->load->model('Participacao_model','participacao');
			
			if($participacao['id'] == ''){
				if($this->participacao->cadastrarParticipacao($participacao))
					$this->session->set_userdata('msg_sucesso','Participação cadastrada com sucesso!');
				else 
					$this->session->set_userdata('msg_erro','Este usuário já participa desta apresentação.');
			} else {
				if($this->participacao->editarParticipacao($participacao))
					$this->session->set_userdata('msg_sucesso','Participação editada com sucesso!');
				else 
					$this->session->set_userdata('msg_erro','Este usuário já participa desta apresentação.');
			}

			redirect('execucao/coordenacao');
			
		}		
	}
	
	public function editarParticipacao($parId,$tipo='coordenacao')
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'execucao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Participacao_model','participacao');
		$data['participacao'] = $this->participacao->getDadosParticipacao($parId);
		
		$this->load->model('Apresentacao_model','apresentacao');
		$data['apresentacoes'] = $this->apresentacao->getApresentacoesByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Papel_model','papel');
		
		if($tipo == "coordenacao"){
			$data['menu_ativo'] = '.im_execucao, .im_coordenacao';
			$data['roteiro'] = 'roteiro/roteiro_execucao_coordenacao';
			$data['papeis'] = $this->papel->getCoordenadoresEvento($this->session->userdata('eve_id'));
		}else{
			$data['menu_ativo'] = '.im_execucao, .im_producao';
			$data['roteiro'] = 'roteiro/roteiro_execucao_producao';
			$data['papeis'] = $this->papel->getProdutoresEvento($this->session->userdata('eve_id'));
		}
		
		$this->load->view('execucao_coordenacao_form',$data);
	}
	
	public function excluirParticipacao($parId)
	{
		$this->load->model('Participacao_model','participacao');
		$this->participacao->excluirParticipacao($parId);
				
		$this->session->set_userdata('msg_sucesso','Participacao excluída com sucesso!');
		redirect('execucao/coordenacao');
	}

	public function producao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'execucao';
		$data['menu_ativo'] = '.im_execucao, .im_producao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_execucao_producao';
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$data['diasEvento'] = $this->evento->getDiasEvento($data['evento']->eve_data_inicial,$data['evento']->eve_data_final);
		
		$this->load->model('Participacao_model','participacao');
		$data['participacoes'] = $this->participacao->getParticipacaoProducao($this->session->userdata('eve_id'));
		
		$this->load->view('execucao_producao',$data);
	}	
	
}
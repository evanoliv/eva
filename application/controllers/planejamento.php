<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planejamento extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento';
		
		$this->load->view('planejamento',$data);
	}	

	public function equipe()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_equipe';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_equipe';
		
		$this->load->view('planejamento_equipe',$data);
	}
	
	public function atracao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_atracao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_atracao';

		$this->load->model('Evento_model','evento');
		$data['objetos'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');
		
		$cacheTotal = 0;
		
		foreach ($data['objetos'] as $objeto)
			$cacheTotal = $cacheTotal + $objeto->atr_custo; 
		
		$data['cacheTotal'] = $cacheTotal; 		
		
		$this->load->view('planejamento_atracao',$data);
	}
	
	public function programacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_programacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_programacao';
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$data['diasEvento'] = $this->evento->getDiasEvento($data['evento']->eve_data_inicial,$data['evento']->eve_data_final);

		$this->load->model('Apresentacao_model','apresentacao');
		$data['apresentacoes'] = $this->apresentacao->getApresentacoesByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_programacao',$data);
	}	
	
	public function novoApresentacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_programacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_programacao';
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');
		
		$this->load->model('Local_model','local');
		$data['locais'] = $this->local->getLocaisEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_programacao_form',$data);
	}	
	
	public function cadastrarApresentacao()
	{
		if(isset($_POST['apresentacao'])){
			
			$apresentacao = $_POST['apresentacao'];
			
			$this->load->model('Apresentacao_model','apresentacao');
			
			if($apresentacao['id'] == ''){
				$this->apresentacao->cadastrarApresentacao($apresentacao);
				$this->session->set_userdata('msg_sucesso','Apresentação cadastrada com sucesso!');
			} else {
				$this->apresentacao->editarApresentacao($apresentacao);
				$this->session->set_userdata('msg_sucesso','Apresentação editada com sucesso!');
			}
				
			redirect('planejamento/programacao');
			
		}		
	}
	
	public function showApresentacao($aprId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_programacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_programacao';
		
		$this->load->model('Apresentacao_model','apresentacao');
		$data['apresentacao'] = $this->apresentacao->getDadosApresentacao($aprId);
		
		$this->load->model('Participacao_model','participacao');
		$data['apresentacao']->coordenadores = $this->participacao->getCoordenadoresByApresentacao($aprId);
		$data['apresentacao']->produtores = $this->participacao->getProdutoresByApresentacao($aprId);
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');
		
		$this->load->model('Local_model','local');
		$data['locais'] = $this->local->getLocaisEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_programacao_show',$data);
	}
	
	public function editarApresentacao($aprId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_programacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_programacao';
		
		$this->load->model('Apresentacao_model','apresentacao');
		$data['apresentacao'] = $this->apresentacao->getDadosApresentacao($aprId);
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');
		
		$this->load->model('Local_model','local');
		$data['locais'] = $this->local->getLocaisEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_programacao_form',$data);
	}
	
	public function excluirApresentacao($aprId)
	{
		$this->load->model('Apresentacao_model','apresentacao');
		$return = $this->apresentacao->excluirApresentacao($aprId); 
		
		if($return)
			$this->session->set_userdata('msg_sucesso','Apresentação excluída com sucesso!');
		else 
			$this->session->set_userdata('msg_erro','Apresentação nao pode ser excluída!<br>Verifique se ela está sendo usada em alguma outra ação do evento.');
			
		redirect('planejamento/programacao');
	}
	
	public function divulgacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_divulgacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_divulgacao';
		
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefas'] = $this->cronograma->getTarefasDivulgacao($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_divulgacao',$data);
	}	
	
	public function suporte()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Deslocamento_model','deslocamento');
		$data['deslocamentos'] = $this->deslocamento->getDeslocamentosByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Acomodacao_model','acomodacao');
		$data['acomodacoes'] = $this->acomodacao->getAcomodacoesByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte',$data);
	}
	
	public function novoDeslocamento()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Evento_model','evento');
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');		
		
		$this->load->model('Motorista_model','motorista');
		$data['motoristas'] = $this->motorista->getMotoristasByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Veiculo_model','veiculo');
		$data['veiculos'] = $this->veiculo->getVeiculosByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Local_model','local');
		$data['locais'] = $this->local->getLocaisEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagens'] = $this->hospedagem->getHospedagensByEvento($this->session->userdata('eve_id'));
				
		$this->load->view('planejamento_suporte_deslocamento_form',$data);
	}
	
	public function carregaEndereco($tipo,$id)
	{
		if($tipo == 'local'){
			
			$this->load->model('Local_model','local');
			$local = $this->local->getDadosLocal($id);
			
			$endereco =  $local->equ_endereco.', '.$local->equ_numero.' - '.$local->equ_complemento.' - '.$local->equ_bairro.' - ';
			$endereco .= $local->equ_cidade.' - '.$local->equ_estado.' - CEP: '.$local->equ_cep;
			
			echo $endereco; 
			
		} else {
			
			$this->load->model('Hospedagem_model','hospedagem');
			$hospedagem = $this->hospedagem->getDadosHospedagem($id);

			$endereco =  $hospedagem->hos_endereco.', '.$hospedagem->hos_numero.' - '.$hospedagem->hos_complemento.' - '.$hospedagem->hos_bairro.' - ';
			$endereco .= $hospedagem->hos_cidade.' - '.$hospedagem->hos_estado.' - CEP: '.$hospedagem->hos_cep;
			
			echo $endereco; 
						
		}
		
	}
	
	public function cadastrarDeslocamento()
	{
		if(isset($_POST['deslocamento'])){
			
			$deslocamento = $_POST['deslocamento'];
			$deslocamento['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Deslocamento_model','deslocamento'); 
			
			if(!empty($deslocamento['id'])){
				$this->deslocamento->editarDeslocamento($deslocamento);
				$this->session->set_userdata('msg_sucesso','Deslocamento editado com sucesso!');
			} else {
				$this->deslocamento->cadastrarDeslocamento($deslocamento);
				$this->session->set_userdata('msg_sucesso','Deslocamento cadastrado com sucesso!');
			}
			
			redirect('planejamento/suporte');
		}
	}
		
		
	public function showDeslocamento($desId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Deslocamento_model','deslocamento'); 
		$data['deslocamento'] = $this->deslocamento->getDadosDeslocamento($desId);
		
		$this->load->model('Evento_model','evento');
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');
		
		$this->load->model('Motorista_model','motorista');
		$data['motoristas'] = $this->motorista->getMotoristasByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Veiculo_model','veiculo');
		$data['veiculos'] = $this->veiculo->getVeiculosByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_deslocamento_show',$data);
	}
	
	public function editarDeslocamento($desId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Deslocamento_model','deslocamento'); 
		$data['deslocamento'] = $this->deslocamento->getDadosDeslocamento($desId);
		
		$this->load->model('Evento_model','evento');
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');
		
		$this->load->model('Motorista_model','motorista');
		$data['motoristas'] = $this->motorista->getMotoristasByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Veiculo_model','veiculo');
		$data['veiculos'] = $this->veiculo->getVeiculosByEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Local_model','local');
		$data['locais'] = $this->local->getLocaisEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagens'] = $this->hospedagem->getHospedagensByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_deslocamento_form',$data);
	}
	
	public function excluirDeslocamento($desId)
	{
		$this->load->model('Deslocamento_model','deslocamento');
		$this->deslocamento->excluirDeslocamento($desId);
				
		$this->session->set_userdata('msg_sucesso','Deslocamento excluído com sucesso!');
		redirect('planejamento/suporte');
	}

	public function novoAcomodacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Evento_model','evento');
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');		
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagens'] = $this->hospedagem->getHospedagensByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_acomodacao_form',$data);
	}

	public function cadastrarAcomodacao()
	{
		if(isset($_POST['acomodacao'])){
			
			$acomodacao = $_POST['acomodacao'];
			$acomodacao['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Acomodacao_model','acomodacao'); 
			
			if(!empty($acomodacao['id'])){
				$this->acomodacao->editarAcomodacao($acomodacao);
				$this->session->set_userdata('msg_sucesso','Acomodação editada com sucesso!');
			} else {
				$this->acomodacao->cadastrarAcomodacao($acomodacao);
				$this->session->set_userdata('msg_sucesso','Acomodação cadastrada com sucesso!');
			}
			
			redirect('planejamento/suporte');
		}
	}
	
	public function showAcomodacao($acoId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Acomodacao_model','acomodacao'); 
		$data['acomodacao'] = $this->acomodacao->getDadosAcomodacao($acoId);
		
		$this->load->model('Evento_model','evento');
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');		
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagens'] = $this->hospedagem->getHospedagensByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_acomodacao_show',$data);
	}
		
	public function editarAcomodacao($acoId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Acomodacao_model','acomodacao'); 
		$data['acomodacao'] = $this->acomodacao->getDadosAcomodacao($acoId);
		
		$this->load->model('Evento_model','evento');
		$data['atracoes'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'1');		
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagens'] = $this->hospedagem->getHospedagensByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_acomodacao_form',$data);
	}
	
	public function excluirAcomodacao($acoId)
	{
		$this->load->model('Acomodacao_model','acomodacao');
		$this->acomodacao->excluirAcomodacao($acoId);
				
		$this->session->set_userdata('msg_sucesso','Acomodação excluída com sucesso!');
		redirect('planejamento/suporte');
	}
		
	public function hospedagem()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagens'] = $this->hospedagem->getHospedagensByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_hospedagem',$data);
	}	
	
	public function novoHospedagem()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->view('planejamento_suporte_hospedagem_form',$data);
	}	
	
	public function cadastrarHospedagem()
	{
		if(isset($_POST['hospedagem'])){
			
			$hospedagem = $_POST['hospedagem'];
			$hospedagem['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Hospedagem_model','hospedagem'); 
			
			if(!empty($hospedagem['id'])){
				$this->hospedagem->editarHospedagem($hospedagem);
				$this->session->set_userdata('msg_sucesso','Hospedaria editada com sucesso!');
			} else {
				$this->hospedagem->cadastrarHospedagem($hospedagem);
				$this->session->set_userdata('msg_sucesso','Hospedaria cadastrada com sucesso!');
			}
			
			redirect('planejamento/hospedagem');
		}
	}
		
	public function editarHospedagem($hosId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagem'] = $this->hospedagem->getDadosHospedagem($hosId);
		
		$this->load->view('planejamento_suporte_hospedagem_form',$data);
	}
	
	public function showHospedagem($hosId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Hospedagem_model','hospedagem');
		$data['hospedagem'] = $this->hospedagem->getDadosHospedagem($hosId);
		
		$this->load->view('planejamento_suporte_hospedagem_show',$data);
	}
		
	public function excluirHospedagem($hosId)
	{
		$this->load->model('Hospedagem_model','hospedagem');
		$return = $this->hospedagem->excluirHospedagem($hosId);

		if($return)
			$this->session->set_userdata('msg_sucesso','Hospedaria excluída com sucesso!');
		else
			$this->session->set_userdata('msg_erro','Hospedaria nao pode ser excluída!<br>Verifique se ela está sendo usada em alguma Acomodação.');
			
		redirect('planejamento/hospedagem');
	}
	
	public function motorista()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Motorista_model','motorista');
		$data['motoristas'] = $this->motorista->getMotoristasByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_motorista',$data);
	}	
	
	public function novoMotorista()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->view('planejamento_suporte_motorista_form',$data);
	}
	
	public function cadastrarMotorista()
	{
		if(isset($_POST['motorista'])){
			
			$motorista = $_POST['motorista'];
			$motorista['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Motorista_model','motorista'); 
			
			if(!empty($motorista['id'])){
				$this->motorista->editarMotorista($motorista);
				$this->session->set_userdata('msg_sucesso','Motorista editado com sucesso!');
			} else {
				$this->motorista->cadastrarMotorista($motorista);
				$this->session->set_userdata('msg_sucesso','Motorista cadastrado com sucesso!');
			}

			redirect('planejamento/motorista');
			
		}
	}
	
	public function editarMotorista($motId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Motorista_model','motorista');
		$data['motorista'] = $this->motorista->getDadosMotorista($motId);
		
		$this->load->view('planejamento_suporte_motorista_form',$data);
	}
	
	public function showMotorista($motId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Motorista_model','motorista');
		$data['motorista'] = $this->motorista->getDadosMotorista($motId);
		
		$this->load->view('planejamento_suporte_motorista_show',$data);
	}	

	public function excluirMotorista($motId)
	{
		$this->load->model('Motorista_model','motorista');
		$return = $this->motorista->excluirMotorista($motId);

		if($return)
			$this->session->set_userdata('msg_sucesso','Motorista excluído com sucesso!');
		else 
			$this->session->set_userdata('msg_erro','Motorista não pode ser excluído!<br>Verifique se ele é utilizado em algum Deslocamento.');
			
		redirect('planejamento/motorista');
	}
	
	public function veiculo()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Veiculo_model','veiculo');
		$data['veiculos'] = $this->veiculo->getVeiculosByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_suporte_veiculo',$data);
	}	
	
	public function novoVeiculo()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->view('planejamento_suporte_veiculo_form',$data);
	}
	
	public function cadastrarVeiculo()
	{
		if(isset($_POST['veiculo'])){
			
			$veiculo = $_POST['veiculo'];
			$veiculo['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Veiculo_model','veiculo'); 
			
			if(!empty($veiculo['id'])){
				$this->veiculo->editarVeiculo($veiculo);
				$this->session->set_userdata('msg_sucesso','Veículo editado com sucesso!');
			} else {
				$this->veiculo->cadastrarVeiculo($veiculo);
				$this->session->set_userdata('msg_sucesso','Veículo cadastrado com sucesso!');
			}

			redirect('planejamento/veiculo');
			
		}
	}
	
	public function editarVeiculo($veiId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Veiculo_model','veiculo'); 
		$data['veiculo'] = $this->veiculo->getDadosVeiculo($veiId);
		
		$this->load->view('planejamento_suporte_veiculo_form',$data);
	}
	
	public function showVeiculo($veiId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_suporte';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_suporte';
		
		$this->load->model('Veiculo_model','veiculo');
		$data['veiculo'] = $this->veiculo->getDadosVeiculo($veiId);
		
		$this->load->view('planejamento_suporte_veiculo_show',$data);
	}	

	public function excluirVeiculo($veiId)
	{
		$this->load->model('Veiculo_model','veiculo');
		$return = $this->veiculo->excluirVeiculo($veiId);
				
		if($return)
			$this->session->set_userdata('msg_sucesso','Veículo excluído com sucesso!');
		else 
			$this->session->set_userdata('msg_erro','Veículo não pode ser excluído!<br>Verifique se ele é utilizado em algum Deslocamento.');
		
		redirect('planejamento/veiculo');
	}	
	
	public function infraestrutura()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_infraestrutura';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_infraestrutura';
		
		$tipoItens = '2'; //produção
		
		$this->load->model('Custo_model','custo');
		$data['custos'] = $this->custo->getCustos($this->session->userdata('eve_id'),$tipoItens);
		
		$custoTotal = 0;
		
		foreach ($data['custos'] as $custo)
			$custoTotal = $custoTotal + $custo->cus_valor; 
		
		$data['custoTotal'] = $custoTotal; 
		
		$this->load->view('planejamento_infraestrutura',$data);
	}
	
	public function convite()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_convite';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_convite';
		
		$this->load->view('planejamento_convite',$data);
	}
	
	public function montagem()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_montagem';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_montagem';
		
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefas'] = $this->cronograma->getTarefasProducao($this->session->userdata('eve_id'));
		
		$this->load->view('planejamento_montagem',$data);
	}
	
	public function novoCusto()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_infraestrutura';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_infraestrutura';
		
		$tipoItens = '2'; //produção
		
		$this->load->model('Custo_model','custo');
		$data['itens'] = $this->custo->getItens($tipoItens);
		
		$this->load->view('planejamento_infraestrutura_form',$data);
	}
	
	public function cadastrarCusto()
	{
		if(isset($_POST['custo'])){
			
			$custo = $_POST['custo'];
			$custo['eve_id'] = $this->session->userdata('eve_id');
			$custo['tipo'] = '2';
			
			$this->load->model('Custo_model','custo'); 
			
			if(!empty($custo['id'])){
				$this->custo->editarCusto($custo);
				$this->session->set_userdata('msg_sucesso','Custo editado com sucesso!');
				redirect('planejamento/infraestrutura');
			} else {
				$this->custo->cadastrarCusto($custo);
				$this->session->set_userdata('msg_sucesso','Custo cadastrado com sucesso!');
				redirect('planejamento/novoCusto');
			}
			
		}
	}
	
	public function editarCusto($cusId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_infraestrutura';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_infraestrutura';
		
		$tipoItens = '2'; //produção
		
		$this->load->model('Custo_model','custo');
		$data['itens'] = $this->custo->getItens($tipoItens);
		
		$data['custo'] = $this->custo->getCusto($cusId);
		
		$this->load->view('planejamento_infraestrutura_form',$data);
	}

	public function excluirCusto($cusId)
	{
		$this->load->model('Custo_model','custo');
		$this->custo->excluirCusto($cusId);
				
		$this->session->set_userdata('msg_sucesso','Custo excluído com sucesso!');
		redirect('planejamento/infraestrutura');
	}
	
	public function buscarAtracao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_inscrito';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_atracao';

		$this->load->model('Evento_model','evento');
		$data['objetos'] = $this->evento->getAtracoesEvento($this->session->userdata('eve_id'),'0');
		
		$this->load->model('Tipo_model','tipo');
		$subtipos1 = $this->tipo->getSubtipos('1');
		$subtipos2 = $this->tipo->getSubtipos('2');
		$data['subtipos'] = array_merge($subtipos1,$subtipos2);
		$data['subsubtipos'] = $this->tipo->getProdutosEventos($data['subtipos']);
		
		$data['objetosEncontrados'] = count($data['objetos']);
		
		$this->load->view('planejamento_atracao_inscritos',$data);
	}
	
	public function filtrarInscricao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_atracao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_planejamento_atracao';
		
		$filtro = $_GET['objeto'];
		
		$this->load->model('Tipo_model','tipo');
		$subtipos1 = $this->tipo->getSubtipos('1');
		$subtipos2 = $this->tipo->getSubtipos('2');
		$data['subtipos'] = array_merge($subtipos1,$subtipos2);
		$data['subsubtipos'] = $this->tipo->getProdutosEventos($data['subtipos']);

		$this->load->model('Evento_model','evento');
		$data['objetos'] = $this->evento->getInscritosByFiltro($this->session->userdata('eve_id'),$filtro);
		
		$data['filtro'] = $filtro['nome'];
		$data['tipo_filtro'] = $filtro['tipo'];
		$data['responsavel_filtro'] = $filtro['responsavel'];
		
		$data['objetosEncontrados'] = count($data['objetos']);
		
		$this->load->view('planejamento_atracao_inscritos',$data);			
	}
	
}
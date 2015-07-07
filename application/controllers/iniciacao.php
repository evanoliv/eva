<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iniciacao extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao';
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Custo_model','custo');
		
		$tipoItens = '1'; //préprodução
		$data['custoPreProducao'] = $this->custo->getSomaCustos($this->session->userdata('eve_id'),$tipoItens);
		
		$tipoItens = '2'; //produção
		$data['custoProducao'] = $this->custo->getSomaCustos($this->session->userdata('eve_id'),$tipoItens);
		
		$tipoItens = '4'; //recolhimento
		$data['custoRecolhimento'] = $this->custo->getSomaCustos($this->session->userdata('eve_id'),$tipoItens);
		
		$data['custoCache'] = $this->evento->getSomaCache($this->session->userdata('eve_id'));
		
		$this->load->model('Divulgacao_model','divulgacao');
		$data['custoDivulgacao'] = $this->divulgacao->getSomaDivulgacoes($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao',$data);
	}	
	
	public function equipe()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_equipe';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_equipe';
		
		$this->load->model('Papel_model','papel');
		$data['papeis'] = $this->papel->getPapeisByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao_equipe',$data);
	}	
		
	public function novoPapel()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_equipe';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_equipe';
		
		$this->load->view('iniciacao_equipe_convite',$data);
	}	
	
	public function enviarConvite()
	{
		if(isset($_POST['convite'])){
		
			$convite = $_POST['convite'];
			
			//gravando link encriptado no banco
			$this->load->model('Login_model','login');
			
			$string = 'iniciacao/cadastrarPapel/'.$this->session->userdata('eve_id').'/'.$convite['papel'];
			$funcao = $this->login->encrypto($string,$convite['email']);
			//gravando link encriptado no banco
			
			$this->load->library('email');

			$this->email->from('admin@sistemaeva.com.br', 'Sistema EVA');
			$this->email->to($convite['email']);
			
			$message = "Você foi convidado(a) para participar da gestão do evento ".$this->session->userdata('eve_nome').".";
			$message .= "\nClique no link abaixo para aceitar o convite: \n";
			$message .= 'www.sistemaeva.com.br/eva/decrypto/'.$funcao;
			
			$this->email->subject('Participe da gestão do evento '.$this->session->userdata('eve_nome'));
			$this->email->message($message);	
			
			$this->load->model('Papel_model','papel');
			$result = $this->papel->verificaPapelByEvento($this->session->userdata('eve_id'),$convite['email']);
			
			if($result){
				$this->session->set_userdata('msg_erro','Este usuário já faz parte da equipe deste evento!');
			} else if($this->email->send()){
				$this->session->set_userdata('msg_sucesso','Convite enviado com sucesso!');
			} else {
				$this->session->set_userdata('msg_erro','Houve um erro com o servidor de e-mail. Tente novamente mais tarde.');
			}
				
			redirect('iniciacao/equipe');
			
		}
	}
	
	public function cadastrarPapel($eveId,$papel)
	{
		if($this->session->userdata('usu_id')){
			
			$pap['evento'] = $eveId;
			$pap['usuario'] = $this->session->userdata('usu_id');
			$pap['papel'] = $papel;
				
			$this->load->model('Papel_model','papel');
			$this->papel->cadastrarPapel($pap);
			
			redirect('evento/home/'.$eveId);
			
		} else {

			$this->session->set_userdata('conviteEvento',$eveId);
			$this->session->set_userdata('papelEvento',$papel);
			
			redirect('login');	
		}
	}
	
	public function editarPapel($papId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_equipe';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_equipe';
		
		$this->load->model('Papel_model','papel');
		$data['papel'] = $this->papel->getDadosPapel($papId);
		
		$this->load->view('iniciacao_equipe_form',$data);		
	}
	
	public function alterarPapel()
	{
		if(isset($_POST['papel'])){
			
			$papel = $_POST['papel'];
			
			$this->load->model('Papel_model','papel');
			$this->papel->editarPapel($papel);
			
			$this->session->set_userdata('msg_sucesso','Membro editado com sucesso!');
			
			redirect('iniciacao/equipe');

		}
	}
	
	public function excluirPapel($papId)
	{
		$this->load->model('Papel_model','papel');
		if($this->papel->excluirPapel($papId))
			$this->session->set_userdata('msg_sucesso','Membro excluído com sucesso!');
		else 
			$this->session->set_userdata('msg_erro','Não foi possível excluir este membro.');
			
		redirect('iniciacao/equipe');
	}	
	
	public function definicao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_definicao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_definicao';
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		
		$this->load->model('Equipamento_model','equipamento');
		$data['equipamentos'] = $this->equipamento->getEquipamentos($this->session->userdata('usu_id'));
		
		$this->load->view('iniciacao_definicao',$data);
	}
	
	public function local()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_local';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_definicao';
		
		$this->load->model('Local_model','local');
		$data['locais'] = $this->local->getLocaisEvento($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao_local',$data);
	}
	
	public function cadastrarDefinicao()
	{
		if(isset($_POST['evento'])){
			
			$evento = $_POST['evento'];
			$evento['eve_id'] = $this->session->userdata('eve_id');
			
			$evento['publico'] = (isset($evento['publico'])) ? '1' : '0';
			$evento['inscricao'] = (isset($evento['inscricao'])) ? '1' : '0';
				
			$this->load->model('Evento_model','evento');
			$this->evento->cadastrarDefinicao($evento);
			$this->session->set_userdata('msg_sucesso','Definições iniciais cadastradas com sucesso!');
			
			redirect('iniciacao/definicao');
			
		}
	}
	
	public function novoLocal()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_local';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_definicao';
		
		$this->load->model('Equipamento_model','equipamento');
		$data['equipamentos'] = $this->equipamento->getEquipamentos($this->session->userdata('usu_id'));
		
		$data['objetosEncontrados'] = count($data['equipamentos']);
		
		$this->load->view('iniciacao_local_form',$data);		
	}
	
	public function filtrarLocal()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_local';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_definicao';
		
		$filtro = $_GET['equipamento'];
		$filtro['usu_id'] = $this->session->userdata('usu_id');
		
		$this->load->model('Equipamento_model','equipamento');
		$data['equipamentos'] = $this->equipamento->getEquipamentosByFiltro($filtro);
		
		$data['objetosEncontrados'] = count($data['equipamentos']);
		
		if($filtro['nome'])
			$data['filtro'] = $filtro['nome'];
		else
			$data['filtro'] = $filtro['cidade']; 
			
		$this->load->view('iniciacao_local_form',$data);		
	}
	
	public function cadastrarLocal()
	{
		if(isset($_POST['local'])){
			
			$local = $_POST['local'];
			$local['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Local_model','local'); 
			
			if(!empty($local['id'])){
				$retorno = $this->local->editarLocal($local);
				
				if($retorno){
					$this->session->set_userdata('msg_sucesso','Local editado com sucesso!');
					redirect('iniciacao/local');
				} else {
					$this->session->set_userdata('msg_erro','Este local já foi selecionado!');
					redirect('iniciacao/editarLocal/'.$local['id']);
				} 
				
			} else {
				$retorno = $this->local->cadastrarLocal($local);
				
				if($retorno){
					$this->session->set_userdata('msg_sucesso','Local cadastrado com sucesso!');
					redirect('iniciacao/local');
				} else {
					$this->session->set_userdata('msg_erro','Este local já foi selecionado!');
					redirect('iniciacao/novoLocal');
				} 
			}

			redirect('iniciacao/local');
			
		}
	}
	
	public function editarLocal($locId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_local';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_definicao';
		
		$this->load->model('Equipamento_model','equipamento');
		$data['equipamentos'] = $this->equipamento->getEquipamentos($this->session->userdata('usu_id'));
		
		$data['objetosEncontrados'] = count($data['equipamentos']);
		
		$this->load->model('Local_model','local');
		$data['local'] = $this->local->getDadosLocal($locId);
		
		$this->load->view('iniciacao_local_form',$data);		
	}
	
	public function excluirLocal($locId)
	{
		$this->load->model('Local_model','local');
		$return = $this->local->excluirLocal($locId);
		
		if($return)
			$this->session->set_userdata('msg_sucesso','Local removido com sucesso!');
		else 
			$this->session->set_userdata('msg_erro','Local não pode ser removido!<br>Verifique se ele é utilizado em alguma Apresentação.');
			
		redirect('iniciacao/local');
	}

	public function recurso()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_recurso';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_recurso';
		
		$tipoItens = '1'; //préprodução
		
		$this->load->model('Custo_model','custo');
		$data['custos'] = $this->custo->getCustos($this->session->userdata('eve_id'),$tipoItens);
		
		$custoTotal = 0;
		
		foreach ($data['custos'] as $custo)
			$custoTotal = $custoTotal + $custo->cus_valor; 
		
		$data['custoTotal'] = $custoTotal; 
		
		$this->load->view('iniciacao_recurso',$data);
	}	
	
	public function novoCusto()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_recurso';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_recurso';
		
		$tipoItens = '1'; //préprodução
		
		$this->load->model('Custo_model','custo');
		$data['itens'] = $this->custo->getItens($tipoItens);
		
		$this->load->view('iniciacao_recurso_form',$data);
	}
	
	public function editarCusto($cusId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_recurso';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_recurso';
		
		$tipoItens = '1'; //préprodução
		
		$this->load->model('Custo_model','custo');
		$data['itens'] = $this->custo->getItens($tipoItens);
		
		$data['custo'] = $this->custo->getCusto($cusId);
		
		$this->load->view('iniciacao_recurso_form',$data);
	}
	
	public function cadastrarCusto()
	{
		if(isset($_POST['custo'])){
			
			$custo = $_POST['custo'];
			$custo['eve_id'] = $this->session->userdata('eve_id');
			$custo['tipo'] = '1';
			
			$this->load->model('Custo_model','custo'); 
			
			if(!empty($custo['id'])){
				$this->custo->editarCusto($custo);
				$this->session->set_userdata('msg_sucesso','Custo editado com sucesso!');
				redirect('iniciacao/recurso');
			} else {
				$this->custo->cadastrarCusto($custo);
				$this->session->set_userdata('msg_sucesso','Custo cadastrado com sucesso!');
				redirect('iniciacao/novoCusto');
			}
			
		}
	}
	
	public function excluirCusto($cusId)
	{
		$this->load->model('Custo_model','custo');
		$this->custo->excluirCusto($cusId);
				
		$this->session->set_userdata('msg_sucesso','Custo excluído com sucesso!');
		redirect('iniciacao/recurso');
	}
	
	public function divulgacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_divulgacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_divulgacao';
		
		$this->load->model('Divulgacao_model','divulgacao');
		$data['divulgacoes'] = $this->divulgacao->getDivulgacoes($this->session->userdata('eve_id'));
		
		$custoTotal = 0;
		
		foreach ($data['divulgacoes'] as $divulgacao)
			$custoTotal = $custoTotal + $divulgacao->div_valor; 
		
		$data['custoTotal'] = $custoTotal; 
		
		$this->load->view('iniciacao_divulgacao',$data);
	}
	
	public function novoDivulgacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = 'im_divulgacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_divulgacao';
		
		$this->load->model('Divulgacao_model','divulgacao');
		$data['pecas'] = $this->divulgacao->getPecas();
		$data['meios'] = $this->divulgacao->getMeios();
		
		$this->load->view('iniciacao_divulgacao_form',$data);
	}
	
	public function editarDivulgacao($divId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_divulgacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_divulgacao';
		
		$this->load->model('Divulgacao_model','divulgacao');
		$data['pecas'] = $this->divulgacao->getPecas();
		$data['meios'] = $this->divulgacao->getMeios();
				
		$data['divulgacao'] = $this->divulgacao->getDivulgacao($divId);
		
		$this->load->view('iniciacao_divulgacao_form',$data);
	}
	
	public function cadastrarDivulgacao()
	{
		if(isset($_POST['divulgacao'])){
			
			$divulgacao = $_POST['divulgacao'];
			$divulgacao['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Divulgacao_model','divulgacao');
			
			if(!empty($divulgacao['id'])){
				$this->divulgacao->editarDivulgacao($divulgacao);
				$this->session->set_userdata('msg_sucesso','Divulgação editada com sucesso!');
				redirect('iniciacao/divulgacao');
			} else {
				$this->divulgacao->cadastrarDivulgacao($divulgacao);
				$this->session->set_userdata('msg_sucesso','Divulgação cadastrada com sucesso!');
				redirect('iniciacao/novoDivulgacao');
			}
			
		}
	}
	
	public function excluirDivulgacao($divId)
	{
		$this->load->model('Divulgacao_model','divulgacao');
		$this->divulgacao->excluirDivulgacao($divId);
				
		$this->session->set_userdata('msg_sucesso','Divulgação excluída com sucesso!');
		redirect('iniciacao/divulgacao');
	}	
	
	public function cronograma()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_cronograma';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_cronograma';
		
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefas'] = $this->cronograma->getTarefas($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao_cronograma',$data);
	}
	
	public function novoTarefa()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_cronograma';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_cronograma';
		
		$this->load->model('Usuario_model','usuario');
		$data['usuarios'] = $this->usuario->getUsuariosByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao_cronograma_form',$data);
	}
	
	public function showTarefa($tarId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_cronograma';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_cronograma';
		
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefa'] = $this->cronograma->getTarefa($tarId);
		
		$this->load->model('Usuario_model','usuario');
		$data['usuarios'] = $this->usuario->getUsuariosByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao_cronograma_show',$data);
	}
	

	public function editarTarefa($tarId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'iniciacao';
		$data['menu_ativo'] = '.im_iniciacao, .im_cronograma';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_iniciacao_cronograma';
		
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefa'] = $this->cronograma->getTarefa($tarId);
		
		$this->load->model('Usuario_model','usuario');
		$data['usuarios'] = $this->usuario->getUsuariosByEvento($this->session->userdata('eve_id'));
		
		$this->load->view('iniciacao_cronograma_form',$data);
	}
	
	public function cadastrarTarefa()
	{
		if(isset($_POST['tarefa'])){
			
			$tarefa = $_POST['tarefa'];
			$tarefa['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Cronograma_model','cronograma');
			
			if(!empty($tarefa['id'])){
				$this->cronograma->editarTarefa($tarefa);
				$this->session->set_userdata('msg_sucesso','Tarefa editada com sucesso!');
				redirect('iniciacao/cronograma');
			} else {
				$this->cronograma->cadastrarTarefa($tarefa);
				$this->session->set_userdata('msg_sucesso','Tarefa cadastrada com sucesso!');
				redirect('iniciacao/novoTarefa');
			}
			
		}
	}
	
	public function excluirTarefa($tarId)
	{
		$this->load->model('Cronograma_model','cronograma');
		$this->cronograma->excluirTarefa($tarId);
				
		$this->session->set_userdata('msg_sucesso','Tarefa excluída com sucesso!');
		redirect('iniciacao/cronograma');
	}	
}
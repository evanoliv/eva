<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento extends CI_Controller {

	public function home($eveId = '')
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home';
		$data['redirect'] = true;
		
		if($eveId)
			$this->session->set_userdata('eve_id',$eveId);

		$this->load->model('Papel_model','papel');
		$papel = $this->papel->getPapelByEvento($this->session->userdata('eve_id'),$this->session->userdata('usu_id'));
		$this->session->set_userdata('usu_papel',$papel->pap_papel);
			
		$this->load->model('Evento_model','evento');
		$evento = $this->evento->getDadosEvento($this->session->userdata('eve_id'));

		$this->session->set_userdata('eve_nome',$evento->eve_nome);
		
		$data['titulo_pagina'] = $evento->eve_nome;
		
		//avisos importantes sobre as tarefas
		$this->load->model('Cronograma_model','cronograma');
		$data['avisoTarefas'] = $this->cronograma->getTarefasByDatas('tar_data_conclusao',date("Y-m-d"),date("Y-m-d"));
		$data['avisoTarefasNaoConcluidas'] = $this->cronograma->getTarefasNaoConcluidas(date("Y-m-d"));
		
		//avisos importantes sobre o deslocamento dos artistas
		$this->load->model('Deslocamento_model','deslocamento');
		$data['avisoDeslocamentos'] = $this->deslocamento->getDeslocamentosRestantes($this->session->userdata('eve_id'));
		
		//avisos importantes sobre as acomodações dos artistas
		$this->load->model('Acomodacao_model','acomodacao');
		$data['avisoAcomodacoes'] = $this->acomodacao->getAcomodacoesRestantes($this->session->userdata('eve_id'));
		$data['avisoAcomodacoesSolidarias'] = $this->acomodacao->getAcomodacoesNaoSolidarias($this->session->userdata('eve_id'));
		
		//balanço do orçamento
		$this->load->model('Evento_model','evento');
		$this->load->model('Custo_model','custo');
		$this->load->model('Divulgacao_model','divulgacao');
		$evento = $this->evento->getDadosEvento($this->session->userdata('eve_id'));
		$custoPreProducao = $this->custo->getSomaCustos($this->session->userdata('eve_id'),'1');
		$custoProducao = $this->custo->getSomaCustos($this->session->userdata('eve_id'),'2');
		$custoRecolhimento = $this->custo->getSomaCustos($this->session->userdata('eve_id'),'4');
		$custoCache = $this->evento->getSomaCache($this->session->userdata('eve_id'));
		$custoDivulgacao = $this->divulgacao->getSomaDivulgacoes($this->session->userdata('eve_id'));
		$orcamento = $evento->eve_orcamento - $custoPreProducao->cus_valor - $custoProducao->cus_valor - $custoRecolhimento->cus_valor - $custoCache->atr_custo - $custoDivulgacao->div_valor;
		
		if($orcamento < 0) 
			$data['orcamento'] = $orcamento;
		
		//avisos sobre reuniões
		$this->load->model('Reuniao_model','reuniao');
		$data['reunioes'] = $this->reuniao->getReunioesByDatas(date("Y-m-d"),date("Y-m-d"));
		
		//noticias
		$this->load->model('Noticia_model','noticia');
		$data['noticias'] = $this->noticia->getNoticiasByEvento($this->session->userdata('eve_id'),'10');
		
		//atividades
		$data['atividades'] = $this->cronograma->getAtividades($this->session->userdata('eve_id'),'0');
		
		$this->load->view('evento',$data);
	}
	
	public function calendario()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_calendario';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		if(isset($_POST['periodo'])){
			
			$periodo = $_POST['periodo'];
			
			$data_inicial = $periodo['inicial'];
			$data_final = $periodo['final'];
			
		} else {
		
			$hoje = date("Y-m-d H:i:s");
			$semana = strtotime($hoje);
			$semana = strtotime("+7 day", $semana);
			$semana = date("Y-m-d H:i:s",$semana);
			
			$hoje = explode(' ',$hoje);
			$data_inicial = $hoje[0]; 
			
			$semana = explode(' ',$semana);
			$data_final = $semana[0]; 
				
		}
		
		$data['data_inicial'] = $data_inicial;
		$data['data_final'] = $data_final;
		
		$this->load->model('Evento_model','evento');
		$data['diasEvento'] = $this->evento->getDiasEvento($data_inicial,$data_final);
		
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefasInicio'] = $this->cronograma->getTarefasByDatas('tar_data_inicio',$data_inicial,$data_final);
		$data['tarefasConclusao'] = $this->cronograma->getTarefasByDatas('tar_data_conclusao',$data_inicial,$data_final);
		
		$this->load->model('Apresentacao_model','apresentacao');
		$data['apresentacoes'] = $this->apresentacao->getApresentacoesByDatas($data_inicial,$data_final);
		
		$this->load->model('Deslocamento_model','deslocamento');
		$data['deslocamentosSaida'] = $this->deslocamento->getDeslocamentosByDatas('des_saida',$data_inicial,$data_final);
		$data['deslocamentosChegada'] = $this->deslocamento->getDeslocamentosByDatas('des_chegada',$data_inicial,$data_final);

		$this->load->model('Acomodacao_model','acomodacao');
		$data['acomodacoesChegada'] = $this->acomodacao->getAcomodacoesByDatas('aco_chegada',$data_inicial,$data_final);
		$data['acomodacoesSaida'] = $this->acomodacao->getAcomodacoesByDatas('aco_saida',$data_inicial,$data_final);
		
		$this->load->model('Reuniao_model','reuniao');
		$data['reunioes'] = $this->reuniao->getReunioesByDatas($data_inicial,$data_final);
		
		$this->load->view('evento_calendario',$data);
	}
	
	
	
	public function showAtividades($limite = '0')
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home, .im_showatividades';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		$this->load->model('Cronograma_model','cronograma');
		$data['atividades'] = $this->cronograma->getAtividades($this->session->userdata('eve_id'),$limite);
		
		$data['atividadesEncontradas'] = $this->cronograma->getCountAtividades($this->session->userdata('eve_id'));
		
		$this->load->library('pagination');

		$config['base_url'] = base_url().'evento/showAtividades/';
		$config['total_rows'] = $data['atividadesEncontradas'];
		$config['per_page'] = 25;
		$config['first_link'] = 'Primeira página';
		$config['last_link'] = 'Última página';
	
		$this->pagination->initialize($config); 
		
		$this->load->view('evento_atividades',$data);
	}
	
	public function filtrarAtividades()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home, .im_showatividades';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		$filtro = $_GET['atividade'];
		$filtro['eve_id'] = $this->session->userdata('eve_id');
		
		$this->load->model('Cronograma_model','cronograma');
		$data['atividades'] = $this->cronograma->getAtividadesByFiltro($filtro);
		
		$data['atividadesEncontradas'] = count($data['atividades']);
		
		if($filtro['data'])
			$data['filtro'] = format_show($filtro['data']);
		elseif($filtro['usuario'])
			$data['filtro'] = $filtro['usuario'];
		elseif($filtro['tarefa'])
			$data['filtro'] = $filtro['tarefa'];
		elseif($filtro['situacao']) 
			$data['filtro'] = $filtro['situacao'];
		else 
			$data['filtro'] = $filtro['prioridade'];
			
		$this->load->library('pagination');
		$config['total_rows'] = 0;
		$this->pagination->initialize($config); 
		
		$this->load->view('evento_atividades',$data);
	}
	
	public function showNoticias()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home, .im_shownoticias';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		$this->load->model('Noticia_model','noticia');
		$data['noticias'] = $this->noticia->getNoticiasByEvento($this->session->userdata('eve_id'),'50');
		
		$data['noticiasEncontradas'] = count($data['noticias']);
		
		$this->load->view('evento_noticias',$data);
	}
	
	public function filtrarNoticias()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home, .im_shownoticias';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		$filtro = $_GET['noticia'];
		$filtro['eve_id'] = $this->session->userdata('eve_id');
		
		$this->load->model('Noticia_model','noticia');
		$data['noticias'] = $this->noticia->getNoticiasByFiltro($filtro);
				
		$data['noticiasEncontradas'] = count($data['noticias']);
		
		if($filtro['data'])
			$data['filtro'] = format_show($filtro['data']);
		elseif($filtro['usuario'])
			$data['filtro'] = $filtro['usuario'];
		else 
			$data['filtro'] = $filtro['titulo'];
		
		$this->load->view('evento_noticias',$data);
	}
	
	public function selecionar()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = '';
		$data['menu_ativo'] = '.im_meuseventos';
		$data['titulo_pagina'] = 'Meus Eventos';
		$data['redirect'] = true;
		
		if(!$this->session->userdata('usu_id')){

			$this->session->set_userdata('msg_erro','É preciso entrar no sistema para fazer a gestão um evento');
			
		}else{
		
			$this->load->model('Evento_model','evento');
			$data['eventosAndamento'] = $this->evento->getEventosAndamento($this->session->userdata('usu_id'));
			$data['eventosFinalizados'] = $this->evento->getEventosFinalizados($this->session->userdata('usu_id'));
			$data['eventosCadastrados'] = $this->evento->getEventosCadastrados($this->session->userdata('usu_id'));
			
		}
		$this->load->view('evento_selecionar',$data);
	}
	
	public function novo($objId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = '';
		$data['menu_ativo'] = '.im_meuseventos';
		$data['titulo_pagina'] = 'Realizar evento';
		$data['redirect'] = true;
		
		$this->load->model('Objeto_model','objeto');
		$data['objeto'] = $this->objeto->getDadosObjeto($objId);

		$this->load->view('evento_novo',$data);	
	}
	
	public function cadastrarEvento($objId)
	{
		if(isset($_POST['objeto'])){
			
			$evento = $_POST['objeto'];
			$evento['obj_id'] = $objId;
			
			$evento['publico'] = (isset($evento['publico'])) ? '1' : '0';
			
			$usuId = $this->session->userdata('usu_id');
			
			if(empty($usuId)){
				$this->session->set_userdata('msg_erro','Ocorreu um erro inesperado, tente novamente.');
				redirect('eva');
			}
			
			$this->load->model('Evento_model','evento');
			$eveId = $this->evento->cadastrarEvento($evento,$usuId);
			
			if(isset($evento['importar']))
				$this->evento->importarTarefas($eveId,$this->session->userdata('usu_id'));

			redirect('evento/home');
			
		}
	}	
	
	public function inscricao($eveId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '';
		$data['redirect'] = true;
		
		$this->load->model('Produto_model','produto');
		$data['produtos'] = $this->produto->getProdutos($this->session->userdata('usu_id'));
		
		$this->load->model('Evento_model','evento');
		$data['evento'] = $this->evento->getDadosEvento($eveId);
		
		$data['titulo_pagina'] = 'Inscrição no evento '.$data['evento']->eve_nome;
				
		$this->load->view('evento_inscricao',$data);			
	}

	public function editarAtracao($atrId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '';
		$data['redirect'] = true;
		
		$this->load->model('Evento_model','evento');
		$data['atracao'] = $this->evento->getDadosAtracao($atrId);
		
		if(($this->session->userdata('usu_id')) && ($data['atracao']->obj_usu_id == $this->session->userdata('usu_id'))){
			
			$this->load->model('Produto_model','produto');
			$data['produtos'] = $this->produto->getProdutos($this->session->userdata('usu_id'));
			
			$data['titulo_pagina'] = 'Inscrição no evento '.$data['atracao']->eve_nome;
					
			$this->load->view('evento_inscricao',$data);		
			
		} else {
			$this->session->set_userdata('msg_erro','Acesso negado!');
			redirect('eva');
		}
			
	}
		
	public function cadastrarAtracao()
	{
		if(isset($_POST['atracao'])){
			
			$atracao = $_POST['atracao'];
			
			$atracao['alimentacao'] = (isset($atracao['alimentacao'])) ? '1' : '0';
			$atracao['hospedagem'] = (isset($atracao['hospedagem'])) ? '1' : '0';
			$atracao['solidaria'] = (isset($atracao['solidaria'])) ? '1' : '0';

			$this->load->model('Evento_model','evento');
			
			if($atracao['id'] == ''){
				
				$retorno = $this->evento->cadastrarAtracao($atracao);

				if($retorno){
					
					$this->load->model('Evento_model','evento');
					$evento = $this->evento->getDadosEvento($atracao['evento']);
					
					$this->load->library('email');
	
					$this->email->from('admin@sistemaeva.com.br', 'Sistema EVA');
					$this->email->to($this->session->userdata['usu_email']);
					
					$message = "Sua inscrição no evento ".$evento->eve_nome." foi realizada com sucesso!";
					$message .= "\nVocê pode conferir as suas condições de participação pelo link abaixo: \n";
					$message .= "http://www.sistemaeva.com.br/usuario/inscricao ";
					$message .= "\n\nA equipe do ".$evento->eve_nome." agradece o seu interesse em participar do evento!";
					$message .= "\n\nAtenciosamente, \nSistema EVA.";
					
					$this->email->subject($evento->eve_nome.': Inscrição realizada com sucesso!');
					$this->email->message($message);	
					
					$this->email->send();
					
					$this->session->set_userdata('msg_sucesso','Inscrição realizada com sucesso!');						
					
				}
				else
					$this->session->set_userdata('msg_erro','Este produto já está inscrito neste evento');
				
			} else {
				
				$this->evento->editarAtracao($atracao);
				$this->session->set_userdata('msg_sucesso','Inscrição editada com sucesso!');
				
			}
				
			redirect('usuario/inscricao');
			
		}		
	}

	public function showAtracao($atrId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'planejamento';
		$data['menu_ativo'] = '.im_planejamento, .im_inscrito';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		$this->load->model('Evento_model','evento');
		$data['atracao'] = $this->evento->getDadosAtracao($atrId);
		
		$this->load->model('Objeto_model','objeto');
		$data['objeto'] = $this->objeto->getDadosObjeto($data['atracao']->obj_id);
		
		if($data['atracao']->atr_transporte == '0')
			$data['atracao']->atr_transporte = 'Carro próprio, com ressarcimento do custo com combustível';
		
		if($data['atracao']->atr_transporte == '1')
			$data['atracao']->atr_transporte = 'Carro do evento';
			
		if($data['atracao']->atr_transporte == '2')
			$data['atracao']->atr_transporte = 'Rodoviário, com ressarcimento do custo da passagem';
			
		if((($this->session->userdata('usu_id')) && ($data['atracao']->obj_usu_id == $this->session->userdata('usu_id'))) || ($data['atracao']->atr_eve_id == $this->session->userdata('eve_id'))){
			$this->load->view('planejamento_atracao_show',$data);
		} else {
			$this->session->set_userdata('msg_erro','Acesso negado!');
			redirect('eva');
		}			
	}
		
	public function excluirAtracao($atrId)
	{
		$this->load->model('Evento_model','evento');
		$atracao = $this->evento->getDadosAtracao($atrId);
		
		if(($this->session->userdata('usu_id')) && ($atracao->obj_usu_id == $this->session->userdata('usu_id'))){

			$this->load->model('Evento_model','evento');
			$return = $this->evento->excluirAtracao($atrId);
		
			if($return)
				$this->session->set_userdata('msg_sucesso','Inscrição cancelada com sucesso!');
			else 
				$this->session->set_userdata('msg_erro','Inscrição nao pode ser cancelada!<br>Esta atração já foi selecionada para algum evento, torne-a privada caso queira retirá-la do Cadastro de Objetos.');
				
			redirect('usuario/inscricao');
			
		} else {
			$this->session->set_userdata('msg_erro','Acesso negado!');
			redirect('eva');
		}
	}
	
	public function removerAtracao($atrId)
	{
		$this->load->model('Evento_model','evento');
		$return = $this->evento->removerAtracao($atrId);
				
		if($return)
			$this->session->set_userdata('msg_sucesso','Atração removida com sucesso!');
		else 
			$this->session->set_userdata('msg_erro','Atração não pode ser removida!<br>Verifique se ela é utilizada na Programação ou no Suporte.');
			
		redirect('planejamento/atracao');
	}
	
	public function selecionarAtracao($atrId)
	{
		$this->load->model('Evento_model','evento');
		$this->evento->selecionarAtracao($atrId);
				
		$this->session->set_userdata('msg_sucesso','Atração selecionada com sucesso!');
		redirect('planejamento/buscarAtracao');
	}

	public function perfil($usuId = '')
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_perfil';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		if($usuId == '')
			$usuId = $this->session->userdata('usu_id');
		
		$this->load->model('Usuario_model','usuario');
		$data['usuario'] = $this->usuario->getUsuario($usuId);
			
		$this->load->model('Cronograma_model','cronograma');
		$data['tarefas'] = $this->cronograma->getTarefasByUsuario($usuId,$this->session->userdata('eve_id'));
		
		$this->load->model('Participacao_model','participacao');
		$data['participacoes'] = $this->participacao->getParticipacaoUsuario($usuId,$this->session->userdata('eve_id'));
		
		$this->load->model('Reuniao_model','reuniao');
		$data['reunioes'] = $this->reuniao->getReunioesByUsuario($usuId,$this->session->userdata('eve_id'));
		
		$this->load->view('evento_perfil',$data);
	}
	
	public function local($locId = '')
	{
		if($locId != ''){

			$data['tipo_menu'] = 'evento';
			$data['tipo_menu_lateral'] = 'evento';
			$data['redirect'] = true;
			$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
			$this->load->model('Local_model','local');
			$local = $this->local->getDadosLocal($locId);
			$data['nomeLocal'] = $local->obj_nome;
			
			$this->load->model('Apresentacao_model','apresentacao');
			$data['apresentacoes'] = $this->apresentacao->getApresentacoesByLocal($locId);
			
			$this->load->model('Participacao_model','participacao');
			
			foreach ($data['apresentacoes'] as $apresentacao){
				$apresentacao->coordenadores = $this->participacao->getCoordenadoresByApresentacao($apresentacao->apr_id);
				$apresentacao->produtores = $this->participacao->getProdutoresByApresentacao($apresentacao->apr_id);
			}
			
			$this->load->model('Objeto_model','objeto');
			$data['objeto'] = $this->objeto->getDadosObjeto($local->obj_id);
			
			$this->load->view('evento_local',$data);
			
		} else {
			redirect('evento/home');
		}
		
	}
	
	public function atracao($atrId = '')
	{
		if($atrId != ''){

			$data['tipo_menu'] = 'evento';
			$data['tipo_menu_lateral'] = 'evento';
			$data['redirect'] = true;
			$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
			$this->load->model('Evento_model','evento');
			$atracao = $this->evento->getDadosAtracao($atrId);
			$data['atracao'] = $atracao;
			
			if($data['atracao']->atr_transporte == '0')
				$data['atracao']->atr_transporte = 'Carro próprio, com ressarcimento do custo com combustível';
		
			if($data['atracao']->atr_transporte == '1')
				$data['atracao']->atr_transporte = 'Carro do evento';
				
			if($data['atracao']->atr_transporte == '2')
				$data['atracao']->atr_transporte = 'Rodoviário, com ressarcimento do custo da passagem';
			
			$this->load->model('Apresentacao_model','apresentacao');
			$data['apresentacoes'] = $this->apresentacao->getApresentacoesByAtracao($atrId);
			
			$this->load->model('Participacao_model','participacao');
			
			foreach ($data['apresentacoes'] as $apresentacao){
				$apresentacao->coordenadores = $this->participacao->getCoordenadoresByApresentacao($apresentacao->apr_id);
				$apresentacao->produtores = $this->participacao->getProdutoresByApresentacao($apresentacao->apr_id);
			}
			
			$this->load->model('Deslocamento_model','deslocamento');
			$data['deslocamentos'] = $this->deslocamento->getDeslocamentosByAtracao($atrId);
			
			$this->load->model('Acomodacao_model','acomodacao');
			$data['acomodacoes'] = $this->acomodacao->getAcomodacoesByAtracao($atrId);
			
			$this->load->model('Objeto_model','objeto');
			$data['objeto'] = $this->objeto->getDadosObjeto($atracao->obj_id);
			
			$this->load->view('evento_atracao',$data);
			
		} else {
			redirect('evento/home');
		}
		
	}

	public function novoNoticia()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home, .im_novanoticia';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->view('evento_noticia_form',$data);
	}	
	
	public function cadastrarNoticia()
	{
		if(isset($_POST['noticia'])){
			
			$noticia = $_POST['noticia'];
			$noticia['eve_id'] = $this->session->userdata('eve_id');
			$noticia['usu_id'] = $this->session->userdata('usu_id');
			
			$this->load->model('Noticia_model','noticia'); 
			
			if(!empty($noticia['id'])){
				$this->noticia->editarNoticia($noticia);
				$this->session->set_userdata('msg_sucesso','Notícia editada com sucesso!');
			} else {
				$this->noticia->cadastrarNoticia($noticia);
				$this->session->set_userdata('msg_sucesso','Notícia cadastrada com sucesso!');
			}
			
			redirect('evento/home');
		}
	}
		
	public function editarNoticia($notId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home, .im_novanoticia';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Noticia_model','noticia');
		$data['noticia'] = $this->noticia->getDadosNoticia($notId);
		
		$this->load->view('evento_noticia_form',$data);
	}
	
	public function showNoticia($notId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_home';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Noticia_model','noticia');
		$data['noticia'] = $this->noticia->getDadosNoticia($notId);
		
		$this->load->view('evento_noticia_show',$data);
	}
		
	public function excluirNoticia($notId)
	{
		$this->load->model('Noticia_model','noticia');
		$this->noticia->excluirNoticia($notId);
				
		$this->session->set_userdata('msg_sucesso','Notícia excluída com sucesso!');
		redirect('evento/home');
	}
	
	public function reuniao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_reuniao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;

		$this->load->model('Reuniao_model','reuniao');
		$data['reunioes'] = $this->reuniao->getReunioesByEvento($this->session->userdata('eve_id'),'50');
		
		$data['reunioesEncontradas'] = count($data['reunioes']);
		
		$this->load->view('evento_reuniao',$data);
	}	
		
	public function novoReuniao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_reuniao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Papel_model','papel');
		$data['papeis'] = $this->papel->getCoordenadoresEvento($this->session->userdata('eve_id'));
		
		$this->load->view('evento_reuniao_form',$data);
	}	
	
	public function cadastrarReuniao()
	{
		if(isset($_POST['reuniao'])){
			
			$reuniao = $_POST['reuniao'];
			$reuniao['eve_id'] = $this->session->userdata('eve_id');
			
			$this->load->model('Reuniao_model','reuniao'); 
			
			if(!empty($reuniao['id'])){
				$this->reuniao->editarReuniao($reuniao);
				$this->reuniao->cadastrarPresenca($reuniao['presenca'],$reuniao['id']);
				$this->session->set_userdata('msg_sucesso','Reunião editada com sucesso!');
			} else {
				$reuId = $this->reuniao->cadastrarReuniao($reuniao);
				$this->reuniao->cadastrarPresenca($reuniao['presenca'],$reuId);
				$this->session->set_userdata('msg_sucesso','Reunião cadastrada com sucesso!');
			}
			
			redirect('evento/reuniao');
		}
	}
		
	public function editarReuniao($reuId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_reuniao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Reuniao_model','reuniao');
		$data['reuniao'] = $this->reuniao->getDadosReuniao($reuId);
		
		$this->load->model('Papel_model','papel');
		$data['papeis'] = $this->papel->getCoordenadoresEvento($this->session->userdata('eve_id'));
		
		$data['presenca'] = array();
		$presencas = $this->reuniao->getPresencaReuniao($reuId);
		
		foreach ($presencas as $presenca)
			array_push($data['presenca'],$presenca->pre_pap_id);
		
		$this->load->view('evento_reuniao_form',$data);
	}
	
	public function showReuniao($reuId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_reuniao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		
		$this->load->model('Reuniao_model','reuniao');
		$data['reuniao'] = $this->reuniao->getDadosReuniao($reuId);
		
		$this->load->model('Papel_model','papel');
		$data['papeis'] = $this->papel->getCoordenadoresEvento($this->session->userdata('eve_id'));
		
		$data['presenca'] = array();
		$presencas = $this->reuniao->getPresencaReuniao($reuId);
		
		foreach ($presencas as $presenca)
			array_push($data['presenca'],$presenca->pre_pap_id);
				
		$this->load->view('evento_reuniao_show',$data);
	}
		
	public function excluirReuniao($reuId)
	{
		$this->load->model('Reuniao_model','reuniao');
		$this->reuniao->excluirReuniao($reuId);
				
		$this->session->set_userdata('msg_sucesso','Reunião excluída com sucesso!');
		redirect('evento/reuniao');
	}
	
	public function filtrarReunioes()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'evento';
		$data['menu_ativo'] = '.im_reuniao';
		$data['redirect'] = true;
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		
		$filtro = $_GET['reuniao'];
		$filtro['eve_id'] = $this->session->userdata('eve_id');
		
		$this->load->model('Reuniao_model','reuniao');
		$data['reunioes'] = $this->reuniao->getReunioesByFiltro($filtro);
		
		$this->load->model('Papel_model','papel');
		$data['papeis'] = $this->papel->getCoordenadoresEvento($this->session->userdata('eve_id'));
		
		$data['presenca'] = $this->reuniao->getPresencaReuniao($reuId);
				
		$data['reunioesEncontradas'] = count($data['reunioes']);
		$data['filtro'] = format_show($filtro['data']);
		
		$this->load->view('evento_reuniao',$data);
	}
	
}
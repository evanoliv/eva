<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'start';
		$data['menu_ativo'] = '.im_cadastro';
		$data['titulo_pagina'] = 'Cadastro';
		$data['redirect'] = false;
	
		$this->load->view('cadastro',$data);
	}
	
	public function cadastrar()
	{
		if(isset($_POST['usuario'])){
			
			$usuario = $_POST['usuario'];
			$responsavel = $_POST['responsavel'];
			
			$this->load->model('Usuario_model','usuario');
			
			$result = $this->usuario->getDadosUsuario('usu_email',$usuario['email']);
			
			if(empty($result)){
				$usuario['usu_id'] = $this->usuario->cadastrarUsuario($usuario);
				
				$this->load->model('Responsavel_model','responsavel');
				$responsavel = array_merge($responsavel,$usuario);
				$this->responsavel->cadastrarResponsavel($responsavel);
				
				$this->session->set_userdata('msg_sucesso','Usuário cadastrado com sucesso!');
				redirect('login');
			} else {
				$this->session->set_userdata('msg_erro','Já existe este e-mail cadastrado no sistema.');
				redirect('usuario');
			}
			
		}
		
	}
	
    public function trocadados()
    {
		if(isset($_POST['usuario'])){
			
			$usuario = $_POST['usuario'];
			$usuario['usu_id'] = $this->session->userdata('usu_id');
		
			$this->load->model('Usuario_model','usuario');
			
			$this->usuario->editarDadosUsuario($usuario);
			$this->session->set_userdata('msg_sucesso','Dados alterados com sucesso!');

			redirect('configuracao/usuario');
			
		}
		    	
    }
	
    public function trocasenha()
    {
		if(isset($_POST['usuario'])){
			
			$usuario = $_POST['usuario'];
			$usuario['usu_id'] = $this->session->userdata('usu_id');
		
			$this->load->model('Usuario_model','usuario');
			
			$result = reset($this->usuario->getDadosUsuario('usu_id',$usuario['usu_id']));
			
			$this->load->helper('security');
			
			if($result->usu_senha !=  do_hash($usuario['senha_atual'].'4rT%yH7uJ$3Fr5&uj9Lç0Ds21#4gf%$g54')){
				$this->session->set_userdata('msg_erro','Senha atual não confere.');
			} else {
				$this->usuario->editarSenhaUsuario($usuario);
				$this->session->set_userdata('msg_sucesso','Senha alterada com sucesso!');
			}

			redirect('configuracao/usuario');
			
		}
		    	
    }

    public function configuraroteiro()
    {
    	if(isset($_POST['usuario']))
			$usuario = $_POST['usuario'];
			
		$usuario['usu_id'] = $this->session->userdata('usu_id');
		
		$this->load->model('Usuario_model','usuario');
    	
		$this->usuario->editarRoteiro($usuario);
		$this->session->set_userdata('msg_sucesso','Opção de roteiro alterada com sucesso!');

		redirect('configuracao/roteiro');
    }
    
    public function inscricao()
    {
    	$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_inscricao';
		$data['titulo_pagina'] = 'Meus objetos';
		$data['redirect'] = true;
		
		$this->load->model('Evento_model','evento');
		$data['objetos'] = $this->evento->getAtracoesByUsuario($this->session->userdata('usu_id'));
		
		$this->load->view('perfil',$data);
    }
        
}
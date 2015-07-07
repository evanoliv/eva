<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'start';
		$data['menu_ativo'] = '.im_login';
		$data['titulo_pagina'] = 'Entrar'; 
		$data['redirect'] = false;

		$this->load->view('login',$data);
	}
	
	public function entrar()
	{
		$user = $_POST['login']['email'];
		$pass = $_POST['login']['senha'];
		
		$this->load->model('Login_model','login');
		
		if($this->login->entrar($user,$pass)){
			
			if($this->session->userdata('conviteEvento')){
				
				$papel['evento'] = $this->session->userdata('conviteEvento');
				$papel['usuario'] = $this->session->userdata('usu_id');
				$papel['papel'] = $this->session->userdata('papelEvento');
				
				$this->load->model('Papel_model','papel');
				$this->papel->cadastrarPapel($papel);
				
				$this->session->unset_userdata('conviteEvento');
				$this->session->unset_userdata('convitePapel');
			}
			
			redirect('mapeamento/show');
			
		}else{
			$this->session->set_userdata('msg_erro','E-mail ou senha inválido.');
			redirect('login');
		}
	}
	
	public function sair()
	{
    	$this->session->sess_destroy();
		redirect('eva');
	}
	
}
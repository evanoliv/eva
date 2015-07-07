<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eva extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'start';
		$data['titulo_pagina'] = 'EVA - Sistema de Gestão de Eventos Culturais'; 
		$data['redirect'] = false;
	
		$this->load->view('eva',$data);
	}
	
	public function decrypto($string)
	{
		$this->load->model('Login_model','login');
		$result = $this->login->decrypto($string);
		
		if(!empty($result))
			redirect($result->enc_funcao);
		else{
			$this->session->set_userdata('msg_erro','Ocorreu um erro inesperado.');
			redirect('eva');	
		}
		
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracao extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'configuracao';
		$data['menu_ativo'] = '.im_configuracao';
		$data['titulo_pagina'] = 'Configuração do sistema';
		$data['redirect'] = true;
	
		$this->load->view('configuracao',$data);
	}

	public function usuario()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'configuracao';
		$data['menu_ativo'] = '.im_configuracao, .im_usuario';
		$data['titulo_pagina'] = 'Configuração do sistema';
		$data['redirect'] = true;
	
		$this->load->view('configuracao_usuario',$data);
	}
	
	public function roteiro()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'configuracao';
		$data['menu_ativo'] = '.im_configuracao, .im_roteiro';
		$data['titulo_pagina'] = 'Configuração do sistema';
		$data['redirect'] = true;
		
		$this->load->model('Usuario_model','usuario');
		$data['usuario'] = reset($this->usuario->getDadosUsuario('usu_id',$this->session->userdata('usu_id')));

		$this->load->view('configuracao_roteiro',$data);		
	}
	
	public function responsavel()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'configuracao';
		$data['menu_ativo'] = '.im_configuracao, .im_responsavel';
		$data['titulo_pagina'] = 'Configuração do sistema';
		$data['redirect'] = true;
		
		$this->load->model('Responsavel_model','responsavel');
		$data['responsavel'] = $this->responsavel->getDadosResponsavel($this->session->userdata('res_id'));
	
		$this->load->view('responsavel_form',$data);
	}	
		
}
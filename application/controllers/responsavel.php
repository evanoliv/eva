<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Responsavel extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_responsavel';
		$data['titulo_pagina'] = 'Responsáveis por Objetos Culturais';
		$data['redirect'] = true;
		
		$this->load->model('Responsavel_model','responsavel');
		$data['responsaveis'] = $this->responsavel->getResponsaveis($this->session->userdata['usu_id']);
	
		$this->load->view('responsavel',$data);
	}
	
	public function novo()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_responsavel';
		$data['titulo_pagina'] = 'Novo Responsável por Objetos Culturais';
		$data['redirect'] = true;
	
		$this->load->view('responsavel_form',$data);
	}
	
	public function cadastrar()
	{
		if(isset($_POST['responsavel'])){
			
			$responsavel = $_POST['responsavel'];
			$responsavel['usu_id'] = $this->session->userdata['usu_id'];
			
			$date = $responsavel['datanasc'];
			$responsavel['datanasc'] = (strpos($date,'-') > 0) ? $date : format_save_date($date); 
			
			$this->load->model('Responsavel_model','responsavel'); 
			
			if(!empty($responsavel['id'])){
				$this->responsavel->editarResponsavel($responsavel);
				$this->session->set_userdata('msg_sucesso','Dados pessoais editados com sucesso!');
			} else {
				$this->responsavel->cadastrarResponsavel($responsavel);
				$this->session->set_userdata('msg_sucesso','Responsável cadastrado com sucesso!');
			}
			
			redirect('configuracao/responsavel');
			
		}
	}
	
	public function show($resId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_responsavel';
		$data['titulo_pagina'] = 'Responsáveis por Objetos Culturais';
		$data['redirect'] = false;
		
		$this->load->model('Responsavel_model','responsavel');
		$data['responsavel'] = $this->responsavel->getDadosResponsavel($resId);
		
		$this->load->model('Objeto_model','objeto');
		$data['objetos'] = $this->objeto->getObjetosByResponsavel($data['responsavel']->res_id);
	
		$this->load->view('responsavel_show',$data);
	}
	
	public function editar($resId)
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_responsavel';
		$data['titulo_pagina'] = 'Editar Responsável por Objetos Culturais';
		$data['redirect'] = true;
		
		$this->load->model('Responsavel_model','responsavel');
		$data['responsavel'] = $this->responsavel->getDadosResponsavel($resId);
	
		$this->load->view('responsavel_form',$data);		
	}
	
	public function excluir($resId)
	{
		$this->load->model('Responsavel_model','responsavel');
		$result = $this->responsavel->excluirResponsavel($resId);
		
		if($result)
			$this->session->set_userdata('msg_sucesso','Responsável excluído com sucesso!');
		else
			$this->session->set_userdata('msg_erro','Existem objetos associados a este Responsável, não é possível excluí-lo.<br>Certifique-se de escolher um novo Responsável para tais objetos.<br><a href="'.base_url().'objeto/filtrar?objeto%5Bnome%5D=&objeto%5Btipo%5D=&objeto%5Bresponsavel%5D='.$resId.'">Clique aqui para visualizar estes Objetos.</a>');
		
		redirect('responsavel');
	}
	
	public function filtrar()
	{
		$data['tipo_menu'] = 'mapeamento';
		$data['tipo_menu_lateral'] = 'mapeamento';
		$data['menu_ativo'] = '.im_responsavel';
		$data['titulo_pagina'] = 'Responsáveis por Objetos Culturais';
		$data['redirect'] = true;
		
		$responsavel = $_GET['responsavel'];
		
		$data['filtro'] = $responsavel['nome'];
		
		$this->load->model('Responsavel_model','responsavel');
		$data['responsaveis'] = $this->responsavel->getResponsaveisByNome($responsavel['nome']);
	
		$this->load->view('responsavel',$data);	
	}

}
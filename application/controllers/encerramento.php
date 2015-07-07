<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encerramento extends CI_Controller {

	public function index()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento';
		
		$this->load->view('encerramento',$data);
	}	

	public function desproducao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_desproducao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_desproducao';
		
		$this->load->view('encerramento_desproducao',$data);
	}	

	public function agradecimento()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_agradecimento';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_agradecimento';
		
		$this->load->view('encerramento_agradecimento',$data);
	}	

	public function prestacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_prestacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_prestacao';
		
		$tipoItens = '4'; //recolhimento
		
		$this->load->model('Custo_model','custo');
		$data['custos'] = $this->custo->getCustos($this->session->userdata('eve_id'),$tipoItens);
		
		$custoTotal = 0;
		
		foreach ($data['custos'] as $custo)
			$custoTotal = $custoTotal + $custo->cus_valor; 
		
		$data['custoTotal'] = $custoTotal; 
		
		$this->load->view('encerramento_prestacao',$data);
	}
	
	public function novoCusto()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_prestacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_prestacao';
		
		$tipoItens = '4'; //recolhimento
		
		$this->load->model('Custo_model','custo');
		$data['itens'] = $this->custo->getItens($tipoItens);
		
		$this->load->view('encerramento_prestacao_form',$data);
	}
	
	public function cadastrarCusto()
	{
		if(isset($_POST['custo'])){
			
			$custo = $_POST['custo'];
			$custo['eve_id'] = $this->session->userdata('eve_id');
			$custo['tipo'] = '4';
			
			$this->load->model('Custo_model','custo'); 
			
			if(!empty($custo['id'])){
				$this->custo->editarCusto($custo);
				$this->session->set_userdata('msg_sucesso','Recolhimento editado com sucesso!');
				redirect('encerramento/prestacao');
			} else {
				$this->custo->cadastrarCusto($custo);
				$this->session->set_userdata('msg_sucesso','Recolhimento cadastrado com sucesso!');
				redirect('encerramento/novoCusto');
			}
			
		}
	}
	
	public function editarCusto($cusId)
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_prestacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_prestacao';
		
		$tipoItens = '4'; //recolhimento
		
		$this->load->model('Custo_model','custo');
		$data['itens'] = $this->custo->getItens($tipoItens);
		
		$data['custo'] = $this->custo->getCusto($cusId);
		
		$this->load->view('encerramento_prestacao_form',$data);
	}

	public function excluirCusto($cusId)
	{
		$this->load->model('Custo_model','custo');
		$this->custo->excluirCusto($cusId);
				
		$this->session->set_userdata('msg_sucesso','Recolhimento excluído com sucesso!');
		redirect('encerramento/prestacao');
	}

	public function documentacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_documentacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_documentacao';
		
		$this->load->view('encerramento_documentacao',$data);
	}	

	public function catalogacao()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_catalogacao';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_catalogacao';
		
		$this->load->view('encerramento_catalogacao',$data);
	}	

	public function clipping()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_clipping';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_clipping';
		
		$this->load->view('encerramento_clipping',$data);
	}	

	public function certificado()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_certificado';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_certificado';
		
		$this->load->view('encerramento_certificado',$data);
	}	

	public function questionario()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_questionario';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_questionario';
		
		$this->load->view('encerramento_questionario',$data);
	}	

	public function relatorio()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_relatorio';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_relatorio';
		
		$this->load->view('encerramento_relatorio',$data);
	}	

	public function resultado()
	{
		$data['tipo_menu'] = 'evento';
		$data['tipo_menu_lateral'] = 'encerramento';
		$data['menu_ativo'] = '.im_encerramento, .im_resultado';
		$data['titulo_pagina'] = $this->session->userdata('eve_nome');
		$data['redirect'] = true;
		$data['roteiro'] = 'roteiro/roteiro_encerramento_resultado';
		
		$this->load->view('encerramento_resultado',$data);
	}	
	
}
<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div class="col-md-4"></div>
  			<div class="col-md-4">		
  				<?php $usuario = array('mirandarafael94@gmail.com','ficaoficial@gmail.com','admin@sistemaeva.com.br','lucaspeixoto@sistemaeva.com.br','paulonunes.unifei@gmail.com','doocavendish@gmail.com','meloarafael@gmail.com','jayabatista@gmail.com','g.belleze@gmail.com','gabrielesevaristo@gmail.com','noronha13@gmail.com','nmotap@gmail.com')?>
  				<div class="botao_inicio"><a href="<?=base_url()?><?=($this->session->userdata('usu_email')) ? (in_array($this->session->userdata('usu_email'),$usuario)) ? 'evento/selecionar' : '#' : '#' ?>"><br><br>GESTÃO<br>DE EVENTOS<br>(em breve)</a></div>
				<div class="botao_inicio"><a href="<?=base_url()?>mapeamento/show"><br><br>CADASTRO<br>DE OBJETOS<br>CULTURAIS</a></div>
				<?=imprimeMsg()?>
				
				<div class="sobre">
				<br><br>
					Sistema desenvolvido por <a href="mailto:lucaspeixoto@sistemaeva.com.br"><strong>Lucas Peixoto</strong></a>
				</div>
			</div>
  			<div class="col-md-4">
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			<legend><?=$this->session->userdata('usu_nome')?></legend>
			E-mail: <a href="mailto:<?=$this->session->userdata('usu_email')?>"><?=$this->session->userdata('usu_email')?></a><br>
			Criado em: <?=date_format(date_create($this->session->userdata('usu_criado_em')),'d/m/Y H:i:s')?><br>
			Último acesso em: <?=date_format(date_create($this->session->userdata('usu_ultimo_login')),'d/m/Y H:i:s')?>
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>
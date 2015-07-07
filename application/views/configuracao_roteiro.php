<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Roteiro</legend>
		
			<?=imprimeMsg()?>
			
			<form action="<?=base_url()?>usuario/configuraroteiro" method="post" id="form_cadastro">
				<input type="checkbox" name="usuario[roteiro]" <?=($usuario->usu_roteiro == '1') ? 'checked' : ''?>> Desejo ver todas as abas de roteiro do Sistema EVA.
				<br>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
			</form>
			
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>
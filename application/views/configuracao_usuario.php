<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<?=imprimeMsg()?>

			<form action="<?=base_url()?>usuario/trocadados" method="post">				
				
				<legend>Dados de acesso</legend>
				
				Nome: <input value="<?=$this->session->userdata('usu_nome')?>" type="text" name="usuario[nome]" class="form-control formG" maxlength="255" required>
				E-mail: <input value="<?=$this->session->userdata('usu_email')?>" type="text" name="usuario[email]" class="form-control formG" maxlength="255" required>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
			</form>
			
			<form action="<?=base_url()?>usuario/trocasenha" method="post" id="form_cadastro">

				<legend>Mudar senha</legend>
	
				Senha atual: <input type="password" name="usuario[senha_atual]" class="form-control formP"  maxlength="255" required><br>
				Nova senha: <input type="password" name="usuario[senha]" class="form-control formP" id="senha" maxlength="255" required>
				Confirmar nova senha: <input type="password" class="form-control formP" id="confirma_senha" required>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
			</form>
			
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>
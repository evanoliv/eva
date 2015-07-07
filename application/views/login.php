<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div class="col-md-4"></div>
  			<div class="col-md-4">
  				<?=imprimeMsg()?>
  				<br>		
  				<div class="quadro-login">
					<form action="<?=base_url()?>login/entrar" method="post">
						E-mail: <input type="text" name="login[email]" class="form-control" required>
						Senha: <input type="password" name="login[senha]" class="form-control" required>
						<br>
						<!-- TODO <input type="checkbox" name="permanecer_logado" class=""><br><br> Permanecer logado -->
						<input type="submit" value="Entrar" class="btn btn-primary">
						<!-- TODO <a href="login/enviarsenha">Perdi minha senha</a> -->
					</form>
					
					Não possui um cadastro? <a href="<?=base_url()?>usuario">Clique aqui</a> e se cadastre, é gratuito!
  				</div>
			</div>
  			<div class="col-md-4"></div>
		</div>
	</div>
</div>

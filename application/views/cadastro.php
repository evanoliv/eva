<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div class="col-md-4"></div>
  			<div class="col-md-4">
  				<?=imprimeMsg()?>
  				<br>		
  				<div class="quadro-login">
					<form action="<?=base_url()?>usuario/cadastrar" method="post" id="form_cadastro">
						Nome completo: <input type="text" name="usuario[nome]" class="form-control"  maxlength="255" required>
						E-mail: <input type="email" name="usuario[email]" class="form-control"  maxlength="255" required>
						Senha: <input type="password" name="usuario[senha]" class="form-control" id="senha" required>
						Confirmar senha: <input type="password" class="form-control" id="confirma_senha" required>
						<br>
						<legend>Endereço</legend>
		
						<div class="form-group">
							CEP *
							<div class="inputCep">					
								<input class="formCep form-control" type="text" name="responsavel[cep]" required>
								<img src="<?=base_url()?>img/spinner.gif" style="float: right;">
							</div>
							Preencha o CEP e o número, a busca pelo endereço é automática				
						</div>
						<div class="form-group">
							Endereço
							<input class="formEndereco form-control" type="text" name="responsavel[endereco]">
						</div>
						<div class="form-group">
							Número *
							<input class="form-control formNumero" type="text" maxlength="255" name="responsavel[numero]" required>
						</div>
						<div class="form-group">
							Complemento
							<input class="form-control" maxlength="255" type="text" name="responsavel[complemento]">
						</div>
						<div class="form-group">
							Bairro
							<input class="formBairro form-control" type="text" name="responsavel[bairro]">
						</div>
						<div class="form-group">
							Cidade<br>
							<input value="<?=(!empty($responsavel->res_cidade)) ? $responsavel->res_cidade : "" ?>" class="formCidade" type="hidden" name="responsavel[cidade]">
							<span class="formSpanCidade"><?=(!empty($responsavel->res_cidade)) ? $responsavel->res_cidade : "<br>" ?></span>
						</div>
						<div class="form-group">
							Estado<br>
							<input value="<?=(!empty($responsavel->res_estado)) ? $responsavel->res_estado : "" ?>" class="formEstado" type="hidden" name="responsavel[estado]">
							<span class="formSpanEstado"><?=(!empty($responsavel->res_estado)) ? $responsavel->res_estado : "<br>" ?></span>
			            </div>
						<input type="submit" value="Enviar" class="btn btn-success">
					</form>
  				</div>
			</div>
  			<div class="col-md-4"></div>
		</div>
	</div>
</div>
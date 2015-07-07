<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>iniciacao/enviarConvite" method="post" id="conviteForm">
				
				<?=imprimeMsg()?>
			
				<legend>Enviar convite para participar da gestão do	evento</legend>
								
				<div class="form-group">
					<label>E-mail *</label>
					<input class="formG form-control" type="text" name="convite[email]" required>
				</div>
				<div class="form-group">
					<label>Papel *</label>
					<select class="formG form-control" name="convite[papel]" required>
						<option value="">Selecione...</option>
						<option value="admin">Coordenador Geral</option>
						<option value="coordenador">Coordenador</option>
						<option value="produtor">Produtor</option>
					</select>
				</div>
				
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
					
			</form>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
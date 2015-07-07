<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>planejamento/cadastrarVeiculo" method="post" id="veiculoForm">
				
				<input value="<?=(!empty($veiculo->vei_id)) ? $veiculo->vei_id : "" ?>" class="registroId" type="hidden" name="veiculo[id]">
				
				<legend>Informações sobre o veículo</legend>
								
				<div class="form-group">
					<label>Modelo *</label>
					<input value="<?=(!empty($veiculo->vei_modelo)) ? $veiculo->vei_modelo : "" ?>" class="formG form-control" type="text" name="veiculo[modelo]" maxlength="45" required>
				</div>
				<div class="form-group">
					<label>Marca</label>
					<input value="<?=(!empty($veiculo->vei_marca)) ? $veiculo->vei_marca : "" ?>" class="formG form-control" type="text" name="veiculo[marca]" maxlength="45">
				</div>
				<div class="form-group">
					<label>Cor</label>
					<input value="<?=(!empty($veiculo->vei_cor)) ? $veiculo->vei_cor : "" ?>" class="formP form-control" type="text" name="veiculo[cor]" maxlength="45">
				</div>
				<div class="form-group">
					<label>Placa *</label>
					<input value="<?=(!empty($veiculo->vei_placa)) ? $veiculo->vei_placa : "" ?>" class="formP form-control" type="text" name="veiculo[placa]" maxlength="45" required>
				</div>
				<div class="form-group">
					<label>Lugares</label>
					<input value="<?=(!empty($veiculo->vei_lugares)) ? $veiculo->vei_lugares : "" ?>" class="formP form-control" type="number" name="veiculo[lugares]">
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
<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Informações sobre o veículo</legend>

			<div class="form-group">
				<label>Modelo</label>
				<span id="helpBlock" class="help-block"><?=(!empty($veiculo->vei_modelo)) ? $veiculo->vei_modelo : "" ?></span>
			</div>
			<div class="form-group">
				<label>Marca</label>
				<span id="helpBlock" class="help-block"><?=(!empty($veiculo->vei_marca)) ? $veiculo->vei_marca : "" ?></span>
			</div>
			<div class="form-group">
				<label>Cor</label>
				<span id="helpBlock" class="help-block"><?=(!empty($veiculo->vei_cor)) ? $veiculo->vei_cor : "" ?></span>
			</div>
			<div class="form-group">
				<label>Placa</label>
				<span id="helpBlock" class="help-block"><?=(!empty($veiculo->vei_placa)) ? $veiculo->vei_placa : "" ?></span>
			</div>
			<div class="form-group">
				<label>Lugares</label>
				<span id="helpBlock" class="help-block"><?=(!empty($veiculo->vei_lugares)) ? $veiculo->vei_lugares : "" ?></span>
			</div>
			<br>

			<a href="<?=base_url()?>planejamento/editarVeiculo/<?=$veiculo->vei_id?>" class="btn btn-success">Editar</a>
			<a href="<?=base_url()?>planejamento/excluirVeiculo/<?=$veiculo->vei_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
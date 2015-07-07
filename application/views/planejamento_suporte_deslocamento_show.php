<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Informações sobre o deslocamento</legend>

				<div class="form-group">
					<label>Atração</label>
					<?php foreach ($atracoes as $atracao):?>
						<span id="helpBlock" class="help-block"><?=($atracao->atr_id == $deslocamento->des_atr_id) ? '<a href="'.base_url().'evento/atracao/'.$atracao->atr_id.'">'.$atracao->obj_nome.'</a>' : '' ?></span>
					<?php endforeach;?>
				</div>
				<div class="form-group">
					<label>Motorista</label>
					<?php foreach ($motoristas as $motorista):?>
						<span id="helpBlock" class="help-block"><?=($motorista->mot_id == $deslocamento->des_mot_id) ? '<a href="'.base_url().'planejamento/showMotorista/'.$motorista->mot_id.'">'.$motorista->mot_nome.'</a>' : '' ?></span>
					<?php endforeach;?>
				</div>
				<div class="form-group">
					<label>Veículo</label>
					<?php foreach ($veiculos as $veiculo):?>
						<span id="helpBlock" class="help-block"><?=($veiculo->vei_id == $deslocamento->des_vei_id) ? '<a href="'.base_url().'planejamento/showVeiculo/'.$veiculo->vei_id.'">'.$veiculo->vei_modelo.' - '.$veiculo->vei_cor.'</a>' : '' ?></span>
					<?php endforeach;?>
				</div>
				<div class="form-group">
	       			<label>Saída</label>
	       			<span id="helpBlock" class="help-block"><?=format_data($deslocamento->des_saida)?></span>
				</div>				
				<div class="form-group">
	       			<label>Chegada</label>
	       			<span id="helpBlock" class="help-block"><?=format_data($deslocamento->des_chegada)?></span>
				</div>
				<div class="form-group">
					<label>Endereço de origem</label>
					<span id="helpBlock" class="help-block"><?=nl2br($deslocamento->des_origem)?></span>
				</div>
				<div class="form-group">
					<label>Endereço de destino</label>
					<span id="helpBlock" class="help-block"><?=nl2br($deslocamento->des_destino)?></span>
				</div>
				<div class="form-group">
					<label>Observações</label>
					<span id="helpBlock" class="help-block"><?=(!empty($deslocamento->des_observacao)) ? nl2br($deslocamento->des_observacao) : '<br><br>' ?></span>
				</div>

				<a href="<?=base_url()?>planejamento/editarDeslocamento/<?=$deslocamento->des_id?>" class="btn btn-success">Editar</a>
				<a href="<?=base_url()?>planejamento/excluirDeslocamento/<?=$deslocamento->des_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
			
			</div>
			<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
				<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
			</div>
		</div>
	</div>
</div>

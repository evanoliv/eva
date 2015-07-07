<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Informações sobre a acomodação</legend>
							
			<div class="form-group">
				<label>Atração</label>
				<?php foreach ($atracoes as $atracao):?>
					<span id="helpBlock" class="help-block"><?=($atracao->atr_id == $acomodacao->aco_atr_id) ? '<a href="'.base_url().'evento/atracao/'.$atracao->atr_id.'">'.$atracao->obj_nome.'</a>' : '' ?></span>
				<?php endforeach;?>
			</div>
			<div class="form-group">
				<label>Hospedaria</label>
				<?php foreach ($hospedagens as $hospedagem):?>
					<span id="helpBlock" class="help-block"><?=($hospedagem->hos_id == $acomodacao->aco_hos_id) ? '<a href="'.base_url().'planejamento/showHospedagem/'.$hospedagem->hos_id.'">'.$hospedagem->hos_nome.'</a>' : '' ?></span>
				<?php endforeach;?>
			</div>
			<div class="form-group">
	       		<label>Chegada na hospedaria</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($acomodacao->aco_chegada)) ? format_data($acomodacao->aco_chegada) : '<br>' ?></span>
			</div>				
			<div class="form-group">
	       		<label>Saída da hospedaria</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($acomodacao->aco_saida)) ? format_data($acomodacao->aco_saida) : '<br>' ?></span>
			</div>				
			<div class="form-group">
	       		<label>Quantidade de almoços</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($acomodacao->aco_almoco)) ? $acomodacao->aco_almoco : '<br>' ?></span>
			</div>				
			<div class="form-group">
	       		<label>Quantidade de jantas</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($acomodacao->aco_janta)) ? $acomodacao->aco_janta : '<br>' ?></span>
			</div>				
			<div class="form-group">
	       		<label>Quantidade de caterings</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($acomodacao->aco_catering)) ? $acomodacao->aco_catering : '<br>' ?></span>
			</div>	
			<div class="form-group">
				<label>Observações</label>
				<span id="helpBlock" class="help-block"><?=(!empty($acomodacao->aco_observacao)) ? nl2br($acomodacao->aco_observacao) : '<br><br>' ?></span>
			</div>			

			<a href="<?=base_url()?>planejamento/editarAcomodacao/<?=$acomodacao->aco_id?>" class="btn btn-success">Editar</a>
			<a href="<?=base_url()?>planejamento/excluirAcomodacao/<?=$acomodacao->aco_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
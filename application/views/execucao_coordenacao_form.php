<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Participação nas apresentações</legend>

				<form action="<?=base_url()?>execucao/cadastrarParticipacao" method="post" id="participacaoForm">
					
					<input value="<?=(!empty($participacao->par_id)) ? $participacao->par_id : "" ?>" class="registroId" type="hidden" name="participacao[id]">
					
					<div class="form-group">
						<label>Apresentação *</label>
						<select class="formG form-control" name="participacao[apresentacao]" required>
							<option value="">Selecione...</option>
							<?php foreach ($apresentacoes as $apresentacao):?>
								<option value="<?=$apresentacao->apr_id?>" <?=(!empty($participacao)) ? ($apresentacao->apr_id == $participacao->par_apr_id) ? 'selected' : '' : ''?>><?=format_show($apresentacao->apr_data)?> - <?=format_time($apresentacao->apr_hora)?> - <?=$apresentacao->atracao->obj_nome?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Membro *</label>
						<select class="formG form-control" name="participacao[papel]" required>
							<option value="">Selecione...</option>
							<?php foreach ($papeis as $papel):?>
								<option value="<?=$papel->pap_id?>" <?=(!empty($participacao)) ? ($papel->pap_id == $participacao->par_pap_id) ? 'selected' : '' : ''?>><?=$papel->usu_nome?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Observações</label>
						<textarea class="formText form-control" name="participacao[observacao]"><?=(isset($participacao->par_observacao)) ? $participacao->par_observacao : "" ?></textarea>
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
</div>

<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>iniciacao/cadastrarDivulgacao" method="post" id="divulgacaoForm">
				
				<input value="<?=(!empty($divulgacao->div_id)) ? $divulgacao->div_id : "" ?>" class="registroId" type="hidden" name="divulgacao[id]">
				
				<?=imprimeMsg()?>
			
				<legend>Divulgações</legend>
								
				<div class="form-group">
					<label>Peça *</label>
					<select class="formG form-control" name="divulgacao[peca]" required>
						<option value="">Selecione...</option>
						<?php foreach ($pecas as $peca):?>
							<option value="<?=$peca->pec_id?>" <?=(!empty($divulgacao)) ? ($divulgacao->div_pec_id == $peca->pec_id) ? 'selected' : '' : ''?>><?=$peca->pec_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label>Meio *</label>
					<select class="formP form-control" name="divulgacao[meio]" required>
						<option value="">Selecione...</option>
						<?php foreach ($meios as $meio):?>
							<option value="<?=$meio->mei_id?>" <?=(!empty($divulgacao)) ? ($divulgacao->div_mei_id == $meio->mei_id) ? 'selected' : '' : ''?>><?=$meio->mei_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label>Valor total *</label>
					<input value="<?=(!empty($divulgacao->div_valor)) ? $divulgacao->div_valor : "" ?>" class="formP form-control formValor" type="text" name="divulgacao[valor]" required>
				</div>
				<div class="form-group">
					<label>Descrição</label>
					<textarea class="formText form-control" name="divulgacao[descricao]"><?=(!empty($divulgacao->div_descricao)) ? $divulgacao->div_descricao : "" ?></textarea>
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
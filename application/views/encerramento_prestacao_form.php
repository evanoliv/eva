<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>encerramento/cadastrarCusto" method="post" id="custoForm">
				
				<input value="<?=(!empty($custo->cus_id)) ? $custo->cus_id : "" ?>" class="registroId" type="hidden" name="custo[id]">
				
				<?=imprimeMsg()?>
			
				<legend>Custos</legend>
								
				<div class="form-group">
					<label>Item *</label>
					<select class="formG form-control" name="custo[item]" required>
						<option value="">Selecione...</option>
						<?php foreach ($itens as $item):?>
							<option value="<?=$item->ite_id?>" <?=(!empty($custo)) ? ($custo->cus_ite_id == $item->ite_id) ? 'selected' : '' : ''?>><?=$item->ite_descricao?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label>Valor total *</label>
					<input value="<?=(!empty($custo->cus_valor)) ? $custo->cus_valor : "" ?>" class="formP form-control formValor" type="text" name="custo[valor]" required>
				</div>
				<div class="form-group">
					<label>Descrição</label>
					<textarea class="formText form-control" name="custo[descricao]"><?=(!empty($custo->cus_descricao)) ? $custo->cus_descricao : "" ?></textarea>
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
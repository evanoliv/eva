<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Reunião</legend>

				<form action="<?=base_url()?>evento/cadastrarReuniao" method="post" id="reuniaoForm">
					
					<input value="<?=(!empty($reuniao->reu_id)) ? $reuniao->reu_id : "" ?>" class="registroId" type="hidden" name="reuniao[id]">
					
					<div class="form-group">
		       			<label>Título *</label>
		       			<input value="<?=(!empty($reuniao->reu_titulo)) ? $reuniao->reu_titulo : "" ?>" class="formG form-control" type="text" maxlength="255" name="reuniao[titulo]" required>
					</div>				
					<div class="form-group">
		       			<label>Data *</label>
		       			<input value="<?=(!empty($reuniao->reu_data)) ? $reuniao->reu_data : "" ?>" class="formP form-control" type="date" name="reuniao[data]" required>
					</div>				
					<div class="form-group">
		       			<label>Hora *</label>
		       			<input value="<?=(!empty($reuniao->reu_hora)) ? $reuniao->reu_hora : "" ?>" class="formP form-control" type="time" name="reuniao[hora]" required>
					</div>				
					<div class="form-group">
		       			<label>Local *</label>
		       			<input value="<?=(!empty($reuniao->reu_local)) ? $reuniao->reu_local : "" ?>" class="formG form-control" type="text" maxlength="255" name="reuniao[local]" required>
					</div>
					<div class="form-group">
						<label>Coordenadores presentes</label>
						<?php foreach ($papeis as $papel):?>
							<input value="<?=$papel->pap_id?>" <?=(!empty($presenca)) ? in_array($papel->pap_id,$presenca) ? 'checked' : '' : ''?> type="checkbox" name="reuniao[presenca][]"><?=$papel->usu_nome?> <br>
						<?php endforeach;?>
					</div>
					<div class="form-group">
						<label>Pauta *</label>
						<textarea class="formText form-control" name="reuniao[pauta]" required><?=(isset($reuniao->reu_pauta)) ? $reuniao->reu_pauta : "" ?></textarea>
					</div>
					<div class="form-group">
						<label>Ata *</label>
						<textarea class="formText form-control" name="reuniao[ata]" required><?=(isset($reuniao->reu_ata)) ? $reuniao->reu_ata : "" ?></textarea>
					</div>
					<br>
					<input type="submit" value="Enviar" class="btn btn-success">
						
				</form>
			
			</div>
		</div>
	</div>
</div>

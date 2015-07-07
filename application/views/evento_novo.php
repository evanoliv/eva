<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="conteudo" style="margin-left: 0px;">

				<form action="<?=base_url()?>evento/cadastrarEvento/<?=$objeto->obj_id?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="objetoForm">
				
					<div class="form-group">
						<label>Nome *</label>
						<input value="<?=(isset($objeto->obj_nome)) ? $objeto->obj_nome: "" ?>" class="formG form-control" type="text" name="objeto[nome]" maxlength="255" required>
					</div>
					<div class="form-group">
						<label>Release *</label>
						<textarea class="formText form-control formObjResumo" name="objeto[resumo]" maxlength="400" required><?=(isset($objeto->obj_resumo)) ? $objeto->obj_resumo : "" ?></textarea>
						<span id="helpBlock" class="help-block">Mínimo de 100 caracteres. Máximo de 400 caracteres</span>
					</div>
					<div class="form-group">
			       		<label>Evento Público?</label>
			       		<input type="checkbox" name="objeto[publico]" <?=(isset($objeto->obj_publico)) ? ($objeto->obj_publico == '1') ? 'checked' : '' : 'checked'?>> Sim
		       			<span id="helpBlock" class="help-block">Eventos públicos são visíveis a todos que acessam o Sistema EVA</span>
					</div>
					
					<legend>Tarefas de auxílio à gestão do evento</legend>
					
					<div class="form-group">
			       		<label>Importar tarefas?</label>
			       		<input type="checkbox" name="objeto[importar]" <?=(isset($objeto->obj_publico)) ? ($objeto->obj_publico == '1') ? 'checked' : '' : 'checked'?>> Sim
		       			<span id="helpBlock" class="help-block">Serão adicionadas 25 tarefas que auxiliarão na gestão do evento, desde o momento de sua criação até a sua finalização.</span>
					</div>
					<br>
					<input type="submit" value="Iniciar gestão do evento" class="btn btn-success">
						
				</form>
			</div>
		</div>
	</div>
</div>

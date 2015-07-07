<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Reunião</legend>

				<input value="<?=(!empty($reuniao->reu_id)) ? $reuniao->reu_id : "" ?>" class="registroId" type="hidden" name="reuniao[id]">
				
				<div class="form-group">
	       			<label>Título</label>
	       			<span class="help-block"><?=(!empty($reuniao->reu_titulo)) ? $reuniao->reu_titulo : "<br>" ?></span>
				</div>				
				<div class="form-group">
	       			<label>Data</label>
	       			<span class="help-block"><?=(!empty($reuniao->reu_data)) ? format_show($reuniao->reu_data) : "<br>" ?></span>
				</div>				
				<div class="form-group">
	       			<label>Hora</label>
	       			<span class="help-block"><?=(!empty($reuniao->reu_hora)) ? format_time($reuniao->reu_hora) : "<br>" ?></span>
				</div>				
				<div class="form-group">
	       			<label>Local</label>
	       			<span class="help-block"><?=(!empty($reuniao->reu_local)) ? $reuniao->reu_local : "<br>" ?></span>
				</div>		
				<div class="form-group">
					<label>Coordenadores presentes</label>
					<?php foreach ($papeis as $papel):?>
						<span class="help-block"><?=(!empty($presenca)) ? in_array($papel->pap_id,$presenca) ? $papel->usu_nome : '' : ''?></span>
					<?php endforeach;?>
				</div>
				<div class="form-group">
					<label>Pauta</label>
					<span class="help-block"><?=(isset($reuniao->reu_pauta)) ? nl2br($reuniao->reu_pauta) : "<br>" ?></span>
				</div>
				<div class="form-group">
					<label>Ata</label>
					<span class="help-block"><?=(isset($reuniao->reu_ata)) ? nl2br($reuniao->reu_ata) : "<br>" ?></span>
				</div>
				<br>
				
				<a href="<?=base_url()?>evento/editarReuniao/<?=$reuniao->reu_id?>" class="btn btn-success">Editar</a>
				<a href="<?=base_url()?>evento/excluirReuniao/<?=$reuniao->reu_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
				
			</div>
		</div>
	</div>
</div>

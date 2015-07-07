<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Informações sobre a tarefa</legend>
							
			<div class="form-group">
				<label>Responsável</label>
				<?php foreach ($usuarios as $usuario):?>
					<span id="helpBlock" class="help-block"><?=($tarefa->tar_usu_id == $usuario->usu_id) ? '<a href="'.base_url().'evento/perfil/'.$usuario->usu_id.'">'.$usuario->usu_nome.'</a>' : ''?></span>
				<?php endforeach;?>
			</div>
			<div class="form-group">
				<label>Categoria</label>
				<span id="helpBlock" class="help-block"><?=$tarefa->tar_categoria?></span>
			</div>
			<div class="form-group">
				<label>Título</label>
				<span id="helpBlock" class="help-block"><?=$tarefa->tar_titulo?></span>
			</div>
			<div class="form-group">
				<label>Descrição</label>
				<span id="helpBlock" class="help-block"><?=(!empty($tarefa->tar_descricao)) ? nl2br($tarefa->tar_descricao) : '<br>' ?></span>
			</div>
			<div class="form-group">
				<label>Situação</label>
				<span id="helpBlock" class="help-block corSituacaoTarefa"><?=(!empty($tarefa->tar_situacao)) ? $tarefa->tar_situacao : '<br>' ?></span>
			</div>
			<div class="form-group">
				<label>Prioridade</label>
				<span id="helpBlock" class="help-block corPrioridadeTarefa"><?=(!empty($tarefa->tar_prioridade)) ? $tarefa->tar_prioridade : '<br>' ?></span>
			</div>	
			<div class="form-group">
	       		<label>Data de início</label>
				<span id="helpBlock" class="help-block"><?=(!empty($tarefa->tar_data_inicio)) ? format_show($tarefa->tar_data_inicio) : '<br>' ?></span>
			</div>			
			<div class="form-group">
	       		<label>Data de conclusão</label>
				<span id="helpBlock" class="help-block corDataTarefa"><?=(!empty($tarefa->tar_data_conclusao)) ? format_show($tarefa->tar_data_conclusao) : '<br>' ?></span>
			</div>			
			<div class="form-group">
	       		<label>Tempo estimado</label>
				<span id="helpBlock" class="help-block"><?=(!empty($tarefa->tar_tempo)) ? format_time($tarefa->tar_tempo) : '<br>' ?></span>
			</div>			
			<br>
			
			<a href="<?=base_url()?>iniciacao/editarTarefa/<?=$tarefa->tar_id?>" class="btn btn-success">Editar</a>
			<a href="<?=base_url()?>iniciacao/excluirTarefa/<?=$tarefa->tar_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
						
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
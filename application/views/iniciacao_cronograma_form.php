<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>iniciacao/cadastrarTarefa" method="post" id="tarefaForm">
				
				<input value="<?=(!empty($tarefa->tar_id)) ? $tarefa->tar_id : "" ?>" class="registroId" type="hidden" name="tarefa[id]">
				
				<?=imprimeMsg()?>
			
				<legend>Tarefas</legend>
								
				<div class="form-group">
					<label>Responsável *</label>
					<select class="formG form-control" name="tarefa[usuario]" required>
						<option value="">Selecione...</option>
						<?php foreach ($usuarios as $usuario):?>
							<option value="<?=$usuario->usu_id?>" <?=(!empty($tarefa)) ? ($tarefa->tar_usu_id == $usuario->usu_id) ? 'selected' : '' : ''?>><?=$usuario->usu_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label>Categoria *</label>
					<select class="formG form-control" name="tarefa[categoria]" required>
						<option value="">Selecione...</option>
						<option value="Coordenação Geral" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Coordenação Geral') ? 'selected' : '' : ''?>>Coordenação Geral</option>
						<option value="Coordenação de Produção" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Coordenação de Produção') ? 'selected' : '' : ''?>>Coordenação de Produção</option>
						<option value="Coordenação Administrativa e Financeira" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Coordenação Administrativa e Financeira') ? 'selected' : '' : ''?>>Coordenação Administrativa e Financeira</option>
						<option value="Coordenação de Programação" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Coordenação de Programação') ? 'selected' : '' : ''?>>Coordenação de Programação</option>
						<option value="Coordenação de Comunicação" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Coordenação de Comunicação') ? 'selected' : '' : ''?>>Coordenação de Comunicação</option>
						<option value="Coordenação de Recursos Humanos" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Coordenação de Recursos Humanos') ? 'selected' : '' : ''?>>Coordenação de Recursos Humanos</option>
						<option value="Produção" <?=(!empty($tarefa)) ? ($tarefa->tar_categoria == 'Produção') ? 'selected' : '' : ''?>>Produção</option>
					</select>
				</div>
				<div class="form-group">
					<label>Título *</label>
					<input value="<?=(!empty($tarefa->tar_titulo)) ? $tarefa->tar_titulo : "" ?>" class="formG form-control" type="text" name="tarefa[titulo]" required>
				</div>
				<div class="form-group">
					<label>Descrição *</label>
					<textarea class="formText form-control" name="tarefa[descricao]"><?=(!empty($tarefa->tar_descricao)) ? $tarefa->tar_descricao : "" ?></textarea>
				</div>
				<div class="form-group">
					<label>Situação</label>
					<select class="formP form-control" name="tarefa[situacao]">
						<option value="">Selecione...</option>
						<option value="Aberta" <?=(!empty($tarefa)) ? ($tarefa->tar_situacao == 'Aberta') ? 'selected' : '' : ''?>>Aberta</option>
						<option value="Executando" <?=(!empty($tarefa)) ? ($tarefa->tar_situacao == 'Executando') ? 'selected' : '' : ''?>>Executando</option>
						<option value="Concluída" <?=(!empty($tarefa)) ? ($tarefa->tar_situacao == 'Concluída') ? 'selected' : '' : ''?>>Concluída</option>
						<option value="Aprovada" <?=(!empty($tarefa)) ? ($tarefa->tar_situacao == 'Aprovada') ? 'selected' : '' : ''?>>Aprovada</option>
					</select>
				</div>
				<div class="form-group">
					<label>Prioridade</label>
					<select class="formP form-control" name="tarefa[prioridade]">
						<option value="">Selecione...</option>
						<option value="Baixa" <?=(!empty($tarefa)) ? ($tarefa->tar_prioridade == 'Baixa') ? 'selected' : '' : ''?>>Baixa</option>
						<option value="Normal" <?=(!empty($tarefa)) ? ($tarefa->tar_prioridade == 'Normal') ? 'selected' : '' : ''?>>Normal</option>
						<option value="Alta" <?=(!empty($tarefa)) ? ($tarefa->tar_prioridade == 'Alta') ? 'selected' : '' : ''?>>Alta</option>
						<option value="Urgente" <?=(!empty($tarefa)) ? ($tarefa->tar_prioridade == 'Urgente') ? 'selected' : '' : ''?>>Urgente</option>
					</select>
				</div>	
				<div class="form-group">
		       		<label>Data de início</label>
		       		<input value="<?=(!empty($tarefa->tar_data_inicio)) ? $tarefa->tar_data_inicio : "" ?>" class="formP form-control" type="date" name="tarefa[data_inicio]">
				</div>			
				<div class="form-group">
		       		<label>Data de conclusão</label>
		       		<input value="<?=(!empty($tarefa->tar_data_conclusao)) ? $tarefa->tar_data_conclusao : "" ?>" class="formP form-control" type="date" name="tarefa[data_conclusao]">
				</div>			
				<div class="form-group">
		       		<label>Tempo estimado</label>
		       		<input value="<?=(!empty($tarefa->tar_tempo)) ? $tarefa->tar_tempo : "" ?>" class="formP form-control formTempo" type="text" name="tarefa[tempo]">
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
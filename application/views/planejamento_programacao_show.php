<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Informações sobre a apresentação</legend>

				<div class="form-group">
					<label>Atração</label>
					<?php foreach ($atracoes as $atracao):?>
						<span id="helpBlock" class="help-block"><?=($atracao->atr_id == $apresentacao->apr_atr_id) ? '<a href="'.base_url().'evento/atracao/'.$atracao->atr_id.'">'.$atracao->obj_nome.'</a>' : '' ?></span>
					<?php endforeach;?>
				</div>
				<div class="form-group">
					<label>Local</label>
					<?php foreach ($locais as $local):?>
						<span id="helpBlock" class="help-block"><?=($local->loc_id == $apresentacao->apr_loc_id) ? '<a href="'.base_url().'evento/local/'.$local->loc_id.'">'.$local->obj_nome.'</a>' : '' ?></span>
					<?php endforeach;?>
				</div>
				<div class="form-group">
		       		<label>Data</label>
		       		<span id="helpBlock" class="help-block"><?=format_show($apresentacao->apr_data)?></span>
				</div>
				<div class="form-group">
		       		<label>Hora</label>
		       		<span id="helpBlock" class="help-block"><?=format_time($apresentacao->apr_hora)?></span>
				</div>
				<div class="form-group">
		       		<label>Duração</label>
		       		<span id="helpBlock" class="help-block"><?=format_time($apresentacao->apr_duracao)?></span>
				</div>
				<div class="form-group">
					<label>Observações</label>
					<span id="helpBlock" class="help-block"><?=(!empty($apresentacao->apr_observacao)) ? nl2br($apresentacao->apr_observacao) : '<br>' ?></span>
				</div>
							
				<a href="<?=base_url()?>planejamento/editarApresentacao/<?=$apresentacao->apr_id?>" class="btn btn-success">Editar</a>
				<a href="<?=base_url()?>planejamento/excluirApresentacao/<?=$apresentacao->apr_id?>" class="btn btn-danger excluirRegistro">Excluir</a>			
				<br><br>
		
				<legend>Participações</legend>
			
				<table class="table table-hover tblLegend">
					<thead>
						<th>Coordenadores</th>
						<th>Produtores</th>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php foreach ($apresentacao->coordenadores as $coordenador):?>
									<?php if($coordenador->par_apr_id == $apresentacao->apr_id):?>
										<a href="<?=base_url()?>evento/perfil/<?=$coordenador->usu_id?>"><?=$coordenador->usu_nome?></a><br>
									<?php endif;?>
								<?php endforeach;?>
							</td>
							<td>
								<?php foreach ($apresentacao->produtores as $produtor):?>
									<?php if($produtor->par_apr_id == $apresentacao->apr_id):?>
										<a href="<?=base_url()?>evento/perfil/<?=$produtor->usu_id?>"><?=$produtor->usu_nome?></a><br>
									<?php endif;?>
								<?php endforeach;?>
							</td>
						</tr>
					</tbody>
				</table>

		
			</div>
			
			
			<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
				<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
			</div>
		</div>
	</div>
</div>

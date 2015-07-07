<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">

			<?=imprimeMsg()?>
		
			<?php foreach ($diasEvento as $dia):?>
				<?php $participacaoMarcada = 0 ?>
				<legend>Participação no dia <?=format_show($dia->selected_date)?></legend>

				<table class="table table-hover tblApresentacao">
					<tbody>
						<?php if(!empty($participacoes)):?>
							<?php foreach ($participacoes as $participacao):?>
								<?php if($participacao->apr_data == $dia->selected_date):?>
									<?php $participacaoMarcada = 1 ?>
									<tr>
										<td><?=format_time($participacao->apr_hora)?></td>
										<td><a href="<?=base_url()?>evento/atracao/<?=$participacao->atracao->atr_id?>"><?=$participacao->atracao->obj_nome?></a></td>
										<td><a href="<?=base_url()?>evento/local/<?=$participacao->local->loc_id?>"><?=$participacao->local->obj_nome?></a></td>
										<td><a href="<?=base_url()?>evento/perfil/<?=$participacao->usuario->usu_id?>"><?=$participacao->usuario->usu_nome?></a></td>
										<td><a href="<?=base_url()?>execucao/editarParticipacao/<?=$participacao->par_id?>/producao"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
										<td><a href="<?=base_url()?>execucao/excluirParticipacao/<?=$participacao->par_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
									</tr>
								<?php endif;?>
							<?php endforeach;?>
						<?php endif;?>
						<?php if($participacaoMarcada == 0):?>
							<tr>
								<td>Nenhuma participação neste dia</td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
			<?php endforeach;?>
			<a href="<?=base_url()?>execucao/novoParticipacao/producao"><button class="btn btn-primary">Nova participação</button></a>
		
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
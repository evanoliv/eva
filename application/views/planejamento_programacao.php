<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<?=imprimeMsg()?>
		
			<?php foreach ($diasEvento as $dia):?>
				<?php $apresentacaoMarcada = 0 ?>
				<legend>Programação do dia <?=format_show($dia->selected_date)?></legend>

				<table class="table table-hover tblApresentacao">
					<tbody>
						<?php if(!empty($apresentacoes)):?>
							<?php foreach ($apresentacoes as $apresentacao):?>
								<?php if($apresentacao->apr_data == $dia->selected_date):?>
									<?php $apresentacaoMarcada = 1 ?>
									<tr>
										<td><?=format_time($apresentacao->apr_hora)?></td>
										<td><a href="<?=base_url()?>evento/atracao/<?=$apresentacao->atracao->atr_id?>"><?=$apresentacao->atracao->obj_nome?></a></td>
										<td><a href="<?=base_url()?>evento/local/<?=$apresentacao->local->loc_id?>"><?=$apresentacao->local->obj_nome?></a></td>
										<td><a href="<?=base_url()?>planejamento/showApresentacao/<?=$apresentacao->apr_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
										<td><a href="<?=base_url()?>planejamento/editarApresentacao/<?=$apresentacao->apr_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
										<td><a href="<?=base_url()?>planejamento/excluirApresentacao/<?=$apresentacao->apr_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
									</tr>
								<?php endif;?>
							<?php endforeach;?>
						<?php endif;?>
						<?php if($apresentacaoMarcada == 0):?>
							<tr>
								<td>Nenhuma apresentação marcada para este dia</td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
			<?php endforeach;?>
			
			<a href="<?=base_url()?>planejamento/novoApresentacao"><button class="btn btn-primary">Nova apresentação</button></a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<?=imprimeMsg()?>
					
			<table class="table table-hover">
				<thead>
					<th>Peça</th>
					<th>Meio</th>
					<th>Custo (R$)</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($divulgacoes)):?>
						<?php foreach ($divulgacoes as $divulgacao): ?>
							<tr>
								<td><?=$divulgacao->pec_nome?></td>
								<td><?=$divulgacao->mei_nome?></td>
								<td><?=number_format($divulgacao->div_valor,2,',','.')?></td>
								<td><a href="<?=base_url()?>iniciacao/editarDivulgacao/<?=$divulgacao->div_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>iniciacao/excluirDivulgacao/<?=$divulgacao->div_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma divulgação encontrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<div class="custoTotal">
				Total: R$ <?=number_format($custoTotal,2,',','.')?>
			</div>
			<br>
			<a href="<?=base_url()?>iniciacao/novoDivulgacao"><button class="btn btn-primary">Nova divulgação</button></a>		
		
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
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
					<th>Nome</th>
					<th>Cidade/Estado</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($hospedagens)):?>
						<?php foreach ($hospedagens as $hospedagem): ?>
							<tr>
								<td><?=$hospedagem->hos_nome?></td>
								<td><?=$hospedagem->hos_cidade?>/<?=$hospedagem->hos_estado?></td>
								<td><a href="<?=base_url()?>planejamento/showHospedagem/<?=$hospedagem->hos_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/editarHospedagem/<?=$hospedagem->hos_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/excluirHospedagem/<?=$hospedagem->hos_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma hospedaria encontrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<a href="<?=base_url()?>planejamento/novoHospedagem"><button class="btn btn-primary">Nova hospedaria</button></a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
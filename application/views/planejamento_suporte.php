<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">

			<?=imprimeMsg()?>
			
			<legend>Deslocamentos</legend>
		
			<table class="table table-hover tblLegend">
				<thead>
					<th>Atração</th>
					<th>Motorista</th>
					<th>Veículo</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($deslocamentos)):?>
						<?php foreach ($deslocamentos as $deslocamento): ?>
							<tr>
								<td><a href="<?=base_url()?>evento/atracao/<?=$deslocamento->atracao->atr_id?>"><?=$deslocamento->atracao->obj_nome?></a></td>
								<td><a href="<?=base_url()?>planejamento/showMotorista/<?=$deslocamento->mot_id?>"><?=$deslocamento->mot_nome?></a></td>
								<td><a href="<?=base_url()?>planejamento/showVeiculo/<?=$deslocamento->vei_id?>"><?=$deslocamento->vei_modelo?></a></td>
								<td><a href="<?=base_url()?>planejamento/showDeslocamento/<?=$deslocamento->des_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/editarDeslocamento/<?=$deslocamento->des_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/excluirDeslocamento/<?=$deslocamento->des_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum deslocamento registrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			
			<a href="<?=base_url()?>planejamento/novoDeslocamento"><button class="btn btn-primary">Novo deslocamento</button></a>
			<a href="<?=base_url()?>planejamento/motorista"><button class="btn btn-primary">Motoristas</button></a>	
			<a href="<?=base_url()?>planejamento/veiculo"><button class="btn btn-primary">Veículos</button></a>
			
			<br><br>
			<legend>Acomodações</legend>
			
			<table class="table table-hover tblLegend">
				<thead>
					<th>Atração</th>
					<th>Hospedaria</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($acomodacoes)):?>
						<?php foreach ($acomodacoes as $acomodacao): ?>
							<tr>
								<td><a href="<?=base_url()?>evento/atracao/<?=$acomodacao->atracao->atr_id?>"><?=$acomodacao->atracao->obj_nome?></a></td>
								<td><a href="<?=base_url()?>planejamento/showHospedagem/<?=$acomodacao->hos_id?>"><?=$acomodacao->hos_nome?></a></td>
								<td><a href="<?=base_url()?>planejamento/showAcomodacao/<?=$acomodacao->aco_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/editarAcomodacao/<?=$acomodacao->aco_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/excluirAcomodacao/<?=$acomodacao->aco_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma acomodação registrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
					
			<a href="<?=base_url()?>planejamento/novoAcomodacao"><button class="btn btn-primary">Nova acomodação</button></a>
			<a href="<?=base_url()?>planejamento/hospedagem"><button class="btn btn-primary">Hospedarias</button></a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
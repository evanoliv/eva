<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="conteudo" style="margin-left: 0px;">
				<legend>Em andamento</legend>
				<?php if(!empty($eventosAndamento)):?>
					<?php foreach ($eventosAndamento as $evento):?>
						<h4>
							<?=($evento->pap_papel == 'admin') ? '<span class="glyphicon glyphicon-star" aria-hidden=""></span>' : ''?>
							<a href="<?=base_url()?>evento/home/<?=$evento->eve_id?>"><?=$evento->eve_nome?></a>
						</h4>
					<?php endforeach;?>
				<?php else:?>
					<h5>Nenhum evento registrado</h5>
				<?php endif;?>
				<br>
				<legend>Finalizados</legend>
				<?php if(!empty($eventosFinalizados)):?>
					<?php foreach ($eventosFinalizados as $evento):?>
						<h4>
							<?=($evento->pap_papel == 'admin') ? '<span class="glyphicon glyphicon-star" aria-hidden=""></span>' : ''?>
							<?=$evento->eve_nome?>
						</h4>
					<?php endforeach;?>
				<?php else:?>
					<h5>Nenhum evento registrado</h5>
				<?php endif;?>
				<br>
				<legend>Cadastrados</legend>
				<?php if(!empty($eventosCadastrados)):?>
					<?php foreach ($eventosCadastrados as $evento):?>
						<div class="eventoCadastrado">
							<h4><a href="<?=base_url()?>objeto/show/<?=$evento->obj_id?>"><?=$evento->obj_nome?></a></h4>
							<h5><a href="<?=base_url()?>evento/novo/<?=$evento->obj_id?>"><span class="glyphicon glyphicon-star" aria-hidden=""></span> Realizar evento</a></h5>
						</div>
					<?php endforeach;?>
				<?php else:?>
					<h5><a href="<?=base_url()?>objeto/novo">Clique aqui para cadastrar um Objeto do tipo Evento e começar a sua gestão!</a></h5>
				<?php endif;?>
			</div>
			<!--
			<div id="roteiro"></div>
			-->
		</div>
	</div>
</div>

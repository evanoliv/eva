<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
	
			<legend><?=$evento->eve_nome?></legend>
			<?=$evento->eve_descricao?>
			<br><br>
			Data da realização: <?=format_show($evento->eve_data_inicial)?> <?=($evento->eve_data_final != '0000-00-00') ? 'a '.format_show($evento->eve_data_final) : '' ?>

			<br><br>
			Responsável: <a href="<?=base_url()?>responsavel/show/<?=$evento->res_id?>"><?=$evento->res_nome?></a> (<?=$evento->res_cidade?>/<?=$evento->res_estado?>)
			
			<br><br>
			<?php if($evento->eve_inscricao == '1'):?>
				<a href="<?=base_url()?>evento/inscricao/<?=$evento->eve_id?>" class="btn btn-info"><span class="glyphicon glyphicon-star" aria-hidden=""></span> Inscrever-se!</a>
			<?php endif;?>
			
		</div>
	</div>
</div>
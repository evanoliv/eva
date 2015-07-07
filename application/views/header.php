<?php include_once("analyticstracking.php") ?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>EVA - Sistema para Gestão de Eventos Culturais</title>
    	<link rel="shortcut icon" type="image/png" href="<?=base_url()?>img/favicon.png">
    	<link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    	<link href="<?=base_url()?>css/style.css" rel="stylesheet">
    	<link href="<?=base_url()?>css/perfect-scrollbar.min.css" rel="stylesheet">
    	<link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet">
    	
    	<script type="text/javascript" src="<?=base_url()?>js/jquery-2.1.3.min.js"></script>
    	<script type="text/javascript" src="<?=base_url()?>js/jquery.mask.js"></script>
    	<script type="text/javascript" src="<?=base_url()?>js/bootstrap.min.js"></script>
    	<script type="text/javascript" src="<?=base_url()?>js/script.js"></script>
    	<script type="text/javascript" src="<?=base_url()?>js/perfect-scrollbar.jquery.min.js"></script>
    	<script type="text/javascript">var base_url = '<?=base_url()?>';</script>
  	</head>
  	<body>

		<div id="item_menu_ativo" style="display: none;"><?=$menu_ativo?></div>
		<div id="roteiro_ativo" style="display: none;"><?=$this->session->userdata('usu_roteiro')?></div>

  		<div class="container-fluid" id="header">
  		
  		  	<div id="header_nav"> 
	  			<div class="navbar-header">
			    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menuNavegacao">
			        	<span class="glyphicon glyphicon-menu-hamburger" aria-hidden=""></span>
			      	</button>
			      	<a class="navbar-brand" href="<?=base_url()?>eva"><img src="<?=base_url()?>img/logo.png" width="50px"></a>
			    </div>
    			<div class="collapse navbar-collapse" id="menuNavegacao">
	    				
					<?php if($tipo_menu == 'start'): ?>
					<!-- start menu -->
		  				<?php if($this->session->userdata('usu_id')): ?>
									<ul class="nav navbar-nav menu-top navbar-right" role="navigation">
										<li role="navigation"><a href="<?=base_url()?>uploads/Tutorial-para-inscricao-FICA-2015.pdf" target="_blank" style="background-color: orange;color: white; font-weight: bold;">Tutorial FICA 2015</a></li>
										<li role="navigation" class="im_configuracao"><a href="<?=base_url()?>configuracao">&nbsp;<span class="glyphicon glyphicon-cog" aria-hidden=""></span>&nbsp;</a></li>
								  		<li role="navigation"><a href="<?=base_url()?>login/sair">Sair</a></li>
									</ul>
				   				</div>
			    			</div>
							<div class="sessao-logado">
			    				<div class="info_usuario">Acessando como: <strong><a href="<?=base_url()?>configuracao"><?=$this->session->userdata('usu_nome')?></a></strong></div>
			    				<?=isset($roteiro) ? '<span class="glyphicon glyphicon-leaf" aria-hidden="true" title="Roteiro"></span>' : ''?>
			    			</div>
			    			<h2><?=$titulo_pagina?></h2>
			    		<?php else: ?>
									<ul class="nav navbar-nav menu-top navbar-right" role="navigation">
								  		<li role="navigation" class="im_cadastro"><a href="<?=base_url()?>usuario">Cadastrar-se</a></li>
								  		<li role="navigation" class="im_login"><a href="<?=base_url()?>login">Entrar</a></li>
									</ul>
			    				</div>
			    			</div>
			    			<h2><?=$titulo_pagina?></h2>
			    		<?php endif; ?>
			    	<?php endif;?>
			    	
					<?php if($tipo_menu == 'mapeamento'): ?>
			    	<!-- mapeamento menu -->
		  				<?php if($this->session->userdata('usu_id')): ?>
			    					<ul class="nav navbar-nav menu-top">
								  		<!-- <li role="navigation" class="im_meuseventos"><a href="<?=base_url()?>evento/selecionar">Meus Eventos</a></li> -->
								  		<!-- <li role="navigation" class="im_meusobjetos"><a href="<?=base_url()?>mapeamento/show/<?=$this->session->userdata('usu_id')?>">Meus Objetos</a></li> -->
								  		<li role="navigation" class="im_objetospublicos"><a href="<?=base_url()?>mapeamento/show">Objetos Públicos</a></li>
									</ul>
									<ul class="nav navbar-nav menu-top navbar-right">
									<li role="navigation"><a href="<?=base_url()?>uploads/Tutorial-para-inscricao-FICA-2015.pdf" target="_blank" style="background-color: orange;color: white; font-weight: bold;">Tutorial FICA 2015</a></li>
										<li role="navigation" class="im_configuracao" title="Configurações"><a href="<?=base_url()?>configuracao">&nbsp;<span class="glyphicon glyphicon-cog" aria-hidden=""></span>&nbsp;</a></li>
								  		<li role="navigation"><a href="<?=base_url()?>login/sair">Sair</a></li>
									</ul>
			    				</div>
			    			</div>
			    			<div class="sessao-logado">
			    				<div class="info_usuario">Acessando como: <strong><a href="<?=base_url()?>configuracao"><?=$this->session->userdata('usu_nome')?></a></strong></div>
			    				<?=isset($roteiro) ? '<span class="glyphicon glyphicon-leaf" aria-hidden="true" title="Roteiro"></span>' : ''?>
			    			</div>
			    			<h2><?=$titulo_pagina?></h2>
			    		<?php else: ?>
			    					<ul class="nav navbar-nav menu-top">
								  		<li role="navigation" class="im_objetospublicos"><a href="<?=base_url()?>mapeamento/show">Objetos Públicos</a></li>
									</ul>
									<ul class="nav navbar-nav menu-top navbar-right">
								  		<li role="navigation" class="im_cadastro"><a href="<?=base_url()?>usuario">Cadastrar-se</a></li>
								  		<li role="navigation" class="im_login"><a href="<?=base_url()?>login">Entrar</a></li>
									</ul>
			    				</div>
			    			</div>
			    			<h2><?=$titulo_pagina?></h2>
			    		<?php endif; ?>
			    	<?php endif;?>
		
					<?php if($tipo_menu == 'evento'): ?>
			    	<!-- evento menu -->
		  				<?php if($this->session->userdata('usu_id')): ?>
			    					<ul class="nav navbar-nav menu-top">
								  		<li role="navigation" class="im_iniciacao"><a href="<?=base_url()?>iniciacao">Iniciação</a></li>
								  		<li role="navigation" class="im_planejamento"><a href="<?=base_url()?>planejamento">Planejamento</a></li>
								  		<li role="navigation" class="im_execucao"><a href="<?=base_url()?>execucao">Execução</a></li>
								  		<li role="navigation" class="im_encerramento"><a href="<?=base_url()?>encerramento">Encerramento</a></li>
									</ul>
									<ul class="nav navbar-nav menu-top navbar-right">
										<li role="navigation" class="im_home" title="Home"><a href="<?=base_url()?>evento/home">&nbsp;<span class="glyphicon glyphicon-star" aria-hidden=""></span>&nbsp;</a></li>
										<li role="navigation" class="im_reuniao" title="Reuniões"><a href="<?=base_url()?>evento/reuniao">&nbsp;<i class="fa fa-users"></i>&nbsp;</a></li>
										<li role="navigation" class="im_calendario" title="Calendário"><a href="<?=base_url()?>evento/calendario">&nbsp;<i class="fa fa-calendar"></i>&nbsp;</a></li>
										<li role="navigation" class="im_perfil" title="Perfil"><a href="<?=base_url()?>evento/perfil">&nbsp;<span class="glyphicon glyphicon-user" aria-hidden=""></span>&nbsp;</a></li>
										<li role="navigation" class="im_configuracao" title="Configurações"><a href="<?=base_url()?>configuracao">&nbsp;<span class="glyphicon glyphicon-cog" aria-hidden=""></span>&nbsp;</a></li>
								  		<li role="navigation"><a href="<?=base_url()?>login/sair">Sair</a></li>
									</ul>
			    				</div>
			    			</div>
							<div class="sessao-logado">
			    				<div class="info_usuario">Acessando como: <strong><a href="<?=base_url()?>configuracao"><?=$this->session->userdata('usu_nome')?></a></strong></div>
			    				<?=isset($roteiro) ? '<span class="glyphicon glyphicon-leaf" aria-hidden="true" title="Roteiro"></span>' : ''?>
			    			</div>
			    			<h2><?=$titulo_pagina?></h2>
			    		<?php else: ?>
			    		<?php endif; ?>
			    	<?php endif;?>

		</div>
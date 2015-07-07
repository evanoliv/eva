<?php if($tipo_menu_lateral == 'mapeamento'): ?>
	<!-- mapeamento menu -->
	<?php if($this->session->userdata('usu_id')): ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<li role="navigation" class="im_mapeamento"><a href="<?=base_url()?>mapeamento">Resumo</a></li>
	  		<li role="navigation" class="im_objeto"><a href="<?=base_url()?>objeto">Meus objetos culturais</a></li>
	  		<li role="navigation" class="im_inscricao"><a href="<?=base_url()?>usuario/inscricao">Minhas inscrições</a></li>
		</ul>
   	<?php else: ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<li role="navigation" class="im_mapeamento"><a href="<?=base_url()?>mapeamento">Resumo</a></li>
		</ul>
	<?php endif;?>
<?php endif; ?>

<?php if($tipo_menu_lateral == 'configuracao'): ?>
	<!-- configuração menu -->
	<ul class="nav nav-pills nav-stacked" role="navigation">
  		<li role="navigation" class="im_usuario"><a href="<?=base_url()?>configuracao/usuario">Dados de acesso</a></li>
  		<li role="navigation" class="im_responsavel"><a href="<?=base_url()?>configuracao/responsavel">Dados pessoais</a></li>
  		<li role="navigation" class="im_roteiro"><a href="<?=base_url()?>configuracao/roteiro">Roteiro</a></li>
	</ul>
<?php endif; ?>

<?php if($tipo_menu_lateral == 'evento'): ?>
	<!-- evento menu -->
	<?php if($this->session->userdata('usu_id')): ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<li role="navigation" class="im_novatarefa"><a href="<?=base_url()?>iniciacao/novoTarefa"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Nova tarefa</a></li>
	  		<li role="navigation" class="im_novanoticia"><a href="<?=base_url()?>evento/novoNoticia"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Nova notícia</a></li>
	  		<li role="navigation" class="im_shownoticias"><a href="<?=base_url()?>evento/showNoticias"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Todas as notícias</a></li>
	  		<li role="navigation" class="im_showatividades"><a href="<?=base_url()?>evento/showAtividades"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Todas as atividades</a></li>
		</ul>
   	<?php else: ?>
	<?php endif;?>
<?php endif; ?>

<?php if($tipo_menu_lateral == 'iniciacao'): ?>
	<!-- evento menu -->
	<?php if($this->session->userdata('usu_id')): ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<li role="navigation" class="im_definicao"><a href="<?=base_url()?>iniciacao/definicao"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Definições iniciais</a></li>
	  		<li role="navigation" class="im_local submenu"><a href="<?=base_url()?>iniciacao/local"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Locais do evento</a></li>
	  		<li role="navigation" class="im_equipe"><a href="<?=base_url()?>iniciacao/equipe"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Equipe</a></li>
	  		<li role="navigation" class="im_recurso"><a href="<?=base_url()?>iniciacao/recurso"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Recursos</a></li>
	  		<li role="navigation" class="im_divulgacao"><a href="<?=base_url()?>iniciacao/divulgacao"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Divulgação</a></li>
	  		<li role="navigation" class="im_cronograma"><a href="<?=base_url()?>iniciacao/cronograma"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Cronograma</a></li>
		</ul>
   	<?php else: ?>
	<?php endif;?>
<?php endif; ?>

<?php if($tipo_menu_lateral == 'planejamento'): ?>
	<!-- evento menu -->
	<?php if($this->session->userdata('usu_id')): ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<!-- <li role="navigation" class="im_equipe"><a href="<?=base_url()?>planejamento/equipe"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Equipe de produção</a></li>  -->
	  		<li role="navigation" class="im_atracao"><a href="<?=base_url()?>planejamento/atracao"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> Atrações selecionadas</a></li>
	  		<li role="navigation" class="im_inscrito submenu"><a href="<?=base_url()?>planejamento/buscarAtracao"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> Atrações inscritas</a></li>
	  		<li role="navigation" class="im_programacao"><a href="<?=base_url()?>planejamento/programacao"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> Programação</a></li>
	  		<!-- <li role="navigation" class="im_divulgacao"><a href="<?=base_url()?>planejamento/divulgacao"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Divulgação</a></li> -->
	  		<li role="navigation" class="im_suporte"><a href="<?=base_url()?>planejamento/suporte"><span class="glyphicon glyphicon-road" aria-hidden="true"></span> Suporte</a></li>
	  		<li role="navigation" class="im_infraestrutura"><a href="<?=base_url()?>planejamento/infraestrutura"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Infraestrutura</a></li>
	  		<!-- <li role="navigation" class="im_convite"><a href="<?=base_url()?>planejamento/convite"><span class="glyphicon glyphicon-road" aria-hidden="true"></span> Convites</a></li> -->
	  		<!-- <li role="navigation" class="im_montagem"><a href="<?=base_url()?>planejamento/montagem"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Montagem</a></li> -->
		</ul>
   	<?php else: ?>
	<?php endif;?>
<?php endif; ?>

<?php if($tipo_menu_lateral == 'execucao'): ?>
	<!-- evento menu -->
	<?php if($this->session->userdata('usu_id')): ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<li role="navigation" class="im_coordenacao"><a href="<?=base_url()?>execucao/coordenacao"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> Coordenadores</a></li>
	  		<li role="navigation" class="im_producao"><a href="<?=base_url()?>execucao/producao"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> Produtores</a></li>
		</ul>
   	<?php else: ?>
	<?php endif;?>
<?php endif; ?>

<?php if($tipo_menu_lateral == 'encerramento'): ?>
	<!-- evento menu -->
	<?php if($this->session->userdata('usu_id')): ?>
		<ul class="nav nav-pills nav-stacked" role="navigation">
	  		<li role="navigation" class="im_desproducao"><a href="<?=base_url()?>encerramento/desproducao">Desprodução</a></li>
	  		<li role="navigation" class="im_agradecimento"><a href="<?=base_url()?>encerramento/agradecimento">Agradecimentos</a></li>
	  		<li role="navigation" class="im_prestacao"><a href="<?=base_url()?>encerramento/prestacao">Prestação de contas</a></li>
	  		<li role="navigation" class="im_documentacao"><a href="<?=base_url()?>encerramento/documentacao">Documentação</a></li>
	  		<li role="navigation" class="im_catalogacao"><a href="<?=base_url()?>encerramento/catalogacao">Catalogação</a></li>
	  		<li role="navigation" class="im_clipping"><a href="<?=base_url()?>encerramento/clipping">Clipping</a></li>
	  		<li role="navigation" class="im_certificado"><a href="<?=base_url()?>encerramento/certificado">Certificados</a></li>
	  		<li role="navigation" class="im_questionario"><a href="<?=base_url()?>encerramento/questionario">Questionário de avaliação</a></li>
	  		<li role="navigation" class="im_relatorio"><a href="<?=base_url()?>encerramento/relatorio">Relatório final</a></li>
	  		<li role="navigation" class="im_resultado"><a href="<?=base_url()?>encerramento/resultado">Divulgação dos resultados</a></li>
		</ul>
   	<?php else: ?>
	<?php endif;?>
<?php endif; ?>
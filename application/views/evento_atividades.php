<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<div class="filtro">
				<div class="filtroHeader">
					<div class="filtroTitulo">Busca por: <strong><?=!empty($filtro) ? $filtro : ''?></strong></div>
					<div class="filtroContagem">Atividades encontradas: <strong><?=$atividadesEncontradas?></strong></div>
				</div>
				<form action="<?=base_url()?>evento/filtrarAtividades" method="get" id="atividadeFiltroFrom">
					Data: <input class="formP" type="date" name="atividade[data]" style="height: 26px">
					Palavra-chave: <input class="formP" type="text" name="atividade[usuario]" maxlength="255">
					Palavra-chave: <input class="formP" type="text" name="atividade[tarefa]" maxlength="255"><p><p>
					Situação:
					<select class="formP" name="atividade[situacao]" id="tipo_objeto">
						<option value=""></option>
						<option value="Aberta">Aberta</option>
						<option value="Executando">Executando</option>
						<option value="Concluída">Concluída</option>
						<option value="Aprovada">Aprovada</option>
					</select>
					Prioridade:
					<select class="formP" name="atividade[prioridade]">
						<option value=""></option>
						<option value="Baixa" >Baixa</option>
						<option value="Normal">Normal</option>
						<option value="Alta">Alta</option>
						<option value="Urgente">Urgente</option>
					</select>
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			
			<legend>Atividades</legend>
			
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<tbody>
					<?php if(!empty($atividades)):?>
						<?php foreach($atividades as $atividade):?>
							<tr><td>
								<?=format_data($atividade->ati_criado_em)?> :: <?=str_replace('base_url', base_url(), $atividade->ati_descricao)?><br>
							</td></tr>
						<?php endforeach;?>
					<?php else:?>
						<tr><td>Nenhuma atividade recente</td></tr>
					<?php endif;?>		
				</tbody>
			</table>
			<?=$this->pagination->create_links()?>
			<br><br>
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>
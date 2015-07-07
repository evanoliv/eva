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
					<div class="filtroContagem">Equipamentos encontrados: <strong><?=$objetosEncontrados?></strong></div>
				</div>
				<form action="<?=base_url()?>iniciacao/filtrarLocal" method="get" id="localFiltroFrom">
					Nome: <input class="formP" type="text" name="equipamento[nome]" maxlength="255">
					Cidade: <input class="formP" type="text" name="equipamento[cidade]" maxlength="255">
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>

			<?=imprimeMsg()?>

			<legend>Selecione o local</legend>

			<form action="<?=base_url()?>iniciacao/cadastrarLocal" method="post" id="localForm">
				
				<input value="<?=(!empty($local->loc_id)) ? $local->loc_id : "" ?>" class="registroId" type="hidden" name="local[id]">
			
				<div class="form-group">
					<label>Local *</label>
					<select class="formG form-control" name="local[equipamento]" required>
						<option value="">Selecione...</option>
						<?php foreach ($equipamentos as $equipamento):?>
							<option value="<?=$equipamento->equ_id?>" <?=(!empty($local)) ? ($local->loc_equ_id == $equipamento->equ_id) ? 'selected' : '' : ''?>><?=$equipamento->obj_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<span id="helpBlock" class="help-block">São listados os seus Equipamentos e os Equipamentos Públicos</span>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
					
			</form>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
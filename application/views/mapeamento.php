<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<div class="resumo_mapeamento">
				Quantidade de objetos cadastrados no sistema: <br>
				<br>
				Eventos: <?=$eventos?><br>
				Produtos: <?=$produtos?><br>
				Equipamentos: <?=$equipamentos?>
				<br><br>
				Total: <?=$total?>
			</div>
				
			<?php if($this->session->userdata('usu_id')):?>
				<div class="resumo_mapeamento">
					Meus objetos cadastrados no sistema: <br>
					<br>
					Eventos: <?=$meus_eventos?><br>
					Produtos: <?=$meus_produtos?><br>
					Equipamentos: <?=$meus_equipamentos?>
					<br><br>
					Total: <?=$meus_total?>
				</div>
			<?php endif;?>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
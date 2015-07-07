<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Orçamento</legend>
			Orçamento do evento: R$ <?=number_format($evento->eve_orcamento,2,',','.')?><br>
			<br>
			Custos de Pré-produção: R$ <?=number_format($custoPreProducao->cus_valor,2,',','.')?><br>
			Custos de Produção: R$ <?=number_format($custoProducao->cus_valor,2,',','.')?><br>
			Custos de Divulgação: R$ <?=number_format($custoDivulgacao->div_valor,2,',','.')?><br>
			Cachês: R$ <?=number_format($custoCache->atr_custo,2,',','.')?><br>
			Recolhimento: R$ <?=number_format($custoRecolhimento->cus_valor,2,',','.')?><br>
			<br>
			Balanço: R$ <?=number_format($evento->eve_orcamento - $custoPreProducao->cus_valor - $custoProducao->cus_valor - $custoDivulgacao->div_valor - $custoCache->atr_custo - $custoRecolhimento->cus_valor,2,',','.')?>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>
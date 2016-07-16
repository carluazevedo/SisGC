<?php $this->load->view('templates/navbar'); ?>
<section>
	<h1><?php echo $titulo_pagina; ?></h1>
	<div class="table-responsive">
		<table class="table table-condensed table-hover"><!-- table-bordered -->
			<tr>
				<th>NÚMERO DT</th>
				<th>DATA ENTRADA</th>
				<th>USUÁRIO ENTRADA</th>
				<th>DATA SAÍDA</th>
				<th>USUÁRIO SAÍDA</th>
			</tr>
			<?php foreach ($viagens as $col) :
					$entrada_data = date_format(date_create($col->entrada_data), 'd/m/Y H:i:s');

					if ($col->saida_data == 0) :
						$saida_data = '-';
					else :
						$saida_data = date_format(date_create($col->saida_data), 'd/m/Y H:i:s');
					endif; ?>
			<tr>
				<td><?php echo $col->dt_num; ?></td>
				<td><?php echo $entrada_data; ?></td>
				<td><?php echo $col->entrada_usuario; ?></td>
				<td><?php echo $saida_data; ?></td>
				<td><?php echo $col->saida_usuario; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</section>
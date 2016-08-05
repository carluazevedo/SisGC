<p>Número DT: <?php echo $registros->dt_num; ?></p>
<p>Status da viagem: <?php echo $this->viagens_model->status_viagem_pn($registros->status_viagem, 'texto'); ?></p>
<p>Data de entrada: <?php echo $registros->entrada_data; ?></p>
<p>Data de saída: <?php echo $registros->saida_data; ?></p>
<p>Carga de alto risco: <?php echo $registros->carga_risco; ?></p>
<p>Carga escoltada: <?php echo $registros->carga_escolta; ?></p>
<p>Nome do motorista: <?php echo $registros->motorista_nome; ?></p>
<p>CPF do motorista: <?php echo $registros->motorista_cpf; ?></p>
<p>Placa do trator: <?php echo $registros->placa_trator; ?></p>
<p>Placa do reboque 1: <?php echo $registros->placa_reboque_1; ?></p>
<p>Placa do reboque 2: <?php echo $registros->placa_reboque_2; ?></p>
<p>Transportadora: <?php echo $registros->transp_nome; ?></p>
<p>Origem: <?php echo $registros->operacao_nome; ?></p>
<p>Valor total: <?php echo $registros->valor; ?></p>
<p>Peso total: <?php echo $registros->peso; ?></p>
<p>Notas fiscais: <?php echo $registros->notas_fiscais; ?></p>
<p>Tipo de entrega: <?php echo $registros->entrega_tipo; ?></p>
<p>Tipo de mercadoria: <?php echo $registros->mercadoria_tipo; ?></p>
<p>Destinatário: <?php echo $registros->destinatario_nome; ?></p>
<p>CNPJ: <?php echo $registros->destinatario_cnpj; ?></p>
<p>Rota: <?php echo $registros->rota; ?></p>
<p>Observações: <?php echo $registros->observacoes; ?></p>
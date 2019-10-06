<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header"><strong><i class="fa fa-list-alt"></i> Visualizar Bem</strong></div>
			<div class="card-body card-block">

				<?php 
				if (isset($_GET['idbem']) && $idbem = trim($_GET['idbem'])) {
					include_once 'model/bem.php';
					$operacao = isset($_GET['operacao']) && trim($_GET['operacao']) ? trim($_GET['operacao']) : null;
					if ($operacao == 1) {
						$bem = consultarBensCompra($idbem);
					} elseif ($operacao == 2) {
						$bem = consultarBensTrans($idbem);
					} elseif ($operacao == 3) {
						$bem = consultarBensDoacao($idbem);
					}
					
					$bem = mysqli_fetch_assoc($bem);
				}
				
				?>


				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Código de classificação</label>
							<p><?php echo $bem['nr_titulo'] . ' - ' . $bem['codclass_titulo']  ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Classificação</label>
							<p><?php echo $bem['nr_subtitulo'] . ' - ' . $bem['codclass_subtitulo']  ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">N° de Inventário</label>
							<p><?php echo $bem['nr_inventario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Identificação</label>
							<p><?php echo $bem['identificacao'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Operação</label>
							<p><?php echo $bem['nome_operacao'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Situação</label>
							<p><?php echo $bem['nome_situacao'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Conservação</label>
							<p><?php echo $bem['conservacao'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Quantidade</label>
							<p><?php echo $bem['qtde'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Histórico da Bem</label>
							<p><?php echo $bem['hist_bem'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Histórico da Operação</label>
							<p><?php echo $bem['hist_operacao'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Observação</label>
							<p><?php echo $bem['observacao'] ?></p>
						</div>
					</div>
					
					<?php if ($operacao == 1): ?>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Valor</label>
								<p><?php echo $bem['valor_ent'] ?></p>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Documento Hábil</label>
								<p><?php echo $bem['nr_rec'] ?></p>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Data Recibo</label>
								<p><?php echo date('d/m/Y',strtotime($bem['dt_rec'])) ?></p>
							</div>
						</div>
						
					<?php endif ?>

					<?php if ($operacao == 2 or $operacao == 3): ?>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Nome Instituição</label>
								<p><?php echo $bem['nome_instituicao'] ?></p>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Telefone Instituição</label>
								<p><?php echo $bem['tel_instituicao'] ?></p>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">CNPJ Instituição</label>
								<p><?php echo $bem['cnpj_instituicao'] ?></p>
							</div>
						</div>
						
					<?php endif ?>

					<?php if ($operacao == 2): ?>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Data Transferência</label>
								<p><?php echo date('d/m/Y',strtotime($bem['dt_ent_trans'])) ?></p>
							</div>
						</div>
						
					<?php endif ?>

					<?php if ($operacao == 3): ?>

						<div class="col-md-4">
							<div class="form-group">
								<label for="">Data Doação</label>
								<p><?php echo date('d/m/Y',strtotime($bem['dt_entdoacao'])) ?></p>
							</div>
						</div>
						
					<?php endif ?>
					
					<div class="card-body">
						<a href="?pagina=listar-bens" class="btn btn-danger" >Voltar</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>



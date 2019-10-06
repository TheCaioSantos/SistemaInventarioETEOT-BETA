

<form action="controller/baixa.php" method="POST">
	<div class="row">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-level-down"></i> Processo de Baixa</strong></div>
				<div class="card-body card-block">

					<ul> 
						<?php
						if (count($_GET) > 1) {
							unset($_GET['pagina']);
							foreach ($_GET as $i => $campo) {
								if ($campo == 'nome') {
									echo '<li>O PRIMEIRO NOME deve ser preenchido.</li>';
								} elseif ($campo == 'sobrenome') {
									echo '<li>O SOBRENOME deve ser preenchido.</li>';
								} elseif ($campo == 'email') {
									echo '<li>O EMAIL deve ser preenchido.</li>';
								} elseif ($campo == 'emailinvalido') {
									echo '<li>EMAIL inválido.</li>';
								} 
								
							}
						}
						?>
					</ul>

					<div class="row">

						<div class="col-md-3">
							<div class="form-group">
								<label for="nr_processo">Número de Processo<span class="text-danger">*</span></label>
								<input name="nr_processo" type="text" class="form-control">
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="data-processo">Data do Processo<span class="text-danger">*</span></label>
								<input name="data-processo" type="date" class="form-control">
							</div>
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label for="bem">Bem<span class="text-danger"></span></label>

								<select name="bem" data-placeholder="Escolha o Bem..." class="standardSelect">
									<option value="" label="default"></option>
									<?php 
									include_once 'model/processo-baixa.php';

									$bens = consultarBensAtivo();
									?>
									<?php while ($bem = mysqli_fetch_assoc($bens)) : ?>
										<option value="<?php echo $bem['idbem']; ?>"><?php echo $bem['nr_inventario'].' - '.$bem['identificacao']; ?></option>
									<?php endwhile; ?>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="motivo">Motivo<span class="text-danger">*</span></label>
								<textarea name="motivo" rows="3" class="form-control"></textarea>
							</div>
						</div>

						

						
						
						<div class="col-md-1">
							<div class="form-group">
								<label for=""></label>
								<button type="submit" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Incluir</button>
							</div>
							
						</div>


					</div>

					<!-- Mensagem de cadastrado com sucesso -->
					<?php 
					if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso'):
						?>
						<div class="d-flex justify-content-around">
							<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
								<span class="badge badge-pill badge-success">Sucesso</span>
								Usuário cadastrado com sucesso.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<?php 
					endif ?>

					<!-- Mensagem de erro ao cadastrado  -->
					<?php 
					if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'erro'):
						?>

						<div class="d-flex justify-content-around">
							<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
								<span class="badge badge-pill badge-danger">Erro</span>
								Erro ao tentar Cadastrar.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<?php 
					endif ?>

					<!-- 	Mensagem de usuário já escolhido -->
					<?php 
					if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'emailerro'):
						?>

						<div class="d-flex justify-content-around">
							<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
								<span class="badge badge-pill badge-danger">Erro</span>
								O E-mail escolhido já foi cadastrado.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<?php 
					endif ?>

					<?php 
					if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'cpferro'):
						?>

						<div class="d-flex justify-content-around">
							<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
								<span class="badge badge-pill badge-danger">Erro</span>
								O CPF escolhido já foi cadastrado.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<?php 
					endif ?>
				</div>
			</div>
		</div>

	</div>
</form>



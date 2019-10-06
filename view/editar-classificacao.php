
<form action="controller/classificacao.php<?php echo isset($_GET['idcod_class']) ? '?idcod_class=' . $_GET['idcod_class'] : '' ?>" method="POST">
	<div class="row">


		

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-list-alt"></i> Editar Classificação</strong></div>
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
								} elseif ($campo == 'senha') {
									echo '<li>A SENHA deve ser preenchida.</li>';
								} elseif ($campo == 'senhainvalida') {
									echo '<li>A SENHA deve ter no minimo 8 caracteres.</li>';
								} 
								
							}
						}
						?>
					</ul>

					<?php 
					if (isset($_GET['idcod_class']) && $idcod_class = trim($_GET['idcod_class'])) {
						include_once 'model/classificacao.php';
						$classificacao = consultarClassificacao($idcod_class);
						$classificacao = mysqli_fetch_assoc($classificacao);
					}
					
					?>


					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="nr-titulo">Número de Título</label>
								<input name="nr-titulo" type="text" class="form-control" value="<?php echo $classificacao['nr_titulo'] ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="titulo-class">Titulo da Classificacao</label>
								<input name="titulo-class" type="text" class="form-control" value="<?php echo $classificacao['codclass_titulo'] ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="nr-sub">Número de Subtítulo</label>
								<input name="nr-sub" type="text" class="form-control" value="<?php echo $classificacao['nr_subtitulo'] ?>">
							</div>
						</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="subtitulo-class">Subtítulo da Classificacao</label>
									<input name="subtitulo-class" type="text" class="form-control" value="<?php echo $classificacao['codclass_subtitulo'] ?>">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="valor-depreciacao">Valor Depreciação</label>
									<input name="valor-depreciacao" type="text" class="form-control" value="<?php echo $classificacao['valor_depre'] ?>">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="data-depreciacao">Data Depreciação<span class="text-danger"></span></label>
									<input name="data-depreciacao" type="date" class="form-control" value="<?php echo $classificacao['dt_inicio'] ?>">
								</div>
							</div>

							
							<div class="card-body">
								<button type="submit" class="btn btn-success" role="button">Atualizar</button>
								<a href="?pagina=lista-classificacao" class="btn btn-danger" >Cancelar</a>
							</div>



						</div>

						
						<!-- Mensagem de cadastrado com sucesso -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'sucesso'):
							?>
							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-success">Sucesso</span>
									Usuário Atualizado com sucesso.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<?php 
						endif ?>

						<!-- Mensagem de erro ao cadastrado  -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'erro'):
							?>

							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-danger">Erro</span>
									Erro ao tentar Atualizar Usuário.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<?php 
						endif ?>


						<!-- 	Mensagem de usuário já escolhido -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'emailerro'):
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
						if (isset($_GET['update']) && $_GET['update'] == 'cpferro'):
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

	

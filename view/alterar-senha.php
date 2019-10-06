

<form action="controller/alterar-senha.php<?php echo '?idusuario=' . $_SESSION['idusuario'] ?>" method="POST">
	<div class="row">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-user"></i> Meu Perfil</strong></div>
				<div class="card-body card-block">


					<ul> 
						<?php
						if (count($_GET) > 1) {
							unset($_GET['pagina']);
							foreach ($_GET as $i => $campo) {
								if ($campo == 'senha') {
									echo '<li>A SENHA deve ser preenchida.</li>';
								} elseif ($campo == 'senhainvalida') {
									echo '<li>A SENHA deve ter no minimo 8 caracteres.</li>';
								}
								
							}
						}
						?>
					</ul>

					<?php 
					include_once 'model/alterar-senha.php';
					$usuario = consultarPerfil($_SESSION['idusuario']);
					$usuario = mysqli_fetch_assoc($usuario);
					?>


					<div class="row">
						

						<div class="col-md-12">
							<div class="form-group">
                                <p class="text-danger text-center">Depois de alterar a senha, você será desconectado, e será redirecionado para página de login.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">

                                <label for="disabledSelect">Senha Atual Criptografada</label>
                                <input type="text" id="disabled-input" name="disabled-input" disabled="" class="form-control" value="<?php echo $usuario['senha'] ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="senha">Nova Senha</label>
								<input name="senha" type="password" class="form-control" placeholder="Minimo 8 caracteres">
							</div>
						</div>

						<div class="card-body">
							<button type="button" class="btn btn-success " data-toggle="modal" data-target="#staticModal">Atualizar</button>
							<a href="painel.php?pagina=perfil" class="btn btn-danger">Cancelar</a>

							
						</div>


						<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticModalLabel">Alterar Senha</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<p>
											Tem certeza que quer alterar a senha?
										</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success">Confirmar</button>
									</div>
								</div>
							</div>
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

				</div>
			</div>
		</div>

	</div>
</form>



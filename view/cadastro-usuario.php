

<form action="controller/usuario.php" method="POST">
	<div class="row">


		

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-list-alt"></i> Cadastrar Usuário</strong></div>
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
								} elseif ($campo == 'nivel') {
									echo '<li>O NÍVEL deve ser preenchido.</li>';
								} elseif ($campo == 'nivelinvalido') {
									echo '<li>NÍVEL inválido.</li>';
								} elseif ($campo == 'telefone') {
									echo '<li>O TELEFONE deve ser preenchido.</li>';
								} elseif ($campo == 'telefoneinvalido') {
									echo '<li>TELEFONE inválido.</li>';
								} elseif ($campo == 'celular') {
									echo '<li>O CELULAR deve ser preenchido.</li>';
								} elseif ($campo == 'celularinvalido') {
									echo '<li>CELULAR inválido.</li>';
								} elseif ($campo == 'cpf') {
									echo '<li>O CPF deve ser preenchido.</li>';
								} elseif ($campo == 'cpfinvalido') {
									echo '<li>NÚMERO DE CPF INVÁLIDO.</li>';
								}
								
							}
						}
						?>
					</ul>


					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="nome">Nome<span class="text-danger">*</span></label>
								<input name="nome" type="text" class="form-control" placeholder="Ex.: João">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="sobrenome">Sobrenome<span class="text-danger">*</span></label>
								<input name="sobrenome" type="text" class="form-control" placeholder="Ex.: da Silva">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="email">E-mail<span class="text-danger">*</span></label>
								<input name="email" type="email" class="form-control" placeholder="Ex.: exemplo@gmail.com">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="senha">Senha<span class="text-danger">*</span></label>
								<input name="senha" type="password" class="form-control" placeholder="Minimo 8 caracteres">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="nivel">Nível de Acesso<span class="text-danger">*</span></label>
								<select name="nivel" class="form-control">
									<option></option>
									<option value="1">Administrador</option>
									<option value="2">Funcionário</option>
									<option value="3">Visitante</option>

								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="telefone">Telefone<span class="text-danger">*</span></label>
								<input name="telefone" type="text" class="form-control" placeholder="Ex.: 2133445577">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="celular">Celular<span class="text-danger">*</span></label>
								<input name="celular" type="text" class="form-control" placeholder="Ex.: 21999888777">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="cpf">CPF<span class="text-danger">*</span></label>
								<input name="cpf" type="text" class="form-control" placeholder="Ex.: 14687114634">
							</div>
						</div>

						
						<div class="card-body">
							<button type="submit" class="btn btn-primary" role="button">Cadastrar</button>
							<a href="?pagina=lista-usuarios" class="btn btn-danger" >Cancelar</a>
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



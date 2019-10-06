<div class="row ">

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong class="card-title"><i class="fa fa-clipboard"></i> Setores</strong>
			</div>

			<?php 
			include_once 'model/setor.php';

			$registros_por_pagina = 10;
			$pagina = isset($_GET['page']) && trim($_GET['page']) ? (int)$_GET['page'] : 1;
			$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;

			if (isset($_POST['categoria']) && $_POST['categoria'] != '') {
				$setores = filtroCategoriasetor($_POST['categoria']);
			} else{
				$setores = consultarSetor(null, $inicio, $registros_por_pagina);
			}

			$total = listarSetor();
        	$num_total = mysqli_num_rows($total);
        	$num_paginas = ceil($num_total / $registros_por_pagina);

			?>



			<div class="card-body">
				<div class="row">
					<div class="col-md-3 form-filtro">
						<form action="?pagina=lista-setores" method="POST">
							<div class=" form-group">
								<label for="categoria"><strong>Filtrar por Categoria</strong></label>
								<div class="input-group">
									<select name="categoria" class="form-control">
										<option value=""></option>
										<option value="Administrativo">Administrativo</option>
										<option value="Diversos">Diversos</option>
										<option value="Labóratório de Análises Clínicas">Labóratório de Análises Clínicas</option>
										<option value="Laboratório de Informática">Laboratório de Informática</option>
										<option value="Salas de Aula">Salas de Aulas</option>
									</select>
									<div class="input-group-btn"><button class="btn badge-success">Filtrar</button></div>
								</div>
							</div>
						</form>
					</div>
				</div>

				


				<div class="table-responsive-sm">
					<table class="table table-sm table-hover table-striped estilo-tabela">
						<thead >
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Categoria</th>
								<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
									<th scope="col">Ações</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
							
							<!-- Exibindo usuários cadastrados -->
							<?php if (mysqli_num_rows($setores) > 0): ?>
								<?php while($setor = mysqli_fetch_assoc($setores)): ?>
									<tr>
										<td><?php echo $setor['nome_setor']; ?></td>
										<td><?php echo $setor['categoria_setor']; ?></td>
										<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
											<td>
												<a href="painel.php?pagina=editar-setor&idsetor=<?php echo $setor['idsetor']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
											</td>
										<?php endif; ?>
									</tr>
								<?php endwhile; ?>
								<?php else: ?>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>

						<?php if (empty($_POST['categoria'])) :?>

							<nav aria-label="...">
								<ul class="pagination justify-content-center">
									<?php for ($i = 1; $i <= $num_paginas; $i++) : ?>
										<li class="page-item"><a class="page-link" href="?pagina=lista-setores&page=<?php echo $i ?>"><?php echo $i ?></a></li>
									<?php endfor; ?>
								</ul>
							</nav>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>





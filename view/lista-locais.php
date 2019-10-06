<div class="row ">

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong class="card-title"><i class="fa fa-map-marker"></i> Locais</strong>
			</div>

			<?php
			include_once 'model/local.php';

			$registros_por_pagina = 10;
			$pagina = isset($_GET['page']) && trim($_GET['page']) ? (int) $_GET['page'] : 1;
			$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;

			if (isset($_POST['setor']) && $_POST['setor'] != '') {
				$locais = filtroSetorLocal($_POST['setor']);
			} elseif (isset($_POST['inventario']) && $_POST['inventario'] != '') {
				$locais = filtroInventarioLocal($_POST['inventario']);
			} else {
				$locais = consultarLocal(null, $inicio, $registros_por_pagina);
			}

			$total = listarLocal();
			$num_total = mysqli_num_rows($total);
			$num_paginas = ceil($num_total / $registros_por_pagina);
			?>



			<div class="card-body">


				<div class="row">
					<div class="col-md-3 form-filtro">
						<form action="?pagina=lista-locais" method="POST">
							<div class=" form-group">
								<label for="setor"><strong>Filtrar por Setor</strong></label>
								<div class="input-group">
									<select name="setor" class="form-control">
										<option value=""></option>
										<?php
										include_once 'model/local.php';

										$setores = consultarSetoresLocal();
										?>

										<?php while ($setor = mysqli_fetch_assoc($setores)) : ?>
											<option value="<?php echo $setor['idsetor']; ?>"><?php echo $setor['nome_setor'] ?></option>
										<?php endwhile; ?>
									</select>
									<div class="input-group-btn"><button class="btn badge-success">Filtrar</button></div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-md-3 form-filtro">
						<form action="?pagina=lista-locais" method="POST">
							<div class=" form-group">
								<label for="inventario"><strong>Filtrar por N° Inven.</strong></label>
								<div class="input-group">
									<input type="text" name="inventario" class="form-control">
									<div class="input-group-btn"><button class="btn badge-success">Filtrar</button></div>
								</div>
							</div>
						</form>
					</div>
				</div>




				<div class="table-responsive-sm">
					<table class="table table-sm table-hover table-striped estilo-tabela">
						<thead>
							<tr>
								<th scope="col">N° Inven.</th>
								<th scope="col">Bem</th>
								<th scope="col">Setor</th>
								<th scope="col">Status</th>
								<th scope="col">Data Inicial</th>
								<th scope="col">Data Final</th>
								<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
									<th scope="col">Ações</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>

							<?php if (mysqli_num_rows($locais) > 0) : ?>
								<?php while ($local = mysqli_fetch_assoc($locais)) : ?>
									<tr>
										<td><?php echo $local['nr_inventario']; ?></td>
										<td><?php echo $local['identificacao']; ?></td>
										<td><?php echo $local['nome_setor']; ?></td>
										<td>
											<?php if ($local['status_local'] == 0) : ?>
												<span class="badge badge-danger">Off</span>
											<?php elseif ($local['status_local'] == 1) : ?>
												<span class="badge badge-success">On</span>

											<?php endif ?>
										</td>
										<td><?php echo $local['dt_inicio']; ?></td>
										<td><?php echo $local['dt_fim']; ?></td>
										<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
											<td>
												<a href="painel.php?pagina=editar-local&idlocal=<?php echo $local['idlocal']; ?>" class="btn btn-success btn-sm"><i class="fa fa-exchange"></i> Transferir</a>
											</td>
										<?php endif; ?>
									</tr>
								<?php endwhile; ?>
							<?php else : ?>
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

					<?php if (isset($_POST['setor']) && $_POST['setor'] != '') : ?>
						<form action="controller/rel-local.php" method="POST" target="blank">
							<input type="hidden" name="setorr" value="<?php echo $_POST['setor'] ?>">
							<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>&nbsp; Imprimir</button>
						</form>
					<?php endif; ?>


					<?php if (empty($_POST['setor']) && empty($_POST['inventario'])) : ?>

						<nav aria-label="...">
							<ul class="pagination justify-content-center">
								<?php for ($i = 1; $i <= $num_paginas; $i++) : ?>
									<li class="page-item"><a class="page-link" href="?pagina=lista-locais&page=<?php echo $i ?>"><?php echo $i ?></a></li>
								<?php endfor; ?>
							</ul>
						</nav>

					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row ">

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title"><i class="fa fa-asterisk"></i> Classificações</strong>
		</div>

		<?php 
		include_once 'model/classificacao.php';

		$registros_por_pagina = 15;
		$pagina = isset($_GET['page']) && trim($_GET['page']) ? (int)$_GET['page'] : 1;
		$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;

		if (isset($_POST['titulo']) && $_POST['titulo'] != '') {
			$classificacoes = filtroTituloBem($_POST['titulo']);
		} else{
			$classificacoes = consultarClassificacao(null, $inicio, $registros_por_pagina);
		}

		$total = listarClassificacao();
		$num_total = mysqli_num_rows($total);
		$num_paginas = ceil($num_total / $registros_por_pagina);
		?>



		<div class="card-body">
			<div class="row">
				
				<div class="col-md-3 form-filtro">
					<form action="?pagina=lista-classificacao" method="POST">
						<div class=" form-group">
							<label for="titulo"><strong>Filtrar por Título</strong></label>
							<div class="input-group">
								<input type="text" name="titulo" class="form-control">
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
						<th scope="col">N° Título</th>
						<th scope="col">Título</th>
						<th scope="col">N° Subtítulo</th>
						<th scope="col">Subtítulo</th>
						<th scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>
					
					<!-- Exibindo usuários cadastrados -->
					<?php if (mysqli_num_rows($classificacoes) > 0): ?>
						<?php while($classificacao = mysqli_fetch_assoc($classificacoes)): ?>
							<tr>
								<td><?php echo $classificacao['nr_titulo']; ?></td>
								<td><?php echo substr($classificacao['codclass_titulo'], 0, 50); ?></td>
								<td><?php echo $classificacao['nr_subtitulo']; ?></td>
								<td><?php echo substr($classificacao['codclass_subtitulo'], 0, 50); ?></td>
								<td>
									<a href="painel.php?pagina=visualizar-classificacao&idcod_class=<?php echo $classificacao['idcod_class']; ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Detalhes</a>
									<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
										<a href="painel.php?pagina=editar-classificacao&idcod_class=<?php echo $classificacao['idcod_class']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endwhile; ?>
						<?php else: ?>
							<tr>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			<?php if (empty($_POST['titulo'])) :?>

				<nav aria-label="...">
					<ul class="pagination justify-content-center">
						<?php for ($i = 1; $i <= $num_paginas; $i++) : ?>
							<li class="page-item"><a class="page-link" href="?pagina=lista-classificacao&page=<?php echo $i ?>"><?php echo $i ?></a></li>
						<?php endfor; ?>
					</ul>
				</nav>

			<?php endif; ?>
			</div>
			</div>
		</div>
	</div>
</div>





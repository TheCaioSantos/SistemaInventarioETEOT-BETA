

<div class="row ">

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong class="card-title"><i class="fa fa-users"></i> Usuários</strong>
			</div>

			<?php 
			include_once 'model/usuario.php';
			$registros_por_pagina = 10;
			$pagina = isset($_GET['page']) && trim($_GET['page']) ? (int)$_GET['page'] : 1;

			$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;

			$usuarios = consultarUsuario(null, $inicio, $registros_por_pagina);

			$total = listarUsuario();
			$num_total = mysqli_num_rows($total);
			$num_paginas = ceil($num_total / $registros_por_pagina);
			
			?>



			<div class="card-body">
				<div class="table-responsive-sm">
				<table class="table table-sm table-hover table-striped estilo-tabela">
					<thead >
						<tr>
							<th scope="col">Nome</th>
							<th scope="col">Sobrenome</th>
							<th scope="col">Nível de Acesso</th>
							<th scope="col">Status</th>
							<?php if ($_SESSION['nivel'] == 1) : ?>
								<th scope="col">Email</th>
								<th scope="col">Ações</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						
						<!-- Exibindo usuários cadastrados -->
						<?php if (mysqli_num_rows($usuarios) > 0): ?>
							<?php while($usuario = mysqli_fetch_assoc($usuarios)): ?>
								<tr>
									<td><?php echo $usuario['nome_usuario']; ?></td>
									<td><?php echo $usuario['sobrenome']; ?></td>
									<td><?php echo $usuario['nome_nivel']; ?></td>

									<td>
										 <?php if ($usuario['status_usuario'] == 0): ?>
                                            <span class="badge badge-danger">Bloqueado</span>
                                        <?php elseif ($usuario['status_usuario'] == 1): ?>
                                            <span class="badge badge-success">Ativo</span>
                                        <?php endif ?>
									</td>

									<?php if ($_SESSION['nivel'] == 1) : ?>
										<td><?php echo $usuario['email']; ?></td>
										<td>
											<a href="painel.php?pagina=visualizar-usuario&idusuario=<?php echo $usuario['idusuario']; ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Detalhes</a>
											<a href="painel.php?pagina=editar-usuario&idusuario=<?php echo $usuario['idusuario']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>

											<?php if ($usuario['status_usuario'] == 1): ?>
												<a href="controller/usuario.php?status=0&idusuario=<?php echo $usuario['idusuario']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-unlock-alt"></i> Bloquear</a>
											<?php elseif ($usuario['status_usuario'] == 0): ?>
												<a href="controller/usuario.php?status=1&idusuario=<?php echo $usuario['idusuario']; ?>" class="btn btn-success btn-sm"><i class="fa fa-unlock"></i> Desbloquear</a>
											<?php endif ?>
											
											<!-- ver video do freitas https://www.youtube.com/watch?v=naKaSn__anE -->
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
					
					<nav aria-label="...">
						<ul class="pagination justify-content-center">
							<?php for ($i = 1; $i <= $num_paginas; $i++) : ?>
							<li class="page-item"><a class="page-link" href="?pagina=lista-usuarios&page=<?php echo $i ?>"><?php echo $i ?></a></li>
							<?php endfor; ?>
						</ul>
					</nav>
					
				</div>
				</div>
			</div>
		</div>
	</div>





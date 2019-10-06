<?php 
include_once 'model/bem.php';
        //Chamando função de consulta
$situacao = consultarBensSituacao();

?>

<div class="row">


	<div class="col-lg-3 col-md-6">
        <a href="painel.php?pagina=listar-bens">
		<div class="card">
			<div class="card-body">
				<div class="stat-widget-five">
					<div class="stat-icon dib flat-color-2">
						<i class="fa fa-folder-open"></i>
					</div>
					<div class="stat-content">
						<div class="text-left dib">
							<div class="stat-text"><span class="count"><?php echo $situacao[0] ?></span></div>
							<div class="stat-heading">Cadastrados</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        </a>
	</div>
	<div class="col-lg-3 col-md-6">
        <a href="painel.php?pagina=ativos">
		<div class="card">
			<div class="card-body">
				<div class="stat-widget-five">
					<div class="stat-icon dib flat-color-1">
						<i class="fa fa-folder-open"></i>
					</div>
					<div class="stat-content">
						<div class="text-left dib">
							<div class="stat-text"><span class="count"><?php echo $situacao[1] ?></span></div>
							<div class="stat-heading">Ativo</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        </a>
	</div>
	<div class="col-lg-3 col-md-6">
        <a href="painel.php?pagina=processo-baixa">
		<div class="card">
			<div class="card-body">
				<div class="stat-widget-five">
					<div class="stat-icon dib flat-color-3">
						<i class="fa fa-folder-open"></i>
					</div>
					<div class="stat-content">
						<div class="text-left dib">
							<div class="stat-text"><span class="count"><?php echo $situacao[2] ?></span></div>
							<div class="stat-heading">Processo de Baixa</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        </a>
	</div>
	<div class="col-lg-3 col-md-6">
        <a href="painel.php?pagina=morto">
		<div class="card">
			<div class="card-body">
				<div class="stat-widget-five">
					<div class="stat-icon dib flat-color-4">
						<i class="fa fa-folder-open"></i>
					</div>
					<div class="stat-content">
						<div class="text-left dib">
							<div class="stat-text"><span class="count"><?php echo $situacao[3] ?></span></div>
							<div class="stat-heading">Morto</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        </a>
	</div>
	
</div>


<div class="row">
	<div class="col-lg-6"> 
		<div class="card">
			<div class="card-body">
				<h4 class="box-title">Últimos Bens Cadastrados </h4>
			</div>


			<?php
			include_once 'model/bem.php';
			//Chamando função de consulta
			$bens = consultarBensUltimos();
			?>
			<div class="card-body--">
				<div class="table-stats order-table ov-h">
					<table class="table ">
						<thead>
							<tr>
								<th scope="col">N° Inven.</th>
								<th scope="col">Identificação</th>
								<th scope="col">Operação</th>
								<th scope="col">Situação</th>
							</tr>
						</thead>
						<tbody> 
							<?php if (mysqli_num_rows($bens) > 0) : ?>
								<?php while ($bem = mysqli_fetch_assoc($bens)) : ?>
							<tr>
								<td><?php echo $bem['nr_inventario']; ?></td>
								<td><?php echo $bem['identificacao']; ?></td>
								<td><?php echo $bem['nome_operacao']; ?></td>
								<td>
									<?php if ($bem['situacao'] == 1): ?>
										<span class="badge badge-success">Ativo</span>
									<?php elseif ($bem['situacao'] == 2): ?>
										<span class="badge badge-warning">Processo de Baixa</span>
									<?php elseif ($bem['situacao'] == 3): ?>
										<span class="badge badge-danger">Morto</span>
									<?php endif ?>
								</td>
							</tr>
							<?php endwhile; ?>
							<?php else : ?>
								<tr>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
							<?php endif; ?>

						</tbody>
					</table>
				</div> <!-- /.table-stats -->
			</div>
		</div> <!-- /.card -->
	</div>



	<div class="col-lg-6"> 
		<div class="card">
			<div class="card-body">
				<h4 class="box-title">Usuários que mais cadastraram Bens </h4>
			</div>


			<?php
			include_once 'model/bem.php';
			//Chamando função de consulta
			$usuarios = consultarBensUsuarios();
			?>
			<div class="card-body--">
				<div class="table-stats order-table ov-h">
					<table class="table ">
						<thead>
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Sobrenome</th>
								<th scope="col">Nivel</th>
								<th scope="col">Status</th>
								<th scope="col">Quantidade</th>
							</tr>
						</thead>
						<tbody> 
							<?php if (mysqli_num_rows($usuarios) > 0) : ?>
								<?php while ($usuario = mysqli_fetch_assoc($usuarios)) : ?>
							<tr>
								<td><?php echo $usuario['nome_usuario']; ?></td>
								<td><?php echo $usuario['sobrenome']; ?></td>
								<td><?php echo $usuario['nivel_usuario']; ?></td>
								<td>
									 <?php if ($usuario['status_usuario'] == 0): ?>
                                        <span class="badge badge-danger">Bloqueado</span>
                                    <?php elseif ($usuario['status_usuario'] == 1): ?>
                                        <span class="badge badge-success">Ativo</span>
                                    <?php endif ?>
								</td>
								<td><span class="count"><?php echo $usuario['total']; ?></span></td>
							</tr>
							<?php endwhile; ?>
							<?php else : ?>
								<tr>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
							<?php endif; ?>

						</tbody>
					</table>
				</div> <!-- /.table-stats -->
			</div>
		</div> <!-- /.card -->
	</div>
</div>
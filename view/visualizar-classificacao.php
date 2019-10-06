
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header"><strong><i class="fa fa-list-alt"></i> Editar Classificação</strong></div>
			<div class="card-body card-block">

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
							<label for="">Número de Título</label>
							<p><?php echo $classificacao['nr_titulo'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Titulo da Classificacao</label>
							<p><?php echo $classificacao['codclass_titulo'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Número de Subtítulo</label>
							<p><?php echo $classificacao['nr_subtitulo'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Subtítulo da Classificacao</label>
							<p><?php echo $classificacao['codclass_subtitulo'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Valor Depreciação</label>
							<p><?php echo $classificacao['valor_depre'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="">Data Depreciação</label>
							<p><?php echo $classificacao['dt_inicio'] ?></p>
						</div>
					</div>
					
					<div class="card-body">
						<a href="?pagina=lista-classificacao" class="btn btn-danger" >Voltar</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>



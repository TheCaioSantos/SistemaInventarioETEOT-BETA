
<form action="controller/local.php<?php echo isset($_GET['idlocal']) ? '?idlocal=' . $_GET['idlocal'] : '' ?>" method="POST">
	<div class="row">


		

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-list-alt"></i> Editar Local</strong></div>
				<div class="card-body card-block">


					<ul>
                        <?php
                        if (count($_GET) > 1) {
                            unset($_GET['pagina']);
                            foreach ($_GET as $i => $campo) {
                                if ($campo == 'bem') {
                                    echo '<li>O BEM deve ser preenchido.</li>';
                                } elseif ($campo == 'setor') {
                                    echo '<li>O SETOR deve ser preenchida.</li>';
                                } 
                            }
                        }
                        ?>
                    </ul>

					<?php 
					if (isset($_GET['idlocal']) && $idlocal = trim($_GET['idlocal'])) {
						include_once 'model/local.php';
						$local = consultarLocal($idlocal);
						$local = mysqli_fetch_assoc($local);
					}
					?>


					<div class="row">
						<div class="col-md-4">
                    		<div class="form-group">
                    			<label for="bem">Bem<span class="text-danger"></span></label>
                                <?php 
                                include_once 'model/local.php';

                                $bem = consultarBemLocal($local['idbem']);
                                $bem = mysqli_fetch_assoc($bem);
                                ?>
                                <input type="hidden" name="bem" value="<?php echo $bem['idbem']?>" class="form-control">
                                <input type="text" id="disabled-input" name="disabled-input" placeholder="<?php echo $bem['nr_inventario'].' - '.$bem['identificacao']; ?>" disabled="" class="form-control">

                    		</div>
                    	</div>

                    	<div class="col-md-4">
                    		<div class="form-group">
                                <label for="setor">Setor<span class="text-danger"></span></label>

                                <?php if (empty($local['dt_fim'])): ?>
                                    <select name="setor" data-placeholder="Escolha o Setor..." class="standardSelect">
                                        <option value="" label="default"></option>
                                        <?php 
                                        include_once 'model/local.php';

                                        $setores = consultarSetoresLocal();
                                        ?>
                                        <?php while ($setor = mysqli_fetch_assoc($setores)) : ?>
                                            <?php if ($local['nome_setor'] == $setor['nome_setor'] ): ?>
                                                <option value="<?php echo $setor['idsetor']; ?>" selected><?php echo $setor['nome_setor']; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $setor['idsetor']; ?>"><?php echo $setor['nome_setor']; ?></option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                    <?php else: ?>
                                        <?php 
                                        include_once 'model/local.php';

                                        $setor = consultarSetorLocal($local['idsetor']);
                                        $setor = mysqli_fetch_assoc($setor);
                                        ?>
                                        <input type="text" id="disabled-input" name="disabled-input" placeholder="<?php echo $setor['nome_setor']; ?>" disabled="" class="form-control">
                                <?php endif ?>
                    			
                    		</div>
                    	</div>

                    	<div class="col-md-4">
                            <div class="form-group">
                                <label>Data Inicial<span class="text-danger"></span></label>
                                <p><?php echo date('d/m/Y',strtotime($local['dt_inicio'])); ?></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data Final<span class="text-danger"></span></label>
                                <p><?php echo isset($local['dt_fim']) && trim($local['dt_fim']) ? date('d/m/Y',strtotime($local['dt_fim'])) : '-'; ?></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (empty($local['dt_fim'])): ?>
                                <button type="submit" class="btn btn-primary" role="button" id="cadastrar">Transferir</button>
                            <?php endif ?>
                            
                            <a href="?pagina=lista-locais" class="btn btn-danger">Voltar</a>
                        </div>



						</div>

						
						<!-- Mensagem de cadastrado com sucesso -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'sucesso'):
							?>
							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-success">Sucesso</span>
									Setor Atualizado com sucesso.
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
									Erro ao tentar Atualizar Setor.
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

	

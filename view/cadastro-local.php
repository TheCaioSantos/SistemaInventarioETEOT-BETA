

<form action="controller/local.php" method="POST">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong><i class="fa fa-list-alt"></i> Cadastrar Local</strong></div>
                <div class="card-body card-block">

                    <ul>
                        <?php
                        if (count($_GET) > 1) {
                            unset($_GET['pagina']);
                            foreach ($_GET as $i => $campo) {
                                if ($campo == 'bem') {
                                    echo '<li>O BEM deve ser preenchido.</li>';
                                } elseif ($campo == 'setor') {
                                    echo '<li>O SETOR deve ser preenchido.</li>';
                                } 
                            }
                        }
                        ?>
                    </ul>

                    <div class="row">

                    	<div class="col-md-4">
                    		<div class="form-group">
                    			<label for="bem">Bem<span class="text-danger"></span></label>

                    			<select name="bem" data-placeholder="Escolha o Bem..." class="standardSelect">
                    				<option value="" label="default"></option>
                    				<?php 
                                    include_once 'model/local.php';

                                    $bens = consultarBensLocal();
                                    ?>
                    				<?php while ($bem = mysqli_fetch_assoc($bens)) : ?>
                                        <option value="<?php echo $bem['idbem']; ?>"><?php echo $bem['nr_inventario'].' - '.$bem['identificacao']; ?></option>
                                    <?php endwhile; ?>
                    			</select>
                    		</div>
                    	</div>

                    	<div class="col-md-4">
                    		<div class="form-group">
                                <label for="setor">Setor<span class="text-danger"></span></label>
                    			<select name="setor" data-placeholder="Escolha o Setor..." class="standardSelect">
                    				<option value="" label="default"></option>
                    				<?php 
                                    include_once 'model/local.php';

                                    $setores = consultarSetoresLocal();
                                    ?>
                    				<?php while ($setor = mysqli_fetch_assoc($setores)) : ?>
                                        <option value="<?php echo $setor['idsetor']; ?>"><?php echo $setor['nome_setor']; ?></option>
                                    <?php endwhile; ?>
                    			</select>
                    		</div>
                    	</div>

                    	

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary" role="button" id="cadastrar">Cadastrar</button>
                            <a href="?pagina=lista-locais" class="btn btn-danger">Cancelar</a>
                        </div>

                    </div>

                    <!-- Mensagem de cadastrado com sucesso -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') :
                        ?>
                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-success">Sucesso</span>
                                Local cadastrado com sucesso.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php
                endif; ?>

                    <!-- Mensagem de erro ao cadastrado  -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'erro') :
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
                endif; ?>

                    
                </div>
            </div>
        </div>

    </div>
</form>


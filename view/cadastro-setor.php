

<form action="controller/setor.php" method="POST">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong><i class="fa fa-list-alt"></i> Cadastrar Setor</strong></div>
                <div class="card-body card-block">

                    <ul>
                        <?php
                        if (count($_GET) > 1) {
                            unset($_GET['pagina']);
                            foreach ($_GET as $i => $campo) {
                                if ($campo == 'nome-setor') {
                                    echo '<li>O NOME DO SETOR deve ser preenchido.</li>';
                                } elseif ($campo == 'categoria-setor') {
                                    echo '<li>A CATEGORIA DO SETOR deve ser preenchida.</li>';
                                } 
                            }
                        }
                        ?>
                    </ul>

                    <div class="row">

                        <div class="col-md-4" id="input-valor-oculto-compra-1">
                            <div class="form-group">
                                <label for="nome-setor">Nome Setor<span class="text-danger">*</span></label>
                                <input name="nome-setor" type="text" class="form-control" placeholder="Ex.: Laboratório A">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-2">
                            <div class="form-group">
                                <label for="categoria-setor">Categoria Setor<span class="text-danger">*</span></label>
                                <input name="categoria-setor" type="text" class="form-control" placeholder="Ex.: Laboratório de Informática">
                            </div>
                        </div>


                        <div class="card-body">
                            <button type="submit" class="btn btn-primary" role="button" id="cadastrar">Cadastrar</button>
                            <a href="?pagina=lista-setor" class="btn btn-danger">Cancelar</a>
                        </div>

                    </div>

                    <!-- Mensagem de cadastrado com sucesso -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') :
                        ?>
                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-success">Sucesso</span>
                                Setor cadastrado com sucesso.
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

                    <!-- 	Mensagem de usuário já escolhido -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'nomeerro') :
                        ?>

                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                Nome deSetor já foi cadastrado.
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


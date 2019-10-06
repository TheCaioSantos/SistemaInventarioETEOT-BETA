

<form action="controller/classificacao.php" method="POST">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong><i class="fa fa-list-alt"></i> Cadastrar Classificação</strong></div>
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
                                <label for="nr-titulo">Número de Título<span class="text-danger">*</span></label>
                                <input name="nr-titulo" type="text" class="form-control" placeholder="Ex.: 1.2.3.1.1.05.14">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-2">
                            <div class="form-group">
                                <label for="titulo-class">Titulo da Classificacao<span class="text-danger">*</span></label>
                                <input name="titulo-class" type="text" class="form-control" placeholder="Ex.: MÁQUINAS E EQUIPAMENTOS DE NATUREZA INDUSTRIAL">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-2">
                            <div class="form-group">
                                <label for="nr-sub">Número de Subtítulo<span class="text-danger">*</span></label>
                                <input name="nr-sub" type="text" class="form-control" placeholder="Ex.: 99">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-2">
                            <div class="form-group">
                                <label for="subtitulo-class">Subtítulo da Classificacao<span class="text-danger">*</span></label>
                                <input name="subtitulo-class" type="text" class="form-control" placeholder="Ex.: DIVERSOS (TORNOS, TRITURADOR DE RESÍDUOS, GERADOR DE ÁUDIO, AFIADOR, DESCASCADOR DE BATATAS, CORTADORES DE LEGUMES, BANCADA COM FURADEIRA, BANHO-MARIA, CARREGADOR PARA BATERIA AUTOMOTIVA, CONJ. PISCINA, C/ FILTRO E BOMBA, PROCESSADOR DE LEGUMES, CÂMARA FRIGORÍFICA, CENTRÍFUGAS EM GERAL, COMPRESSORES EM GERAL, ESMERIL, ESTERILIZADOR, ESTUFA, FORNO, INDUSTRIAL, FURADEIRAS EM GERAL, CILINDRO PARA MASSAS, MÁQ. SOLDA, MESA DE LUZ, CALDEIRAS, FILTRO INDUSTRIAL, AQUECEDORES DE ÁGUA E GÁS, FREZADORA, MÁQ. DE GELO, LAVADORA DE LATA PRESSÃO, LIXADEIRA, BETONEIRAS, TORNOS EM GERAL, VACUÔMETRO EM GERAL, MOTORES EM GERAL, MARTELETE, OUTROS MATERIAIS DE USO DURADOURO">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="valor-depreciacao">Valor Depreciação<span class="text-danger"></span></label>
                                <input name="valor-depreciacao" type="text" class="form-control" placeholder="Ex.: ">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data-depreciacao">Data Depreciação<span class="text-danger"></span></label>
                                <input name="data-depreciacao" type="date" class="form-control">
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
                                Usuário cadastrado com sucesso.
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

                    <!--    Mensagem de usuário já escolhido -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'bemerro') :
                        ?>

                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                O BEM escolhido já foi cadastrado.
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


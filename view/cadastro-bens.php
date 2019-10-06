

<form action="controller/bem.php" method="POST">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong><i class="fa fa-list-alt"></i> Cadastrar Bem</strong></div>
                <div class="card-body card-block">

                    <ul>
                        <?php
                        if (count($_GET) > 1) {
                            unset($_GET['pagina']);
                            foreach ($_GET as $i => $campo) {
                                if ($campo == 'nr_inventario') {
                                    echo '<li>O NÚMERO DO INVENTÁRIO deve ser preenchido.</li>';
                                } elseif ($campo == 'codclass-subtitulo') {
                                    echo '<li>A CLASSIFICAÇÃO deve ser preenchida.</li>';
                                } elseif ($campo == 'identificacao') {
                                    echo '<li>A IDENTIFICAÇÃO deve ser preenchida.</li>';
                                } elseif ($campo == 'operacao') {
                                    echo '<li>A OPERAÇÃO deve ser preenchida.</li>';
                                } elseif ($campo == 'situacao-bem') {
                                    echo '<li>A SITUAÇÃO deve ser preenchida.</li>';
                                } elseif ($campo == 'conservacao-historico') {
                                    echo '<li>A CONSERVAÇÃO deve ser preenchida.</li>';
                                } elseif ($campo == 'quantidade') {
                                    echo '<li>A QUANTIDADE deve ser preenchida.</li>';
                                } 
                            }
                        }
                        ?>
                    </ul>



<!-- Mensagem de cadastrado com sucesso -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') :
                        ?>
                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-success">Sucesso</span>
                                Bem cadastrado com sucesso.
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

                    <!--    Mensagem de bem já cadastrado -->
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





                    
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cod-class-titulo">Código de classificação<span class="text-danger">*</span></label>
                                <select name="cod-class-titulo" class="form-control" id="cod-class-titulo" >
                                    <option value="">Escolha uma classificação</option>
                                    <?php 
                                    include_once 'model/cod_class.php';

                                    $cods = consultarCods();
                                    ?>
                                    <?php while ($cod = mysqli_fetch_assoc($cods)) : ?>
                                        <option value="<?php echo $cod['nr_titulo']; ?>"><?php echo $cod['nr_titulo'].' - '.$cod['codclass_titulo'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codclass-subtitulo">Classificação<span class="text-danger">*</span></label>
                                <select name="codclass-subtitulo" class="form-control" id="codclass-subtitulo">
                                </select>
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nr-inventario-bem">Número de Inventário<span class="text-danger">*</span></label>
                                <input name="nr-inventario-bem" type="text" class="form-control" placeholder="Ex.: 000001">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="identificacao-bem">Identificação<span class="text-danger">*</span></label>
                                <textarea name="identificacao-bem" rows="3" class="form-control" placeholder="Ex.: Computador"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="operacao-bem">Operação<span class="text-danger">*</span></label>
                                <select name="operacao-bem" class="form-control" id="select-operacao-bem">
                                    <option value=""></option>
                                    <option value="1">Compra</option>
                                    <option value="2">Transferencia</option>
                                    <option value="3">Doação</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="situacao-bem">Situação<span class="text-danger">*</span></label>
                                <select name="situacao-bem" class="form-control">
                                    <option value=""></option>
                                    <option value="1">ATIVO</option>
                                    <option value="2">PROCESSO DE BAIXA</option>
                                    <option value="3">MORTO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="conservacao-historico">Conservação<span class="text-danger">*</span></label>
                                <select name="conservacao-historico" class="form-control">
                                    <option value=""></option>
                                    <option value="OK">OK</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidade">Quantidade Entrada<span class="text-danger">*</span></label>
                                <input name="quantidade" type="number" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="historico-bem-historico">Histórico Bem<span class="text-danger"></span></label>
                                <textarea name="historico-bem-historico" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="historico-operacao">Histórico da Operação<span class="text-danger"></span></label>
                                <textarea name="historico-operacao" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observacao-bem">Observação<span class="text-danger"></span></label>
                                <textarea name="observacao-bem" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-1">
                            <div class="form-group">
                                <label for="valor-entrada">Valor<span class="text-danger"></span></label>
                                <input name="valor-entrada" type="text" class="form-control" placeholder="Ex.: R$ 1500.95">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-2">
                            <div class="form-group">
                                <label for="nr-rec-recibo">Documento Hábil<span class="text-danger"></span></label>
                                <input name="nr-rec-recibo" type="text" class="form-control" placeholder="Ex.: 12345">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-3">
                            <div class="form-group">
                                <label for="data-recibo">Data Recibo<span class="text-danger"></span></label>
                                <input name="data-recibo" type="date" class="form-control">
                            </div>
                        </div>







                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nome-instituicao">Nome Instituição<span class="text-danger"></span></label>
                                <input name="nome-instituicao" type="text" class="form-control" placeholder="Ex.: xxxx">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefone-instituicao">Telefone Instituição<span class="text-danger"></span></label>
                                <input name="telefone-instituicao" type="text" class="form-control" placeholder="Ex.: 2133447788">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cnpj-instituicao">CNPJ Instituição<span class="text-danger"></span></label>
                                <input name="cnpj-instituicao" type="text" class="form-control" placeholder="Ex.: xxxx">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data-trans">Data Transferência<span class="text-danger"></span></label>
                                <input name="data-trans" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data-doacao">Data Doação<span class="text-danger"></span></label>
                                <input name="data-doacao" type="date" class="form-control">
                            </div>
                        </div>

                        

                        

                        

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary" role="button" id="cadastrar">Cadastrar</button>
                            <a href="?pagina=lista-usuarios" class="btn btn-danger">Cancelar</a>
                        </div>

                    </div>

                    
                </div>
            </div>
        </div>

    </div>
</form>


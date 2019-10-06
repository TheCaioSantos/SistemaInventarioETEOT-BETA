
<div class="row ">

<div class="col-lg-12 ">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"><i class="fa fa-folder-open"></i> Bens</strong>
        </div>

        <?php 
        include_once 'model/bem.php';

        $registros_por_pagina = 10;
        $pagina = isset($_GET['page']) && trim($_GET['page']) ? (int)$_GET['page'] : 1;
        $inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;


        if (isset($_POST['identificacao']) && $_POST['identificacao'] != '') {
            $bens = filtroIdentificacaoBem($_POST['identificacao']);
        } elseif (isset($_POST['situacao']) && $_POST['situacao'] != '') {
            $bens = filtroSituacaoBem($_POST['situacao']);
        } elseif (isset($_POST['operacao'])  && $_POST['operacao'] != '') {
            $bens = filtroOperacaoBem($_POST['operacao']);
        } else{
            $bens = consultarBens(null, $inicio, $registros_por_pagina);
        }

        $total = listarBem();
        $num_total = mysqli_num_rows($total);
        $num_paginas = ceil($num_total / $registros_por_pagina);
        
        
        ?>



        <div class="card-body">
            <div class="row">
                <div class="col-md-3 form-filtro">
                    <form action="?pagina=listar-bens" method="POST">
                        <div class=" form-group">
                            <label for="identificacao"><strong>Filtrar por Identificação</strong></label>
                            <div class="input-group">
                                <input type="text" name="identificacao" class="form-control">
                                <div class="input-group-btn"><button class="btn badge-success">Filtrar</button></div>
                            </div>
                        </div>
                    </form>
                </div>
                    <div class="col-md-3 form-filtro">
                        <form action="?pagina=listar-bens" method="POST">
                            <div class=" form-group">
                                <label for="situacao"><strong>Filtrar por Situação</strong></label>
                                <div class="input-group">
                                    <select name="situacao" class="form-control">
                                        <option></option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Processo de Baixa</option>
                                        <option value="3">Morto</option>
                                    </select>
                                    <div class="input-group-btn"><button class="btn badge-success">Filtrar</button></div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3 form-filtro">
                        <form action="?pagina=listar-bens" method="POST">
                            <div class=" form-group">
                                <label for="operacao"><strong>Filtrar por Operação</strong></label>
                                <div class="input-group">
                                    <select name="operacao" class="form-control">
                                        <option></option>
                                        <option value="1">Compra</option>
                                        <option value="2">Transferência</option>
                                        <option value="3">Doação</option>
                                    </select>
                                    <div class="input-group-btn"><button class="btn badge-success">Filtrar</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="table-responsive-sm">
                <table class="table table-sm table-hover table-striped estilo-tabela text-center">
                    <thead >
                        <tr>
                            <th scope="col">N° Inven.</th>
                            <th scope="col">Identificação</th>
                            <th scope="col">Operação</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Cadastrado Por</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Exibindo usuários cadastrados -->
                        <?php if (mysqli_num_rows($bens) > 0): ?>
                            <?php while($bem = mysqli_fetch_assoc($bens)): ?>
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
                                    <td><?php echo $bem['nome_usuario']; ?></td>
                                    <td>
                                        <a href="painel.php?pagina=visualizar-bem&idbem=<?php echo $bem['idbem']; ?>&operacao=<?php echo $bem['operacao']; ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Detalhes</a>
                                        
                                        <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2): ?>
                                            <a href="painel.php?pagina=editar-bem&idbem=<?php echo $bem['idbem']; ?>&operacao=<?php echo $bem['operacao']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <?php else: ?>
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

                <?php if (empty($_POST['identificacao']) && empty($_POST['situacao']) && empty($_POST['operacao'])) :?>

                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $num_paginas; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="?pagina=listar-bens&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>

                <?php endif; ?>




            </div>
        </div>
    </div>
</div>
</div>





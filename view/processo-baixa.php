<div class="row ">

    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"><i class="fa fa-folder-open"></i> Bens Em Processo de Baixa</strong>
            </div>

            <?php
            include_once 'model/bem.php';
            //Chamando função de consulta
            $bens = consultarBensProcessoBaixa();
            ?>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-hover estilo-tabela">
                        <thead>
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

                            <!-- Exibindo bens cadastrados -->
                            <?php if (mysqli_num_rows($bens) > 0) : ?>
                                <?php while ($bem = mysqli_fetch_assoc($bens)) : ?>
                                    <tr>
                                        <td><?php echo $bem['nr_inventario']; ?></td>
                                        <td><?php echo $bem['identificacao']; ?></td>
                                        <td><?php echo $bem['nome_operacao']; ?></td>
                                        <td><?php echo $bem['nome_situacao']; ?></td>
                                        <td><?php echo $bem['nome_usuario']; ?></td>
                                        <td>
                                            <a href="painel.php?pagina=visualizar-bem&idbem=<?php echo $bem['idbem']; ?>&operacao=<?php echo $bem['operacao']; ?>" class="btn btn-outline-success btn-sm">Visualizar</a>
                                            <a href="painel.php?pagina=editar-bem&idbem=<?php echo $bem['idbem']; ?>&operacao=<?php echo $bem['operacao']; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
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
                </div>
            </div>
        </div>
    </div>
</div>
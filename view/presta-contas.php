<div class="row ">

    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"><i class="fa fa-folder-open"></i> Bens Ativos</strong>
            </div>

            <?php
            include_once 'model/bem.php';
            //Chamando função de consulta
            $bens = prestaContas();
            ?>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-hover estilo-tabela">
                        <thead class="text-center">
                            <tr id="borda-tabela">
                                <th colspan="2" >xxx</th>
                            </tr>
                            <tr>

                                <th scope="col">Código de Classificação</th>
                                <th scope="col">Interpretação</th>
                                <th scope="col">Valor Atual</th>
                                <th scope="col">Entradas</th>
                                <th scope="col">Saídas</th>
                                <th scope="col">Depeciação (+)</th>
                                <th scope="col">Depeciação (-)</th>
                                <th scope="col">Depeciação</th>
                                <th scope="col">Valor Depreciado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Exibindo bens cadastrados -->
                            <?php if (mysqli_num_rows($bens) > 0) : ?>
                                <?php while ($bem = mysqli_fetch_assoc($bens)) : ?>
                                    <tr>
                                        <td><?php echo $bem['nr_titulo']; ?></td>
                                        <td><?php echo $bem['codclass_titulo']; ?></td>
                                        <td><?php echo $bem['valor_ent']; ?></td>
                                        <td><input name="entradas" type="text" class="form-control"></td>
                                        <td><input name="saidas" type="text" class="form-control"></td>
                                        <td><input name="depre-ent" type="text" class="form-control"></td>
                                        <td><input name="depre-sai" type="text" class="form-control"></td>
                                        <td><input name="depreciacao" type="text" class="form-control"></td>
                                        <td><input name="valor-atual" type="text" class="form-control"></td>
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
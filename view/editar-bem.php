
<form action="controller/bem.php<?php echo isset($_GET['idbem']) ? '?idbem=' . $_GET['idbem'] : '' ?><?php echo isset($_GET['operacao']) ? '&operacao=' . $_GET['operacao'] : '' ?>" method="POST">
	<div class="row">


		

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-list-alt"></i> Editar Bem</strong></div>
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
                    if (isset($_GET['update']) && $_GET['update'] == 'sucesso') :
                        ?>
                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-success">Sucesso</span>
                                Bem atualizado com sucesso.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php
                endif; ?>

                    <!-- Mensagem de erro ao cadastrado  -->
                    <?php
                    if (isset($_GET['update']) && $_GET['update'] == 'erro') :
                        ?>

                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                Erro ao tentar Atualizar.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php
                endif; ?>

                    <!--    Mensagem de BEM já CADASTRADO -->
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





					<?php 
					if (isset($_GET['idbem']) && $idbem = trim($_GET['idbem'])) {
						include_once 'model/bem.php';
						$operacao = isset($_GET['operacao']) && trim($_GET['operacao']) ? trim($_GET['operacao']) : null;
						if ($operacao == 1) {
							$bem = consultarBensCompra($idbem);
						} elseif ($operacao == 2) {
							$bem = consultarBensTrans($idbem);
						} elseif ($operacao == 3) {
							$bem = consultarBensDoacao($idbem);
						}

						$bem = mysqli_fetch_assoc($bem);
					}

					?>


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
                                        <?php if ($bem['codclass_titulo'] == $cod['codclass_titulo'] ): ?>
                                            <option value="<?php echo $cod['nr_titulo']; ?> " selected><?php echo $cod['nr_titulo'].' - '.$cod['codclass_titulo'] ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $cod['nr_titulo']; ?>"><?php echo $cod['nr_titulo'].' - '.$cod['codclass_titulo'] ?></option>
                                        <?php endif; ?>

                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codclass-subtitulo">Classificação<span class="text-danger">*</span></label>
                                <select name="codclass-subtitulo" class="form-control" id="codclass-subtitulo">
                                    <option value="">Selecione uma classificação</option>


                                    <?php 
                                    include_once 'model/cod_class.php';

                                    $test = $bem['nr_titulo'];

                                    $cods = consultarCodclassEditar($test);
                                    
                                    ?>

                                    <?php while ($cod = mysqli_fetch_assoc($cods)) : ?>
                                        <?php if ($bem['codclass_subtitulo'] == $cod['codclass_subtitulo'] ): ?>
                                            <option value="<?php echo $cod['idcod_class']; ?> " selected><?php echo $cod['nr_subtitulo'].' - '.$cod['codclass_subtitulo'] ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $cod['idcod_class']; ?>"><?php echo $cod['nr_subtitulo'].' - '.$cod['codclass_subtitulo'] ?></option>
                                        <?php endif; ?>

                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

						<div class="col-md-4">
                            <div class="form-group">
                                <label for="nr-inventario-bem">Número de Inventário</label>
                                <input name="nr-inventario-bem" type="text" class="form-control" value="<?php echo $bem['nr_inventario'] ?>">
                            </div>
                        </div>

						<div class="col-md-4">
                            <div class="form-group">
                                <label for="identificacao-bem">Identificação</label>
                                <textarea name="identificacao-bem" rows="3" class="form-control" ><?php echo $bem['identificacao'] ?></textarea>
                            </div>
                        </div>



                        <?php
                        $operacao_ = array(
                        	'1' => 'Compra',
                        	'2' => 'Transferência',
                        	'3' => 'Doação',
                        );
                        ?>

                        <div class="col-md-4">
                        	<div class="form-group">
                        		<label for="operacao-bem">Operação</label>
                        		<select name="operacao-bem" class="form-control">
                        			<option></option>
                        			<?php foreach ($operacao_ as $posicao => $valor): ?>
                        				<?php if (isset($bem) && $bem['operacao'] == $posicao): ?>
                        					<option value="<?php echo $posicao ?>" selected><?php echo $valor ?></option>
                        				<?php else: ?>
                        					<option value="<?php echo $posicao ?>"><?php echo $valor ?></option>
                        				<?php endif; ?>
                        			<?php endforeach; ?>
                        		</select>
                        	</div>
                        </div>



                        <?php
                        $situacao = array(
                        	'1' => 'Ativo',
                        	'2' => 'Processo de Baixa',
                        	'3' => 'Morto',
                        );
                        ?>

                        <div class="col-md-4">
                        	<div class="form-group">
                        		<label for="situacao-bem">Situação</label>
                        		<select name="situacao-bem" class="form-control">
                        			<option></option>
                        			<?php foreach ($situacao as $posicao => $valor): ?>
                        				<?php if (isset($bem) && $bem['situacao'] == $posicao): ?>
                        					<option value="<?php echo $posicao ?>" selected><?php echo $valor ?></option>
                        				<?php else: ?>
                        					<option value="<?php echo $posicao ?>"><?php echo $valor ?></option>
                        				<?php endif; ?>
                        			<?php endforeach; ?>
                        		</select>
                        	</div>
                        </div>



                        <?php
                        $conservacao = array(
                        	'OK' => 'OK',
                        );
                        ?>

                        <div class="col-md-4">
                        	<div class="form-group">
                        		<label for="conservacao-historico">Conservação</label>
                        		<select name="conservacao-historico" class="form-control">
                        			<option value=" "></option>
                        			<?php foreach ($conservacao as $posicao => $valor): ?>
                        				<?php if (isset($bem) && $bem['conservacao'] == $posicao): ?>
                        					<option value="<?php echo $posicao ?>" selected><?php echo $valor ?></option>
                        				<?php else: ?>
                        					<option value="<?php echo $posicao ?>"><?php echo $valor ?></option>
                        				<?php endif; ?>
                        			<?php endforeach; ?>
                        		</select>
                        	</div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="disabledSelect">Quantidade</label>
                                <input type="text" id="disabled-input" name="disabled-input" placeholder="<?php echo $bem['qtde'] ?>" disabled="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidade">Alterar Quantidade</label>
                                <input name="quantidade" type="number" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="historico-bem-historico">Histórico Bem<span class="text-danger"></span></label>
                                <textarea name="historico-bem-historico" rows="3" class="form-control"><?php echo isset($bem['hist_bem']) ? trim($bem['hist_bem']) : ' ' ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="historico-operacao">Histórico da Operação<span class="text-danger"></span></label>
                                <textarea name="historico-operacao" rows="3" class="form-control"><?php echo isset($bem['hist_operacao']) ? trim($bem['hist_operacao']) : ' ' ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observacao-bem">Observação<span class="text-danger"></span></label>
                                <textarea name="observacao-bem" rows="3" class="form-control"><?php echo isset($bem['observacao']) ? trim($bem['observacao']) : ' ' ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-1">
                            <div class="form-group">
                                <label for="valor-entrada">Valor</label>
                                <input name="valor-entrada" type="text" class="form-control" value="<?php echo isset($bem['valor_ent']) ? trim($bem['valor_ent']) : 0 ?>">
                            </div>
                        </div>

                        <div class="col-md-4" id="input-valor-oculto-compra-2">
                            <div class="form-group">
                                <label for="nr-rec-recibo">Documento Hábil</label>
                                <input name="nr-rec-recibo" type="text" class="form-control" value="<?php echo isset($bem['nr_rec']) ? trim($bem['nr_rec']) : ' ' ?>">
                            </div>
                        </div>

						<div class="col-md-4" id="input-valor-oculto-compra-3">
                            <div class="form-group">
                                <label for="data-recibo">Data Recibo</label>
                                <input name="data-recibo" type="date" class="form-control" value="<?php echo isset($bem['dt_rec']) ? trim($bem['dt_rec']) : ' ' ?>">
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nome-instituicao">Nome Instituição<span class="text-danger"></span></label>
                                <input name="nome-instituicao" type="text" class="form-control" value="<?php echo isset($bem['nome_instituicao']) ? trim($bem['nome_instituicao']) : ' ' ?>">
                            </div>
                        </div>

                       

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefone-instituicao">Telefone Instituição<span class="text-danger"></span></label>
                                <input name="telefone-instituicao" type="text" class="form-control" value="<?php echo isset($bem['tel_instituicao']) ? trim($bem['tel_instituicao']) : ' ' ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cnpj-instituicao">CNPJ Instituição<span class="text-danger"></span></label>
                                <input name="cnpj-instituicao" type="text" class="form-control" value="<?php echo isset($bem['cnpj_instituicao']) ? trim($bem['cnpj_instituicao']) : ' ' ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data-trans">Data Transferência<span class="text-danger"></span></label>
                                <input name="data-trans" type="date" class="form-control" value="<?php echo isset($bem['dt_ent_trans']) ? trim($bem['dt_ent_trans']) : ' ' ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data-doacao">Data Doação<span class="text-danger"></span></label>
                                <input name="data-doacao" type="date" class="form-control" value="<?php echo isset($bem['dt_entdoacao']) ? trim($bem['dt_entdoacao']) : ' ' ?>">
                            </div>
                        </div>

                        

                        

							
							<div class="card-body">
								<button type="submit" class="btn btn-success" role="button">Atualizar</button>
								<a href="?pagina=listar-bens" class="btn btn-danger" >Cancelar</a>
							</div>



						</div>

						
						
					</div>
				</div>
			</div>

		</div>
	</form>

	

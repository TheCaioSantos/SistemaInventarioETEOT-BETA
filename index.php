<?php 
//iniciando a sessão
session_start();

//Se o usuario estiver logado, ele não consegue ver a tela de login, ele é redirecionado para 'painel.php'
if (isset($_SESSION['idusuario'])) {
      header('Location: painel.php');
      exit();
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Inventário</title>
    <meta name="description" content="Sistema Inventário">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="assets/css/normalize.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.min.css">
  <link rel="stylesheet" href="assets/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="css/estilo.css">
    <style>
        #weatherWidget .currentDesc {
            color: #ffffff!important;
        }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>
<body>
	<div class="d-flex justify-content-center">
		<div class="formulario-login">
			<img src="images/logo-form-login.png" class="img-responsive" alt="Logo Sitema Inventário. Uma caixa aberta em tons de Verde">

            <?php 
			if (isset($_GET['erro']) && $_GET['erro'] == 'bloqueado'):
                ?>
                

                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center">
                  <span class="badge badge-pill badge-danger">Erro</span>
                  Usuário Bloqueado.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <?php 
         endif ?>

			<!-- Mensagem de erro no login: Email ou senha incorretos -->
			<?php 
			if (isset($_GET['erro']) && $_GET['erro'] == 'invalido'):
                ?>
                

                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center">
                  <span class="badge badge-pill badge-danger">Erro</span>
                  E-mail ou senha incorretos.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <?php 
         endif ?>

         <!-- Mensagem de erro no login: O e-mail e a senha devem ser preenchidos. -->
         <?php 
         if (isset($_GET['erro']) && $_GET['erro'] == 'obrigatorio'):
          ?>
          <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center">
            <span class="badge badge-pill badge-danger">Erro</span>
            O E-mail e a senha devem ser preenchidos.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <?php 
   endif ?>

   <form action="controller/login.php" method="POST">

    <div class="form-group">
       <label for="email" class="sr-only">Email</label>
       <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
          <input name="email" type="email" class="form-control" placeholder="E-mail">
      </div>
  </div>
  <div class="form-group">
     <label for="senha" class="sr-only">Senha</label>
     <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input name="senha" type="password" class="form-control" placeholder="Senha">
    </div>
</div>
<button type="submit" class="btn btn-outline-success btn-sm btn-block text-uppercase">Entrar</button>
</form>
</div>
</div>

<!-- /.content -->
<div class="clearfix"></div>

</div>
<!-- /#right-panel -->

<!-- Scripts -->
<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>

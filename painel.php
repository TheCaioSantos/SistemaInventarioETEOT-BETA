<?php
//iniciando a sessão
//session_start();

//Verificando se está logado
include_once 'controller/verifica_login.php';
?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistema Inventário</title>
	<meta name="description" content="Sistema Inventário">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <link rel="stylesheet" href="assets/css/lib/chosen/chosen.min.css">

	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
	<link href="assets/css/chartist.min.css" rel="stylesheet">
	<link href="assets/css/jqvmap.min.css" rel="stylesheet">

	<link href="assets/css/weather-icons.css" rel="stylesheet" />
	<link href="assets/css/fullcalendar.min.css" rel="stylesheet" />

<!-- 	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

	<style>
		#weatherWidget .currentDesc {
			color: #ffffff !important;
		}

		.traffic-chart {
			min-height: 335px;
		}

		#flotPie1 {
			height: 150px;
		}

		#flotPie1 td {
			padding: 3px;
		}

		#flotPie1 table {
			top: 20px !important;
			right: -10px !important;
		}

		.chart-container {
			display: table;
			min-width: 270px;
			text-align: left;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		#flotLine5 {
			height: 105px;
		}

		#flotBarChart {
			height: 150px;
		}

		#cellPaiChart {
			height: 160px;
		}
	</style>
</head>

<body class="open">
	<!-- Left Panel -->
	<aside id="left-panel" class="left-panel">
		<nav class="navbar navbar-expand-sm navbar-default">
			<div id="main-menu" class="main-menu collapse navbar-collapse">
				<?php
				require_once 'model/logado.php';
				?>
				<ul class="nav navbar-nav">
					<li>
						<a href="painel.php"><i class="menu-icon fa fa-laptop"></i>Painel </a>
					</li>
					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder-open"></i>Bens</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-eye"></i><a href="?pagina=listar-bens">Ver Bens</a></li>
							<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
								<li><i class="fa fa-list-alt"></i><a href="?pagina=cadastro-bens">Cadastrar Bem</a></li>
							<?php endif; ?>
						</ul>
					</li>

					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Usuários</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-eye"></i><a href="?pagina=lista-usuarios">Ver Usuarios</a></li>
							<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
								<li><i class="fa fa-list-alt"></i><a href="?pagina=cadastro-usuario">Cadastar Usuários</a></li>
							<?php endif; ?>
						</ul>
					</li>

					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>Setor</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-eye"></i><a href="?pagina=lista-setores">Ver Setores</a></li>
							<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
								<li><i class="fa fa-list-alt"></i><a href="?pagina=cadastro-setor">Cadastrar Setor</a></li>
							<?php endif; ?>
						</ul>
					</li>

					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-asterisk"></i>Classificações</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-eye"></i><a href="?pagina=lista-classificacao"> Ver Classificações</a></li>
							<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
								<li><i class="fa fa-list-alt"></i><a href="?pagina=cadastro-classificacao">Cadastrar Classificação</a></li>
							<?php endif; ?>
						</ul>
					</li>

					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-map-marker"></i>Local</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="menu-icon fa fa-th"></i><a href="?pagina=lista-locais">Ver Local</a></li>
							<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
								<li><i class="menu-icon fa fa-th"></i><a href="?pagina=cadastro-local">Cadastro Local</a></li>
							<?php endif; ?>
						</ul>
					</li>

					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-level-down"></i>Processo de Baixa</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="menu-icon fa fa-th"></i><a href="?pagina=situacao-processo-baixa">Processo de Baixa</a></li>						</ul>
					</li>

					
					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-print"></i>Relatórios</a>
						<ul class="sub-menu children dropdown-menu">
							<li><i class="menu-icon fa fa-th"></i><a href="controller/rel-ativos.php" target="blank">Ativos </a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="controller/rel-processo-baixa.php" target="blank">Processo de Baixa</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="controller/rel-morto.php" target="blank">Morto</a></li>
						</ul>
					</li>
					
					<?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
						<li class="menu-item-has-children dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Prestação de Contas</a>
							<ul class="sub-menu children dropdown-menu">
								<li><i class="menu-icon fa fa-th"></i><a href="?pagina=presta-contas">Ver </a></li>
								<li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
	</aside>
	<!-- /#left-panel -->
	<!-- Right Panel -->
	<div id="right-panel" class="right-panel">
		<!-- Header-->
		<header id="header" class="header">
			<div class="top-left">
				<div class="navbar-header">
					<a class="navbar-brand" href="painel.php"><img src="images/logo.png" alt="Logo"></a>
					<a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
				</div>
			</div>
			<div class="top-right">
				<div class="header-menu">
					<div class="user-area dropdown float-right">
						<a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
							<h5 id="bemvindo"> <?php echo $_SESSION['nome'] ?></h5>
						</a>

						<div class="user-menu dropdown-menu">
							<a class="nav-link" href="?pagina=perfil"><i class="fa fa- user"></i>Perfil</a>

							<a class="nav-link" href="model/logout.php"><i class="fa fa-power -off"></i>Sair</a>
						</div>
					</div>



				</div>
			</div>
		</header>
		<!-- /#header -->
		<!-- Content -->
		<div class="content">
			<!-- Animated -->
			<div class="animated fadeIn">
				<!-- Widgets  -->




				<?php include_once 'controller/router.php'; ?>






				<!-- /#add-category -->
			</div>
			<!-- .animated -->
		</div>
		<!-- /.content -->
		<div class="clearfix"></div>

	</div>
	<!-- /#right-panel -->

	<!-- Scripts -->
	<script src="assets/js/jquery-2.2.4.min.js"></script>



	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.matchHeight.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>
	<script src="js/main.js"></script>




</body>

</html>
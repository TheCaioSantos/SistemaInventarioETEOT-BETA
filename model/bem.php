<?php 

//Função que valida os campos de cadastro
function validarBem($bem, $idbem = null){
	$erros = array();

	//verificando se estar preenchido
	$nr_inventario_bem = isset($bem['nr-inventario-bem']) && trim($bem['nr-inventario-bem']) ? trim($bem['nr-inventario-bem']) : null;
	$identificacao_bem = isset($bem['identificacao-bem']) && trim($bem['identificacao-bem']) ? trim($bem['identificacao-bem']) : null;
	$operacao_bem = isset($bem['operacao-bem']) && trim($bem['operacao-bem']) ? trim($bem['operacao-bem']) : null;
	$valor_entrada = isset($bem['valor-entrada']) && trim($bem['valor-entrada']) ? trim($bem['valor-entrada']) : null;
	$nr_rec_recibo = isset($bem['nr-rec-recibo']) && trim($bem['nr-rec-recibo']) ? trim($bem['nr-rec-recibo']) : null;
	$quantidade = isset($bem['quantidade']) && trim($bem['quantidade']) ? trim($bem['quantidade']) : 0;
	$codclass_subtitulo = isset($bem['codclass-subtitulo']) && trim($bem['codclass-subtitulo']) ? trim($bem['codclass-subtitulo']) : null;
	$situacao_bem = isset($bem['situacao-bem']) && trim($bem['situacao-bem']) ? trim($bem['situacao-bem']) : null;
	$conservacao_historico = isset($bem['conservacao-historico']) && trim($bem['conservacao-historico']) ? trim($bem['conservacao-historico']) : null;
	$historico_bem_historico = isset($bem['historico-bem-historico']) && trim($bem['historico-bem-historico']) ? trim($bem['historico-bem-historico']) : null;
	$historico_operacao = isset($bem['historico-operacao']) && trim($bem['historico-operacao']) ? trim($bem['historico-operacao']) : null;
	$observacao = isset($bem['observacao-bem']) && trim($bem['observacao-bem']) ? trim($bem['observacao-bem']) : null;
	$data_recibo = isset($bem['data-recibo']) && trim($bem['data-recibo']) ? trim($bem['data-recibo']) : null;

	$nome_instituicao = isset($bem['nome-instituicao']) && trim($bem['nome-instituicao']) ? trim($bem['nome-instituicao']) : null;
	$telefone_instituicao = isset($bem['telefone-instituicao']) && trim($bem['telefone-instituicao']) ? trim($bem['telefone-instituicao']) : null;
	$cnpj_instituicao = isset($bem['cnpj-instituicao']) && trim($bem['cnpj-instituicao']) ? trim($bem['cnpj-instituicao']) : null;
	$data_trans = isset($bem['data-trans']) && trim($bem['data-trans']) ? trim($bem['data-trans']) : null;
	$data_doacao = isset($bem['data-doacao']) && trim($bem['data-doacao']) ? trim($bem['data-doacao']) : null;


	if (!$codclass_subtitulo) {
		$erros[] = 'codclass-subtitulo';
	}

	if (!$nr_inventario_bem) {
		$erros[] = 'nr_inventario';
	}

	if (!$identificacao_bem) {
		$erros[] = 'identificacao';
	}

	if (!$operacao_bem) {
		$erros[] = 'operacao';
	}

	if (!$situacao_bem) {
		$erros[] = 'situacao-bem';
	}

	if (!$conservacao_historico) {
		$erros[] = 'conservacao-historico';
	}
	
	if (!$idbem) {
		if (!$quantidade) {
			$erros[] = 'quantidade';
		}
	}
	



	return array(
	 	'erros' => $erros,
	 	'bem' => array(
	 		'nr-inventario-bem' => $nr_inventario_bem,
	 		'identificacao-bem' => $identificacao_bem,
	 		'operacao-bem' => $operacao_bem,
	 		'valor-entrada' => $valor_entrada,
	 		'nr-rec-recibo' => $nr_rec_recibo,
	 		'quantidade' => $quantidade,
	 		'codclass-subtitulo' => $codclass_subtitulo,
	 		'situacao-bem' => $situacao_bem,
	 		'conservacao-historico' => $conservacao_historico,
	 		'historico-bem-historico' => $historico_bem_historico,
	 		'historico-operacao' => $historico_operacao,
	 		'observacao-bem' => $observacao,
	 		'data-recibo' => $data_recibo,
	 		'nome-instituicao' => $nome_instituicao,
	 		'telefone-instituicao' => $telefone_instituicao,
	 		'cnpj-instituicao' => $cnpj_instituicao,
	 		'data-trans' => $data_trans,
	 		'data-doacao' => $data_doacao,
	 	)
	 );
}

function inserirBem($bem) {
	session_start();

	include_once '../model/conexao.php';

	$nr_inventario_bem = mysqli_real_escape_string($conexao, $bem['nr-inventario-bem']);
	$identificacao_bem = mysqli_real_escape_string($conexao, $bem['identificacao-bem']);
	$operacao_bem = mysqli_real_escape_string($conexao, $bem['operacao-bem']);
	$valor_entrada = mysqli_real_escape_string($conexao, floatval($bem['valor-entrada']));
	$nr_rec_recibo = mysqli_real_escape_string($conexao, $bem['nr-rec-recibo']);
	$quantidade = mysqli_real_escape_string($conexao, $bem['quantidade']);
	$codclass_subtitulo = mysqli_real_escape_string($conexao, $bem['codclass-subtitulo']);
	$situacao_bem = mysqli_real_escape_string($conexao, $bem['situacao-bem']); 
	$conservacao_historico = mysqli_real_escape_string($conexao, $bem['conservacao-historico']);
	$historico_bem_historico = mysqli_real_escape_string($conexao, $bem['historico-bem-historico']);
	$historico_operacao = mysqli_real_escape_string($conexao, $bem['historico-operacao']);
	$observacao = mysqli_real_escape_string($conexao, $bem['observacao-bem']);
	$data_recibo = mysqli_real_escape_string($conexao, $bem['data-recibo']);

	$nome_instituicao = mysqli_real_escape_string($conexao, $bem['nome-instituicao']);
	$telefone_instituicao = mysqli_real_escape_string($conexao, $bem['telefone-instituicao']);
	$cnpj_instituicao = mysqli_real_escape_string($conexao, $bem['cnpj-instituicao']);
	$data_trans = mysqli_real_escape_string($conexao, $bem['data-trans']);
	$data_doacao = mysqli_real_escape_string($conexao, $bem['data-doacao']);
	$idusuario = $_SESSION['idusuario'];

	$query = "SELECT COUNT(*) as total FROM bem WHERE nr_inventario = '$nr_inventario_bem'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado algum bem com o mesmo nr cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=cadastro-bens&cadastro=bemerro');
		exit();
	}

	$query = "INSERT INTO historico (hist_bem, conservacao, hist_operacao) 
	VALUES ('$historico_bem_historico', '$conservacao_historico', '$historico_operacao')";

	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

	$idhistorico = mysqli_insert_id($conexao);
	
	$query = "INSERT INTO bem (nr_inventario, identificacao, dt_cadbem, operacao, situacao, observacao, qtde, idusuario, idcod_class, idhistorico) 
	VALUES ('$nr_inventario_bem', '$identificacao_bem', now(), '$operacao_bem', '$situacao_bem', '$observacao', '$quantidade', '$idusuario', '$codclass_subtitulo', '$idhistorico')";

	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

	$idbem = mysqli_insert_id($conexao);


	if ($operacao_bem == 1) {

		$query = "INSERT INTO recibo (nr_rec, dt_rec) 
		VALUES ('$nr_rec_recibo', '$data_recibo')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		$idrecibo = mysqli_insert_id($conexao);


		$query = "INSERT INTO entrada (qtde_entcompra, valor_ent, idbem, idrecibo) 
		VALUES ('$quantidade', '$valor_entrada','$idbem', '$idrecibo')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	}

	if ($operacao_bem == 2 || $operacao_bem == 3) {
		$query = "INSERT INTO instituicao (nome_instituicao, tel_instituicao, cnpj_instituicao)
		VALUES ('$nome_instituicao', '$telefone_instituicao', '$cnpj_instituicao')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		$idinstituicao = mysqli_insert_id($conexao);
	}

	if ($operacao_bem == 2) {
		$query = "INSERT INTO transferencia (qtde_ent_trans, dt_ent_trans, idinstituicao, idbem)
		VALUES ('$quantidade','$data_trans', '$idinstituicao', '$idbem')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	}

	if ($operacao_bem == 3) {
		$query = "INSERT INTO doacao (qtde_entdoacao, dt_entdoacao, idinstituicao, idbem)
		VALUES ('$quantidade','$data_doacao', '$idinstituicao', '$idbem')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	}

	$query = "SELECT qtde_cod_class FROM cod_class WHERE idcod_class = '$codclass_subtitulo '";
	$query = mysqli_query($conexao, $query);
	$query = mysqli_fetch_assoc($query);

	if ($query['qtde_cod_class'] == null) {
		$qtde = 0;
	} else {
		$qtde = $query['qtde_cod_class'];
	}

	$qtde += $quantidade;

	$query = "UPDATE cod_class SET qtde_cod_class = '$qtde' WHERE idcod_class = '$codclass_subtitulo'";
	return mysqli_query($conexao, $query) or die (mysqli_error($conexao));

	
}

function consultarBens($idbem = null, $inicio = null, $registros_por_pagina = null) {
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	INNER JOIN cod_class cc on b.idcod_class = cc.idcod_class
	INNER JOIN historico h on b.idhistorico = h.idhistorico";
	// $query = "SELECT * FROM bem";
	if ($idbem) {
		$query .= " WHERE b.idbem = '$idbem'";
	}

	if (!$idbem) {
		if ($inicio) {
			$query .= " ORDER BY b.idbem DESC LIMIT $inicio, $registros_por_pagina";
		} else {
			$query .= " ORDER BY b.idbem DESC LIMIT $registros_por_pagina";
		}
	}

	return mysqli_query($conexao, $query);
}

function listarBem() {
	//Conexão com Banco de Dados
	include 'model/conexao.php';
	$query = "SELECT * FROM bem";
	return mysqli_query($conexao, $query);
}

function consultarBensCompra($idbem = null) {
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	u.nome_usuario, r.*, cc.*, h.*, e.* FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	INNER JOIN entrada e on b.idbem = e.idbem
	INNER JOIN recibo r on e.idrecibo = r.idrecibo
	INNER JOIN cod_class cc on b.idcod_class = cc.idcod_class
	INNER JOIN historico h on b.idhistorico = h.idhistorico
";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function consultarBensDoacao($idbem = null) {
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.*, d.*, i.* FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	INNER JOIN cod_class cc on b.idcod_class = cc.idcod_class
	INNER JOIN historico h on b.idhistorico = h.idhistorico
	INNER JOIN doacao d on b.idbem = d.idbem
	INNER JOIN instituicao i on d.idinstituicao = i.idinstituicao";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function consultarBensTrans($idbem = null) {
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.*, t.*, i.* FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	INNER JOIN cod_class cc on b.idcod_class = cc.idcod_class
	INNER JOIN historico h on b.idhistorico = h.idhistorico
	INNER JOIN transferencia t on b.idbem = t.idbem
	INNER JOIN instituicao i on t.idinstituicao = i.idinstituicao";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function filtroIdentificacaoBem($identificacao) {
	include_once 'model/conexao.php';

	$query = "SELECT *,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao' 
	FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	WHERE b.identificacao LIKE '%$identificacao%'";

	return mysqli_query($conexao, $query);
}

function filtroSituacaoBem($situacao) {
	include_once 'model/conexao.php';

	$query = "SELECT *,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao' 
	FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	WHERE b.situacao = $situacao";

	return mysqli_query($conexao, $query);
}

function filtroOperacaoBem($operacao) {
	include_once 'model/conexao.php';

	$query = "SELECT *,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao' 
	FROM bem b
	INNER JOIN usuario u on b.idusuario = u.idusuario 
	WHERE b.operacao = $operacao";

	return mysqli_query($conexao, $query);
}




function atualizarBem($bem, $idbem) {
	session_start();

	include_once '../model/conexao.php';

	$nr_inventario_bem = mysqli_real_escape_string($conexao, $bem['nr-inventario-bem']);
	$identificacao_bem = mysqli_real_escape_string($conexao, $bem['identificacao-bem']);
	$operacao_bem = mysqli_real_escape_string($conexao, $bem['operacao-bem']);
	$valor_entrada = mysqli_real_escape_string($conexao, floatval($bem['valor-entrada']));
	$nr_rec_recibo = mysqli_real_escape_string($conexao, $bem['nr-rec-recibo']);
	$quantidade = mysqli_real_escape_string($conexao, $bem['quantidade']);
	$codclass_subtitulo = mysqli_real_escape_string($conexao, $bem['codclass-subtitulo']);
	$situacao_bem = mysqli_real_escape_string($conexao, $bem['situacao-bem']); 
	$conservacao_historico = mysqli_real_escape_string($conexao, $bem['conservacao-historico']);
	$historico_bem_historico = mysqli_real_escape_string($conexao, $bem['historico-bem-historico']);
	$historico_operacao = mysqli_real_escape_string($conexao, $bem['historico-operacao']);
	$observacao = mysqli_real_escape_string($conexao, $bem['observacao-bem']);
	$data_recibo = mysqli_real_escape_string($conexao, $bem['data-recibo']);

	$nome_instituicao = mysqli_real_escape_string($conexao, $bem['nome-instituicao']);
	$telefone_instituicao = mysqli_real_escape_string($conexao, $bem['telefone-instituicao']);
	$cnpj_instituicao = mysqli_real_escape_string($conexao, $bem['cnpj-instituicao']);
	$data_trans = mysqli_real_escape_string($conexao, $bem['data-trans']);
	$data_doacao = mysqli_real_escape_string($conexao, $bem['data-doacao']);
	$idusuario = $_SESSION['idusuario']; //usar???????

	$query = "SELECT COUNT(*) as total FROM bem WHERE nr_inventario = '$nr_inventario_bem' and idbem <> '$idbem'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado algum bem com o mesmo nr cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=editar-bem&cadastro=bemerro&idbem=' . $idbem . '&operacao=' . $operacao_bem);
		exit();
	}

	$query = "UPDATE historico h
	INNER JOIN bem b on b.idhistorico = h.idhistorico
	SET hist_bem = '$historico_bem_historico', conservacao = '$conservacao_historico', hist_operacao = '$historico_operacao'
	WHERE b.idbem = '$idbem'";

	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));


	$query = "UPDATE bem SET nr_inventario = '$nr_inventario_bem', identificacao = '$identificacao_bem', operacao = '$operacao_bem',
	situacao = '$situacao_bem', observacao = '$observacao' WHERE idbem = '$idbem'";

	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

	if ($operacao_bem == 1 && $quantidade > 0) {

		$query = "INSERT INTO recibo (nr_rec, dt_rec) 
		VALUES ('$nr_rec_recibo', '$data_recibo')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		$idrecibo = mysqli_insert_id($conexao);

		$query = "INSERT INTO entrada (qtde_entcompra, valor_ent, idbem, idrecibo) 
		VALUES ('$quantidade', '$valor_entrada','$idbem', '$idrecibo')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	}

	if ($operacao_bem == 2) {

		$query = "UPDATE instituicao i 
		INNER JOIN transferencia t on t.idinstituicao = i.idinstituicao
		INNER JOIN bem b on b.idbem = t.idbem
		SET nome_instituicao = '$nome_instituicao', tel_instituicao = '$telefone_instituicao', cnpj_instituicao = '$cnpj_instituicao'
		WHERE b.idbem = '$idbem'";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		$query = "SELECT i.idinstituicao FROM instituicao i 
		INNER JOIN transferencia t on t.idinstituicao = i.idinstituicao
		INNER JOIN bem b on b.idbem = t.idbem
		WHERE b.idbem = '$idbem'";

		$query = mysqli_query($conexao, $query);
		$query = mysqli_fetch_assoc($query);

		$idinstituicao = $query['idinstituicao'];
	}

	if ($operacao_bem == 3) {

		$query = "UPDATE instituicao i 
		INNER JOIN doacao d on d.idinstituicao = i.idinstituicao 
		INNER JOIN bem b on b.idbem = d.idbem 
		SET nome_instituicao = '$nome_instituicao', tel_instituicao = '$telefone_instituicao', cnpj_instituicao = '$cnpj_instituicao'
		WHERE b.idbem = '$idbem'";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		$query = "SELECT i.idinstituicao FROM instituicao i 
		INNER JOIN doacao d on d.idinstituicao = i.idinstituicao
		INNER JOIN bem b on b.idbem = d.idbem
		WHERE b.idbem = '$idbem'";

		$query = mysqli_query($conexao, $query);
		$query = mysqli_fetch_assoc($query);

		$idinstituicao = $query['idinstituicao'];
		

	}

	if ($operacao_bem == 2 && $quantidade > 0) {
		$query = "INSERT INTO transferencia (qtde_ent_trans, dt_ent_trans, idinstituicao, idbem)
		VALUES ('$quantidade','$data_trans', '$idinstituicao', '$idbem')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	}

	if ($operacao_bem == 3 && $quantidade > 0) {
		$query = "INSERT INTO doacao (qtde_entdoacao, dt_entdoacao, idinstituicao, idbem)
		VALUES ('$quantidade','$data_doacao', '$idinstituicao', '$idbem')";

		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	}

	if ($quantidade > 0) {
		$query = "SELECT qtde FROM bem WHERE idbem = '$idbem'";
		$query = mysqli_query($conexao, $query);
		$query = mysqli_fetch_assoc($query);

		if ($query['qtde'] == null) {
			$qtde_bem = 0;
		} else {
			$qtde_bem = $query['qtde'];
		}

		$query = "SELECT qtde_cod_class FROM cod_class WHERE idcod_class = '$codclass_subtitulo'";
		$query = mysqli_query($conexao, $query);
		$query = mysqli_fetch_assoc($query);

		if ($query['qtde_cod_class'] == null) {
			$qtde_cod_class = 0;
		} else {
			$qtde_cod_class = $query['qtde_cod_class'];
		}

		$qtde_cod_class -= $qtde_bem;

		$query = "UPDATE bem SET qtde = '$quantidade' WHERE idbem = '$idbem'";
		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		$qtde_cod_class += $quantidade;

		$query = "UPDATE cod_class SET qtde_cod_class = '$qtde_cod_class' WHERE idcod_class = '$codclass_subtitulo'";
		$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		
	}



	return $query;
}

function consultarBensSituacao() {
	include_once 'model/conexao.php';

	$situacao = array();

	$query = "SELECT COUNT(*) AS total FROM bem";
	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$query = mysqli_fetch_assoc($query);
	$situacao[] = $query['total'];

	$query = "SELECT COUNT(*) AS ativo FROM bem WHERE situacao = 1";
	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$query = mysqli_fetch_assoc($query);
	$situacao[] = $query['ativo'];

	$query = "SELECT COUNT(*) AS baixa FROM bem WHERE situacao = 2";
	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$query = mysqli_fetch_assoc($query);
	$situacao[] = $query['baixa'];

	$query = "SELECT COUNT(*) AS morto FROM bem WHERE situacao = 3";
	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$query = mysqli_fetch_assoc($query);
	$situacao[] = $query['morto'];

	return $situacao;



}


function consultarBensUltimos($idbem = null)
{
	include 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	ORDER BY dt_cadbem DESC LIMIT 5";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function consultarBensUsuarios($idbem = null){
	include 'model/conexao.php';

	$query = "SELECT *, count(b.idbem) as total FROM usuario u
	INNER JOIN bem b ON b.idusuario = u.idusuario 
	group by nome_usuario 
	order by total desc
	limit 5";
	
	return mysqli_query($conexao, $query);
}

function consultarBensAtivos($idbem = null)
{
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	AND b.situacao = 1";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function relatorioBensAtivos($idbem = null)
{
	include_once '../model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	AND b.situacao = 1";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function consultarBensProcessoBaixa($idbem = null)
{
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	AND b.situacao = 2";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function relatorioBensProcessoBaixa($idbem = null)
{
	include_once '../model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	AND b.situacao = 2";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function consultarBensMorto($idbem = null)
{
	include_once 'model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	AND b.situacao = 3";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function relatorioBensMorto($idbem = null)
{
	include_once '../model/conexao.php';

	$query = "SELECT b.*,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao',
	 u.nome_usuario, cc.*, h.* FROM bem b, usuario u, cod_class cc, historico h
	WHERE b.idusuario = u.idusuario 
	AND b.idcod_class = cc.idcod_class
	AND b.idhistorico = h.idhistorico
	AND b.situacao = 3";
	// $query = "SELECT * FROM bem";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

function prestaContas($idbem = null)
{
	include_once 'model/conexao.php';

	$query = "SELECT cc.nr_titulo, cc.codclass_titulo, SUM(e.valor_ent) as valor_ent, d.valor_depre
FROM entrada e, cod_class cc, depreciacao d, bem b
WHERE cc.idcod_class = d.idcod_class
AND d.idcod_class = cc.idcod_class
AND cc.idcod_class = b.idcod_class
AND e.idbem = b.idbem
GROUP BY cc.nr_titulo";
	if ($idbem) {

		$query .= " WHERE b.idbem = '$idbem'";
	}
	return mysqli_query($conexao, $query);
}

 ?>

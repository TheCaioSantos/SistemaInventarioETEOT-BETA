<?php 


function validarPerfil($usuario, $idusuario = null) {
	$erros = array();

	//verificando se estar preenchido
	$nome = isset($usuario['nome']) && trim($usuario['nome']) ? trim($usuario['nome']) : null;	
	$sobrenome = isset($usuario['sobrenome']) && trim($usuario['sobrenome']) ? trim($usuario['sobrenome']) : null;
	$email = isset($usuario['email']) && trim($usuario['email']) ? trim($usuario['email']) : null;
	$telefone = isset($usuario['telefone']) && trim($usuario['telefone']) ? trim($usuario['telefone']) : null;
	$celular = isset($usuario['celular']) && trim($usuario['celular']) ? trim($usuario['celular']) : null;
	$cpf = isset($usuario['cpf']) && trim($usuario['cpf']) ? trim($usuario['cpf']) : null;

	//validação
	if (!$nome) {
		$erros[] = 'nome';
	}

	if (!$sobrenome) {
		$erros[] = 'sobrenome';
	}

	if (!$email) {
		$erros[] = 'email';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erros[] = 'emailinvalido';
	}

	if (!$telefone) {
		$erros[] = 'telefone';
	} elseif ($telefone && strlen($telefone) != 10) {
		$erros[] = 'telefoneinvalido';
	}

	if (!$celular) {
		$erros[] = 'celular';
	} elseif ($celular && strlen($celular) != 11) {
		$erros[] = 'celularinvalido';
	}

	if (!$cpf) {
		$erros[] = 'cpf';
	} elseif ($cpf && !validaCPF($cpf)){
		$erros[] = 'cpfinvalido';
	} 

	//Retornando array 'erros' e 'usuario'
	 return array(
	 	'erros' => $erros,
	 	'usuario' => array(
	 		'nome' => $nome,
	 		'sobrenome' => $sobrenome,
	 		'email' => $email,
	 		'telefone' => $telefone,
	 		'celular' => $celular,
	 		'cpf' => $cpf,
	 	)
	 );
	}



//função que valida o CPF
	function validaCPF($cpf = null) {

    // Verifica se um número foi informado
		if (empty($cpf)) {
			return false;
		}

    // Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' ||
			$cpf == '11111111111' ||
			$cpf == '22222222222' ||
			$cpf == '33333333333' ||
			$cpf == '44444444444' ||
			$cpf == '55555555555' ||
			$cpf == '66666666666' ||
			$cpf == '77777777777' ||
			$cpf == '88888888888' ||
			$cpf == '99999999999') {
			return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
	} else {

		for ($t = 9; $t < 11; $t++) {

			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}


function consultarPerfil($idusuario) {
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';
	$query = "SELECT *, case(nivel_usuario)
	when 1 then 'Administrador'
	when 2 then 'Funcionario'
	when 3 then 'Visitante'
	end as 'nome_nivel'
	FROM usuario WHERE idusuario = '$idusuario'";
	
	return mysqli_query($conexao, $query);
}


function atualizarPerfil($usuario, $idusuario) {
	include '../model/conexao.php';

    //verificando se já tem alguem cadastrado com o mesmo email
	$email = $usuario['email'];
	$query = $query = "SELECT COUNT(*) as total FROM usuario WHERE email = '$email' and idusuario <> '$idusuario'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo email cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=perfil&update=emailerro&idusuario=' . $idusuario);
		exit();
	}

	//verificando se já tem alguem cadastrado com o mesmo cpf
	$cpf = $usuario['cpf'];
	$query = $query = "SELECT COUNT(*) as total FROM usuario WHERE cpf_usuario = '$cpf' and idusuario <> '$idusuario'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo cpf cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=perfil&update=cpferro&idusuario=' . $idusuario);
		exit();
	}

	$query = 'UPDATE usuario SET '
	. "nome_usuario='" . $usuario['nome'] . "',"
	. "sobrenome='" . $usuario['sobrenome'] . "',"
	. "email='" . $usuario['email'] . "',"
	. "tel_usuario='" . $usuario['telefone'] . "',"
	. "cel_usuario='" . $usuario['celular'] . "',"
	. "cpf_usuario='" . $usuario['cpf'] . "'"
	. " WHERE idusuario = " . $idusuario;

	return mysqli_query($conexao, $query);
}

?>
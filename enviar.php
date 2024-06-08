<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include('conexao.php');

$id_usuario = '1';

if ($_POST["finalizado"] == 1) {

	$pedido = $_POST["pedido"];
	$tipo_pagamento = $_POST["tipo_pagamento"];

	if($tipo_pagamento == 1){ $paga = 'Cartão'; }
	if($tipo_pagamento == 2){ $paga = 'Dinheiro'; }
	if($tipo_pagamento == 3){ $paga = 'PIX'; }

	$result_up = "UPDATE menosmais SET tipo_pagamento = '$tipo_pagamento' WHERE  pedido = '$pedido'  ";
	$resultado_up = mysqli_query($conn, $result_up);
	echo "Finalizado com SUCESSO!";
	echo "<br> Pago com <b>".$paga."</b>";

} else {

	if ($_POST["quantidademais"] == 1) {

		$tipo = $_POST["tipo"];
		$precos = $_POST["precos"];
		$quantidade = '1';
		$pedido = $_POST["numero_pedido"];
		$tipo_pagamento = '0';
	}
	if ($_POST["quantidademenos"] == 1) {

		$tipo = $_POST["tipo"];
		$precos = '-' . $_POST["precos"];
		$quantidade = '-1';
		$pedido = $_POST["numero_pedido"];
		$tipo_pagamento = '0';
	}

	$query = "INSERT INTO menosmais
        VALUES (null,
                '$tipo',
                '$quantidade',
                '$precos',
                '$pedido',
                '$tipo_pagamento',
                '$id_usuario'
				)";

	$query_cadastros = mysqli_query($conn, $query);


	// pegando dados 

	$result_dados = "SELECT 
	SUM(if(tipo = '1', quantidade,0)) as qunt1final, 
	SUM(if(tipo = '1', precos,0)) as preco1final, 
	SUM(if(tipo = '2', quantidade,0)) as qunt2final,
	SUM(if(tipo = '2', precos,0)) as preco2final, 
	SUM(if(tipo = '3', quantidade,0)) as qunt3final,
	SUM(if(tipo = '3', precos,0)) as preco3final,  
	id, tipo, quantidade, pedido 
	                 FROM menosmais
					 WHERE pedido = '$pedido' ";

	$resultado_dados = mysqli_query($conn, $result_dados);

	while ($row_events = mysqli_fetch_array($resultado_dados)) {
		$id = $row_events['id'];
		$tipo = $row_events['tipo'];
		$quantidade = $row_events['quantidade'];
		$pedido = $row_events['pedido'];

		$quantidade_final1 = $row_events['qunt1final'];
		$precos_final1 = $row_events['preco1final'];

		$quantidade_final2 = $row_events['qunt2final'];
		$precos_final2 = $row_events['preco2final'];

		$quantidade_final3 = $row_events['qunt3final'];
		$precos_final3 = $row_events['preco3final'];

		$totalGeral = $precos_final1 + $precos_final2 + $precos_final3;



		// echo json_encode($eventos);


		// echo 'Refrigerantes ' . $quantidade_final1;
		// echo '<br>Total Refrigerantes = ' . $precos_final1;
		// echo '<br>Comidas ' . $quantidade_final2;
		// echo '<br>Total Comidas ' . $precos_final2;
		// echo '<br>Diversão ' . $quantidade_final3;
		// echo '<br>Total Diversão ' . $precos_final3;
		// echo "<hr><b class='text-danger'>TOTAL = " . $totalGeral;
		// echo "</b><br>";

		$pedidos = array(
			"quantidade_final1" => $quantidade_final1,
			"precos_final1" => $precos_final1,
			"quantidade_final2" => $quantidade_final2,
			"precos_final2" => $precos_final2,
			"quantidade_final3" => $quantidade_final3,
			"precos_final3" => $precos_final3,
			"totalGeral" => $totalGeral
			);


		echo json_encode($pedidos) ;
	}
}

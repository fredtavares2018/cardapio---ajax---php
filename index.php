<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include('conexao.php');

$id_usuario = '1';

$result_nasc = "SELECT * FROM usuarios WHERE id = '$id_usuario' ";
$resultado_nasc = mysqli_query($conn, $result_nasc);
$row_nasc = mysqli_fetch_array($resultado_nasc);

$result_NOVO_PEDIDO = "SELECT * FROM menosmais ORDER BY id desc LIMIT 1";
$resultado_NOVO_PEDIDO = mysqli_query($conn, $result_NOVO_PEDIDO);
$row_novo_pedidos = mysqli_num_rows($resultado_NOVO_PEDIDO);
$row_novo_pedido = mysqli_fetch_array($resultado_NOVO_PEDIDO);

if ($row_novo_pedidos == '0') {
	$row_novo_pedido1 = '1';
} else {
	$row_novo_pedido1 = $row_novo_pedido['id'];
}

$numero_pedido = $row_novo_pedido1 . $row_nasc['senha'];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cardápio Simples</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>

	<style>
		.calculadora {
			margin-top: 40px;
			border: solid 1px #000;
			padding: 20px;
			background-color: #2E2E2E;
			border-radius: 10px;
			box-shadow: 1px 1px 5px #000;
		}

		.bots {
			width: 60px;
			height: 50px;
			margin: 5px;
			box-shadow: 1px 1px 1px #000;
		}

		.clear {
			width: 130px;
		}

		.enter {
			height: 110px;
		}

		.zero {
			width: 130px;
		}

		.resultado {
			text-align: right;
			font-size: 20px;
			margin-top: 10px;
			margin-bottom: 20px;
			border: solid 1px #000;
			box-shadow: 1px 1px 1px #000;
		}


		.aumentando {
			font-size: 30px
		}
	</style>

</head>


<body>

	<div class="container">

		<div class="row mt-1 bg-dark">
			<div class="col-8">
				<h2 class="h2 mt-2 margem text-white">Cardápio - Geral</h2>
			</div>
			<div class="col-4 text-center mt-2">
				<a type="button" href="index.php" data-toggle="modal" data-target="#NOVOPED" class="btn-warning form-control">Novo</a>
			</div>
			<!-- The Modal Certeza -->
			<div class="modal" id="NOVOPED">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header bg-warning">
							<h4 class="modal-title text-white">Novo Pedido</h4>
						</div>

						<!-- Modal body -->
						<div class="modal-body text-center">

							<p>Deseja REALMENTE NOVO PEDIDO? </p>
							<p>Já FINALIZOU? </p>

							<a type="button" href="index.php" class="btn-warning form-control">SIM, NOVO</a>

						</div>

					</div>
				</div>
			</div>
		</div>

		<hr>


		<h5>SEU PEDIDO - <?php echo $numero_pedido; ?></h5>
		<div class="alert" id="alert" role="alert"></div>

		<div>Bebida(s) = <span id="resultados1"></span></div>
		<div>Total Bebida(s) = <span id="resultados2"></span></div>
		<div>Alimento(s) = <span id="resultados3"></span></div>
		<div>Total Alimento(s) = <span id="resultados4"></span></div>
		<div>Lazer(es) = <span id="resultados5"></span></div>
		<div>Total Lazer(es) = <span id="resultados6"></span></div>
		<hr>
		<div>
			<h3>Total = <span id="resultados7"></span></h3>
		</div>


		<br>
		<form id="name_form">
			<h4>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pag" id="pag1" value="1" />
					<label class="form-check-label" for="">Cartão</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pag" id="pag2" value="2" data-toggle="modal" data-target="#dinheiro" />
					<label class="form-check-label" for="">Dinheiro</label>

					<!-- The Modal calculadora -->
					<div class="modal" id="dinheiro">
						<div class="modal-dialog">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header bg-warning">
									<h4 class="modal-title">Calculadora Troco</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									<div class="container">
										<div class="row">
											<div class="col-6">
												<label for="">Recebido</label>
												<input id="txt1" type="text" value="" class="form-control  input-lg aumentando" onblur='calcular()' />
											</div>
											<div class="col-6">
												<label for=""><b class="text-danger">não digitar</b></label>
												<span id='resultados8'></span>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-6">
												<h2>TROCO</h2>
											</div>
											<div class="col-6">
												<h2 class="text-danger"><span id="mostrar"></span></h2>
											</div>
										</div>
									</div>


								</div>


							</div>
						</div>
					</div>
					<script>
						function calcular() {

							var valor1 = parseFloat(document.getElementById('txt1').value, 10);
							var valor2 = parseFloat(document.getElementById('txt2').value, 10);
							document.getElementById('mostrar').innerHTML = valor1 - valor2;

						}
					</script>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pag" id="pag3" value="3" data-toggle="modal" data-target="#pix" />
					<label class="form-check-label" for="">PIX</label>

					<!-- The Modal calculadora -->
					<div class="modal" id="pix">
						<div class="modal-dialog">
							<div class="modal-content ">

								<!-- Modal Header -->
								<div class="modal-header bg-warning">
									<h4 class="modal-title">QRCODE - PIX</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									<div class="container">
										<div class=" text-center" >

											<label for="">Scanei com seu celular</label>
											<img src="pagamento.jpeg" class="img-fluid " alt="">

										</div>
										<hr>
										<div class="text-center">

											<h2>PIX CATEDRAL</h2>

										</div>
									</div>


								</div>


							</div>
						</div>
					</div>
				</div>
			</h4>
			<hr><br>

			<button type="button" id="submit" class="btn-primary form-control text-center">
				<h4><b>SEMPRE Finalizar</h4></b>
			</button>

		</form>

		<hr><br><br>

		<?php

		$result_produtos = "SELECT * FROM produtos ORDER BY tipo asc";

		$resultado_produtos = mysqli_query($conn, $result_produtos);

		while ($row_produtos = mysqli_fetch_array($resultado_produtos)) {

			$nome = $row_produtos['nome'];
			$tipo = $row_produtos['tipo'];
			$preco = $row_produtos['preco'];

		?>
			<form id='zerando'>
				<div class="row">
					<div class="col-12 text-center" data-value="<?php echo $preco; ?>" id="preco">
						<h4><b><?php echo $nome . ' - R$' . $preco; ?></b></h4>
					</div>
					<div class="col-12 quantity" data-value="<?php echo $tipo; ?>" id="tipo">
						<div class="row">
							<div class="col-3"><button class="plus-btn form-control btn-primary" type="button" name="button"> +
								</button>
							</div>
							<div class="col-6"><input type="text" value="0" id="input" class="form-control input-lg aumentando" /></div>
							<div class="col-3"><button class="minus-btn form-control btn-danger" type="button" name="button"> -
								</button>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</form>

		<?php } ?>

		<hr>
		<p class="text-center"><small>Cortesia para Catedral Nossa Senhora de Nazaré - AC</small></p>

		<footer class="main-footer text-center">
			<small>
				<strong>Copyright &copy; 2024-<?php echo date('Y'); ?> <b>Version</b> 1.0 <br>Frederico de Oliveira Tavares.</strong>
			</small>
		</footer>

	</div>



</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#submit').click(function() {

			if (($("#pag1").prop("checked"))) {
				var tipo_pg = $('#pag1').val();
			}
			if (($("#pag2").prop("checked"))) {
				var tipo_pg = $('#pag2').val();
			}
			if (($("#pag3").prop("checked"))) {
				var tipo_pg = $('#pag3').val();
			}



			$('#alert').html('');

			$.ajax({
				url: 'enviar.php',
				method: 'POST',
				data: {
					finalizado: '1',
					pedido: <?php echo $numero_pedido; ?>,
					tipo_pagamento: tipo_pg
				},
				success: function(result) {
					$('form').trigger("reset");
					$('#alert').addClass("alert-success");
					$('#alert').fadeIn().html(result);
				}
			});
		});
	});


	const minusButtons = document.querySelectorAll('.minus-btn');
	const plusButtons = document.querySelectorAll('.plus-btn');
	const tipos = document.querySelectorAll('#tipo');
	const precos = document.querySelectorAll('#preco');
	const inputFields = document.querySelectorAll('.quantity input');

	for (let i = 0; i < minusButtons.length; i++) {
		minusButtons[i].addEventListener('click', function minusProduct() {

			if (inputFields[i].value) {
				var menos = inputFields[i].value--;

				var tipospego = tipos[i].getAttribute('data-value');
				var precospego = precos[i].getAttribute('data-value');
				//console.log(tipospego, minusButtons[i])

				if (menos < 0) {
					menos = 0;
				}

			}

			$.ajax({
				url: 'enviar.php',
				method: 'POST',
				data: {
					quantidademenos: '1',
					tipo: tipospego,
					precos: precospego,
					numero_pedido: <?php echo $numero_pedido; ?>,
					finalizado: 0
				},
				success: function(result) {
					var arr = $.parseJSON(result);

					document.getElementById('resultados1').innerHTML = arr['quantidade_final1'];
					document.getElementById('resultados2').innerHTML = arr['precos_final1'];
					document.getElementById('resultados3').innerHTML = arr['quantidade_final2'];
					document.getElementById('resultados4').innerHTML = arr['precos_final2'];
					document.getElementById('resultados5').innerHTML = arr['quantidade_final3'];
					document.getElementById('resultados6').innerHTML = arr['precos_final3'];
					document.getElementById('resultados7').innerHTML = arr['totalGeral'];
				}
			});

		});
	}


	for (let i = 0; i < minusButtons.length; i++) {
		plusButtons[i].addEventListener('click', function plusProduct() {


			var mais = inputFields[i].value++;

			var tipospego = tipos[i].getAttribute('data-value');
			var precospego = precos[i].getAttribute('data-value');
			//console.log(tipospego, plusButtons[i])

			if (mais == 0) {
				mais = 1;
			}

			$.ajax({
				url: 'enviar.php',
				method: 'POST',
				data: {
					quantidademais: '1',
					tipo: tipospego,
					precos: precospego,
					numero_pedido: <?php echo $numero_pedido; ?>,
					finalizado: 0
				},
				success: function(result) {

					var arr = $.parseJSON(result);

					document.getElementById('resultados1').innerHTML = arr['quantidade_final1'];
					document.getElementById('resultados2').innerHTML = arr['precos_final1'];
					document.getElementById('resultados3').innerHTML = arr['quantidade_final2'];
					document.getElementById('resultados4').innerHTML = arr['precos_final2'];
					document.getElementById('resultados5').innerHTML = arr['quantidade_final3'];
					document.getElementById('resultados6').innerHTML = arr['precos_final3'];
					document.getElementById('resultados7').innerHTML = arr['totalGeral'];

					document.getElementById('resultados8').innerHTML = "<input id='txt2' type='text' class='form-control input-lg aumentando' value='" + arr['totalGeral'] + "'  />";


					// console.log('voltou', result)
					// console.log('voltou1', arr)
					// console.log('voltou1', arr['chave2'])


				}
			});
		});
	}
</script>
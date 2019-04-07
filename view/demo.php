<?php
	require_once('globais.php');
	require_once('jogadas.php');
	require_once('conexao.php');
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Jogo da Velha</title>
</head>
<body>
    <div class="container">
		<div class="row">
			<h1>JOGO DA VELHA</h1>
		</div>
        <div class="row">
            <label>Dificuldade: </label>
			<select id="sel1" name="TB_JOGOS['JGO_DIFICULDADE']" requirie>
                <option value="0">-Selecione-</option>
                <option value="1">Iniciante</option>
                <option value="2">Normal</option>
                <option value="3">Dificil</option>
    		</select>
        </div>
    </div>
    <div class="container">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td id="11">&nbsp</td>
					<td id="12">&nbsp</td>
					<td id="13">&nbsp</td>
				</tr>
				<tr>
					<td id="21">&nbsp</td>
					<td id="22">&nbsp</td>
					<td id="23">&nbsp</td>
				</tr>
				<tr>
					<td id="31">&nbsp</td>
					<td id="32">&nbsp</td>
					<td id="33">&nbsp</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="container">
		<a id="desistir" href="desistir.html" class="btn btn-info" role="button">Desistir</a>
	</div>
    <script>
		$(document).ready(function(){
			$('desistir').click(function(){
				finalizar_jogo('D');
			});
			$('#sel1').change(function(){
				$nivel = $(this).val();
				novo_jogo_bd($nivel);
				$('#sel1').prop('disabled','disabled');
				alert("Olá! Para modificar a dificuldade vc terá que desistir da partida.");
			});
			$("#11").click(function(){
				$("#11").html("<i class='fas fa-user'></i>");
                lance_bd('H', '11');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#12").click(function(){
				$("#12").html("<i class='fas fa-user'></i>");
                lance_bd('H', '12');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#13").click(function(){
				$("#13").html("<i class='fas fa-user'></i>");
                lance_bd('H', '13');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#21").click(function(){
				$("#21").html("<i class='fas fa-user'></i>");
                lance_bd('H', '21');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#22").click(function(){
				$("#22").html("<i class='fas fa-user'></i>");
                lance_bd('H', '22');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#23").click(function(){
				$("#23").html("<i class='fas fa-user'></i>");
                lance_bd('H', '23');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#31").click(function(){
				$("#31").html("<i class='fas fa-user'></i>");
                lance_bd('H', '31');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#32").click(function(){
				$("#32").html("<i class='fas fa-user'></i>");
                lance_bd('H', '32');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
			$("#33").click(function(){
				$("#33").html("<i class='fas fa-user'></i>");
                lance_bd('H', '33');
				if($final === false){
					computador($nivel);
	                $('"'.$jogada).html("<i class='fas fa-laptop-code'></i>");
				}
			});
		});
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>

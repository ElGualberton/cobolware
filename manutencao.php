<?php require_once 'config.php'; ?>
<?php
	//$chave = $_GET(['id']);
	//$tp = $_GET(['tipo']);
	$sistema = 'SALVUM - EI v1.0.0.17';
	// echo var_dump($_GET);
	$cod = $_GET['id']; 
	exec('cwmenu /r:PHPCAD01 ' . $_GET['tipo'] . $_GET['id'] . ' /d:c:\uso\arq /c:c:\cobolware\cil');
	$arqJson = 'FileName.json';
?>
<?php include(HEADER_TEMPLATE); ?>

<div class="container-fluid">
	<button type="button" class="btn btn-primary float-right" id="btnnovo" data-toggle="button" aria-pressed="false" autocomplete="off">
		<i class="fas fa-plus"></i> Novo Registro
	</button>	
	<form accept-charset="utf-8">
		<hr />
		<div class="row">
			<div class="form-group col-md-2">
				<label for="name">Código</label>
				<input type="number"
					id="codigo" 
					class="form-control" 
					name="codigo" 
					min="1"
					step="1" 
					max="99999"
					value=""
					<?php if($cod != '00000'){echo 'disabled';}?> 
					>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="name">Descrição</label>
				<input type="text"
					id="descricao" 
					class="form-control" 
					name="descricao" 
					value="">
					<!--require>-->
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<label for="name">Valor</label>
				<input type="number" 
					class="form-control"
					id="valor" 
					name="valor"
					min="0.01"
					step="0.01" 
					max="99999999.99"
					value="">
			</div>
		</div>
		<div class="row">	
			<div class="form-group col-md-4">
				<label for="campo2">Tipo: </label> 
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="peca" id="PECA" value="option1">
					<label class="form-check-label" for="inlineRadio1">Peça</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="acabado" id="ACABADO" value="option2">
					<label class="form-check-label" for="inlineRadio2">Acabado</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="material" id="MATERIAL" value="option3">
					<label class="form-check-label" for="inlineRadio3">Material</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="IMPORTADO" value="option1">
					<label class="form-check-label" for="inlineCheckbox1">Importado</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="GARANTIA" value="option2">
					<label class="form-check-label" for="inlineCheckbox2">Garantia</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="DURAVEL" value="option3">
					<label class="form-check-label" for="inlineCheckbox3">Durável</label>
				</div>	
			</div>
		</div>
	</form>
	<div id="actions" class="row">
		<div class="col-md-12">
			<button id="salvar" class="btn btn-primary" data-toggle="modal" data-target="#modalConfirma">Salvar</button>
			<button id="apagar" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirma">Apagar</button>
			<!--a href="deleta.php?id=<?php //echo $_GET['id']?>" id="apagar" class="btn btn-danger">Apagar</a-->
			<a href="inicio.php" class="btn btn-default">Cancelar</a>
		</div>
	</div>
</div>

<div class="modal fade" id="modalConfirma" tabindex="-1" role="dialog" aria-labelledby="modalConfirmaLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="h5tituloodal" class="modal-title" id="modalConfirmaLabel">Confirma Alteração?</h5>
			</div>
			<!--div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Recipient:</label>
						<input type="text" class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Message:</label>
						<textarea class="form-control" id="message-text"></textarea>
					</div>
				</form>
			</div-->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancela</button>
				<a href="manutencao.php?id=00070&tipo=A" id="lnkModal" type="button" class="btn btn-primary">Confirma</a>
			</div>
		</div>
	</div>
</div>

<?php if($_GET['tipo'] == "A") : ?>
<div class="modal fade text-center" 
     id="modalManutencao" 
	 tabindex="-1" 
	 role="dialog" 
	 aria-labelledby="modalManutencaoLabel" 
	 aria-hidden="true"
	 data-backdrop="static"
	>
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="h5OperacoesModal" class="modal-title text-center" id="modalManutencaoLabel">Operações:</h5>
			</div>
			<div class="modal-body">
				<div id="grupoBotoesManutencao" class="btn-group-vertical" role="group" aria-label="Basic example">
					<button Id="Consulta" data-dismiss="modal" type="button" class="btn btn-secondary">Consulta</button>
					<button Id="Inclusão" data-dismiss="modal" type="button" class="btn btn-secondary">Inclusão</button>
					<button Id="Alteração" data-dismiss="modal" type="button" class="btn btn-secondary">Alteração</button>
					<button Id="Exclusão" data-dismiss="modal" type="button" class="btn btn-secondary">Exclusão</button>
					<button Id="VoltaPagina" data-dismiss="modal" type="button" class="btn btn-secondary">Pagina Principal</button>
				</div>			
			</div>
			<div class="modal-footer">
			
			<!--div class="alert alert-success" role="alert">
				<h4 class="alert-heading">Well done!</h4>
				<p>
					Aww yeah, you successfully read this important alert message. 
					This example text is going to run a bit longer so that you can 
					see how spacing within an alert works with this kind of content.
				</p>
				<hr>
				<p class="mb-0">
					Whenever you need to, be sure to use margin utilities to keep things nice and tidy.
				</p>
			</div-->			
			
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<script>
<?php if($_GET['tipo'] == "A") : ?>
$(document).ready(function(){
		$('#modalManutencao').modal('show');
});

<?php endif; ?>

	$('#codigo').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			let codigo = document.getElementById("codigo").value.padStart(5, "0");
			window.location.href = 'manutencao.php?id=' + codigo + '&tipo=A';
		}
	});
	$('#btnnovo').on( 'click', function() {
		document.getElementById("codigo").value = 00000;
		document.getElementById("codigo").disabled = true;
		document.getElementById("descricao").value = '';
		document.getElementById("valor").value = 0.00;
		document.getElementById("PECA").checked = false;
		document.getElementById("ACABADO").checked = false;
		document.getElementById("MATERIAL").checked = false;
		document.getElementById("IMPORTADO").checked = false;
		document.getElementById("GARANTIA").checked = false;
		document.getElementById("DURAVEL").checked = false;
	});
	$('#apagar').on( 'click', function() {
		let codigo = document.getElementById("codigo").value
		let params = '?id=' + codigo
		console.log('deleta.php' + params);
		$("#h5tituloodal").html("Confirma Exclusão?");
		$('#lnkModal').attr('href', 'deleta.php' + params);
	});
	$('#salvar').on( 'click', function() {
		let iouser;
		if(document.getElementById("codigo").value == 00000){
			iouser = "W";
		} else {
			iouser = "R"
		}
		let codigo = document.getElementById("codigo").value.padStart(5, "0");
		let descricao = document.getElementById("descricao").value
		let valor = document.getElementById("valor").value.replace(",", ".").padStart(11, "0");
		let tipo 
		if(document.getElementById("PECA").checked){
			tipo = 1
		}
		if(document.getElementById("ACABADO").checked){
			tipo = 2
		}
		if(document.getElementById("MATERIAL").checked){
			tipo = 3
		}
		let imortado = 0;
		if (document.getElementById("IMPORTADO").checked) {
			importado = 1;
		} else {
			importado = 0;
		}
		let garantia = 0;
		if (document.getElementById("GARANTIA").checked) {
			garantia = 1;
		} else {
			garantia = 0;
		}
		let duravel = 0;
		if (document.getElementById("DURAVEL").checked) {
			duravel = 1;
		} else {
			duravel = 0;
		}
		let params = '?iouser=' + iouser + '&id=' + codigo + '&descricao="' + descricao + '"&valor=' + valor + '&tipo=' + tipo + '&importado=' + importado + '&garantia=' + garantia + '&duravel=' + duravel;
		console.log(params);
		console.log('atualiza.php' + params);
		if(codigo == 00000){
			$("#h5tituloodal").html("Confirma Inclusão?");
		} else {
			$("#h5tituloodal").html("Confirma Alteração?");
		}
		$('#lnkModal').attr('href', 'atualiza.php' + params)
	});
	buscarDados()
	async function buscarDados () {
		try {
			var localj = '<?php echo $arqJson; ?>'
			obj = await fetch(localj).then(res => res.json()).then(data => data);
			//console.log('obj: ', obj);
			//console.log('TIPO ' + obj.FileName[0].TIPO)
			//console.log('importado ' + obj.FileName[0].IMPORTADO)
			//console.log('GARANTIA ' + obj.FileName[0].GARANTIA)
			//console.log('DURAVEL ' + obj.FileName[0].DURAVEL)
			if(obj.FileName[0].CODIGO == 00000){
				if(obj.FileName[0].DESCRICAO.trim() != ''){
					alert(obj.FileName[0].DESCRICAO.trim())
				}
			} else { 
				document.getElementById("codigo").value = obj.FileName[0].CODIGO;
				document.getElementById("descricao").value = obj.FileName[0].DESCRICAO.trim();
				document.getElementById("valor").value = obj.FileName[0].PRECO.trim();
				str = document.getElementById("valor").value.replace(",", ".").padStart(11, "0");
				console.log(str);
				if (obj.FileName[0].TIPO == '1') {
					document.getElementById("PECA").checked = true;
				} 
				if (obj.FileName[0].TIPO == '2') {
					document.getElementById("ACABADO").checked = true;
				} 
				if (obj.FileName[0].TIPO == '3') {
					document.getElementById("MATERIAL").checked = true;
				} 
				if (obj.FileName[0].IMPORTADO == 1) {
					document.getElementById("IMPORTADO").checked = true;
				} else {
					document.getElementById("IMPORTADO").checked = false;
				}
				if (obj.FileName[0].GARANTIA == 1) {
					document.getElementById("GARANTIA").checked = true;
				} else {
					document.getElementById("GARANTIA").checked = false;
				}
				if (obj.FileName[0].DURAVEL == 1) {
					document.getElementById("DURAVEL").checked = true;
				} else {
					document.getElementById("DURAVEL").unchecked = true;
				}
			} 
		} catch (error) {
			throw error
		}
	}
	function rewriteFileName(){
		console.log('rewriteFiLeName')
		var r = confirm("Confirma Alteração?");
		if (r == true) {
			alert('sim')
		} else {
			alert('nao')
		}
	}
	function deletefiLename(){
		console.log('deleteFiLeName')
		var x = confirm("Confirma Alteração?");
		if (x == true) {
			window.location.href = './ler.php';
		} else {
			window.location.href = './ler.php';
		}
	}
</script>

<?php include(FOOTER_TEMPLATE); ?>
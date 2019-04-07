<?php require_once 'config.php'; ?>
<?php 
	$sistema = 'SALVUM - EI v1.0.0.17';
    exec('cwmenu /r:PHPCAD01 A00011 /d:c:\uso\arq /c:c:\cobolware\cil');
	$arqJson = 'FileName.json';
?>
<?php include(HEADER_TEMPLATE); ?>

<div class="container-fluid">
	<form accept-charset="utf-8" action="edit.php?id=<?php echo $cxsimples_tipo['cxs_tipo_id'];?>" method="post">
		<hr />
		<div class="row">
			<div class="form-group col-md-2">
				<label for="name">Código</label>
				<input type="number"
					id="codigo" 
					class="form-control" 
					name="codigo" 
					value="">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="name">Descrição</label>
				<input type="text"
					id="descricao" 
					class="form-control" 
					name="cxsimples_tipo['cxs_tipo_descricao']" 
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
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="PECA" value="option1">
					<label class="form-check-label" for="inlineRadio1">Peça</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="ACABADO" value="option2">
					<label class="form-check-label" for="inlineRadio2">Acabado</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="MATERIAL" value="option3">
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
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="index.php" class="btn btn-default">Cancelar</a>
			</div>
		</div>
	</form>
</div>



<div class="container-fluid text-center col-sm-4 col-md-4 col-xs-4 col-lg-4 mb-3">
	<form class="">
	</form>
</div>

<script>
	async function buscarDados () {
		try {
			var localj = '<?php echo $arqJson; ?>'
			obj = await fetch(localj).then(res => res.json()).then(data => data);
			console.log('obj: ', obj);
			console.log('Primeiro codigo ' + obj.FileName[0].CODIGO)
			console.log('Lista Tamanho ' + obj.FileName.length)
			var i;
			var t = obj.FileName.length;
			console.log(t);
			document.getElementById("codigo").value = obj.FileName[0].CODIGO;
			document.getElementById("descricao").value = obj.FileName[0].DESCRICAO;
			document.getElementById("preco").value = obj.FileName[0].PRECO;
			
			//var tab = document.getElementById("caixa"); 
			//for(i = 0; i < obj.FileName.length; i++){
			//	t = i + 1;
			//	var row = tab.insertRow(i);
			//	var cel1 = row.insertCell(0);
			//	var cel2 = row.insertCell(1);
			//	var cel3 = row.insertCell(2);
			//}
		} catch (error) {
			throw error
		}
	}
	buscarDados()
</script>

<?php include(FOOTER_TEMPLATE); ?>
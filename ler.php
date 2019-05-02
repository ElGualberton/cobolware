<?php require_once 'config.php'; ?>
<?php 
	$sistema = 'SALVUM - EI v1.0.0.17';
	$linkage = 'O';
	exec('cwmenug /r:PHPCAD02 /d:c:\uso\arq /c:c:\cobolware\cil');
	$arqJson = 'FileName.json';
?>
<?php include(HEADER_TEMPLATE); ?>

<div class="container-fluid text-center ">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">Codigo</th>
				<th scope="col">Descrição</th>
				<th scope="col">Valor</th>
			</tr>
		</thead>
		<tbody id="caixa">
		</tbody>
	</table>

</div>

<script>
	async function buscarDados () {
		try {
			var localj = '<?php echo $arqJson; ?>'
			console.log(localj)
			obj = await fetch(localj).then(res => res.json()).then(data => data);
			console.log('obj: ', obj);
			console.log('Primeiro codigo ' + obj.FileName[0].CODIGO)
			console.log('Lista Tamanho ' + obj.FileName.length)
			var i;
			var t = obj.FileName.length;
			console.log(t);
			var tab = document.getElementById("caixa"); 
			for(i = 0; i < obj.FileName.length; i++){
				t = i + 1;
				var row = tab.insertRow(i);
				var cel1 = row.insertCell(0);
				var cel2 = row.insertCell(1);
				var cel3 = row.insertCell(2);
				cel1.innerHTML = obj.FileName[i].CODIGO;
				cel2.innerHTML = '<a href="manutencao.php?id=' + obj.FileName[i].CODIGO + '&tipo=A">' + obj.FileName[i].DESCRICAO + '</a>';
				cel3.innerHTML = obj.FileName[i].PRECO;
			}
		} catch (error) {
			throw error
		}
	}
	buscarDados()
</script>

<?php include(FOOTER_TEMPLATE); ?>
<?php require_once 'config.php'; ?>
<?php $sistema = 'SALVUM - EI v1.0.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php
    $url = 'FileName.json';
	echo $url . '<br>';
	$content = file_get_contents($url);
	$content = utf8_encode($content);
	echo $content . '<br>';
	$ok = true;
	$obj = json_decode($content, $ok);
	echo $ok . '<br>';
	echo $obj . '<br>';
	echo var_dump($obj);
    //foreach($obj['data']['FileName'] as $item) {
        //echo $item['CODIGO'];
        //print $item['weatherDesc'][0]['value'];
        //print ' - ';
        //print '<br>';
    //};
 
?>
<div class="container-fluid text-center">
	<h1>Teste de Trabalho Conjunto PHP/COBOLware </h1>
	<div class="card-group">
		<div class="card bg-primary mb-3 col-sm-4 col-md-4 col-xs-4 col-lg-4 h4">
			<a class="text-white" href="ler.php">
				<div class="card-body">
					<div class="card-title">Consulta</div>
					<div class="card-text"><i class="fas fa-users"></i></div>
				</div>
			</a>
		</div>
		<div class="card bg-secondary mb-3 col-sm-4 col-md-4 col-xs-4 col-lg-4 h4">
			<a class="text-white" href="manutencao.php?id=00000&tipo=A">
				<div class="card-body">
					<div class="card-title">Manutenção</div>
					<div class="card-text"><i class="fas fa-user"></i></div>
				</div>
			</a>
		</div>
		<div class="card bg-success mb-3 col-sm-4 col-md-4 col-xs-4 col-lg-4 h4">
			<a class="text-white" href="relatorio.php">
				<div class="card-body">
					<div class="card-title">PDF</div>
					<div class="card-text"><i class="fas fa-chalkboard"></i></div>
				</div>
			</a>
		</div>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
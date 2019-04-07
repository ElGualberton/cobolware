<?php require_once 'config.php'; ?>
<?php $sistema = 'SALVUM - EI v1.0.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

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
			<a class="text-white" href="manutencao.php">
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
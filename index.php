<?php 
	session_start(); 
	exec('cobware.bat');
?>

<?php require_once 'config.php'; ?>
<?php include(HEADER_TEMPLATE); ?>

<main class="container">

<img src="https://storage.googleapis.com/salvum-imagens/logo-transparente.gif" 
	class="img-responsive text-center" 
	width=50% height=50%>
<h1>Colégio <?php echo $empresa;?></h1>
<hr />

<form action="logar.php" method="post">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
		<input type="text" class="form-control" name="usuario_email" placeholder="Email" required>
	</div>
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
		<input type="password" class="form-control" name="usuario_senha" placeholder="Senha" required>
	</div>
	<br>
	<div id="actions" class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">Entrar</button>
			<a href="index.php" class="btn btn-default">Cancelar</a>
			<a class='btn btn-info' href="https://api.whatsapp.com/send?phone=5511952189891&text=Estou%20na%20tela%20de%20Login"> Precisa de ajuda? </a>
		</div>
	</div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
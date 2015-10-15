
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<title>Panel de Administracion</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>

<body>
	<header>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-menu">
						<span class="sr-only">Desplegar / Ocultar menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand"> Admin Panel</a>
				</div>
				<div class="collapse navbar-collapse" id="navegacion-menu">
					<ul class="nav navbar-nav">
						<li   class="active"><a href="#">Inicio</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
							Usuarios <span class="caret"></span>	
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Consultar</a></li>
								<li class="divider"></li>	
								<li><a href="#">Alta</a></li>
								<li class="divider"></li>
								<li><a href="#">Baja</a></li>
								<li class="divider"></li>
								<li><a href="#">Modificacion</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
							Roles <span class="caret"></span>	
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Consultar</a></li>
								<li class="divider"></li>	
								<li><a href="#">Alta</a></li>
								<li class="divider"></li>
								<li><a href="#">Baja</a></li>
								<li class="divider"></li>
								<li><a href="#">Modificacion</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
							Paginas <span class="caret"></span>	
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Consultar</a></li>
								<li class="divider"></li>	
								<li><a href="#">Alta</a></li>
								<li class="divider"></li>
								<li><a href="#">Baja</a></li>
								<li class="divider"></li>
								<li><a href="#">Modificacion</a></li>
							</ul>
						</li>
						</ul>

						<form action="" class="navbar-form navbar.right" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="buscar">
							</div>
							<button type="submit" class='btn btn-primary'>
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</form>
				</div>
			</div>
		</nav>
	</header>

			<section class="jumbotron">
				<div class="container">
					<h1>Panel de administracion web</h1>
					<p> Grupo 5</p>
				</div>
			</section>
	<section class="main container"></section>
	<footer></footer>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
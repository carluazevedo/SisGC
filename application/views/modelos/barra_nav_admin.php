<header>
	<nav class="navbar navbar-default navbar-static-top"><!-- navbar-inverse navbar-fixed-top -->
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url('admin'); ?>"><?php echo $this->titulo; ?></a>
			</div><!-- .navbar-header -->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?php echo site_url(); ?>">
							<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Ir para site
						</a>
					</li>
				</ul>

				<div class="navbar-right">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
								<?php echo $this->viagens_model->usuario_atual(); ?> <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Editar perfil</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo site_url('auth/logout'); ?>">Desconectar</a></li>
							</ul>
						</li><!-- .dropdown -->
					</ul>
				</div><!-- .navbar-right -->
			</div><!-- .collapse -->
		</div>
	</nav>
</header><?php echo PHP_EOL; ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<!-- Bootstrap -->
	<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<!-- Bootstrap Theme -->
	<!--<link href="<?php echo base_url('bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<form>
				<div class="form-group">
					<label for="buscar-motorista">CPF ou Nome</label>
					<div class="input-group">
						<input type="text" class="form-control" id="buscar-motorista">
						<span class="input-group-btn">
							<button class="btn btn-primary" type="button" title="Buscar cadastro">
								<span class="glyphicon glyphicon-search small"></span> Buscar
							</button>
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
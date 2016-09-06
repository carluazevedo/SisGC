<section>
	<div class="container">
		<form action="" method="post" id="entrar-sistema" accept-charset="utf-8">
			<h1>Sistema de Gestão de Cargas</h1>
			<p>Entre com seu endereço de email e senha</p>
			<div class="custom-error"><?php echo $message;?></div>
			<div class="form-group">
				<label for="identity" class="control-label sr-only">Email</label>
				<input type="text" id="identity" name="identity" class="form-control input-lg" value="<?php echo set_value('identity'); ?>" placeholder="Email" autofocus />
				<label for="password" class="control-label sr-only">Senha</label>
				<input type="password" id="password" name="password" class="form-control input-lg" placeholder="Senha" />
			</div>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" id="remember" name="remember" value="1" />
					Lembre-me
				</label>
			</div>
			
			<button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Entrar</button>
			
			<p class="form-control-static">
				<a href="forgot_password">Esqueceu sua senha?</a>
			</p>
		</form>
	</div>
</section>
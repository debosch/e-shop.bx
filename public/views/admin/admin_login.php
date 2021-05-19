<link rel="stylesheet" href="../../css/admin/admin_add_style.css">
<div class="container-fluid text-left" >
	<div class="row justify-content-center align-items-start">
		<div class="col-5">
			<h1>Войти в систему</h1>
			<div class="container">
				<?php
				if(!empty($_SESSION['error']))
				{
				?>
					<div class="alert alert-danger" role="alert">
						<? echo $_SESSION['error']?>
					</div>
				<?php
				}
					$_SESSION['error'] = null;
				?>
				<form action="/admin/auth/action" method="post">
					<label for="login"></label><input type="text" class="form-control" name="login" id="login" placeholder="Login"><br>
					<label for="password"></label><input type="password" class="form-control" name="password" id="password" placeholder="Password"><br>
				<button class="btn btn-warning" type="submit">Authorize</button>
				</form>
			</div>
		</div>
	</div>
</div>

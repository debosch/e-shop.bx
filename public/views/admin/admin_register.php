<section class="admin-add">
	<div class="wrap admin-contents__wrap">
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
		<h1 class="header">Регистрация нового пользователя</h1>
		<form action="/admin/register/action" method="post" class="admin-add__form admin-registration__form">
			<div class="form-group admin-registration__group">
				<label for="login admin-add__feature-label">Login</label>
				<input type="text" class="form-control border admin-add__feature-input" name="login" id="login">
				<small class="form-text text-danger feedback admin-add__feature-feedback"></small>
			</div>
			<div class="form-group admin-registration__group">
				<label for="password admin-add__feature-label">Password</label>
				<input type="password" class="form-control border admin-add__feature-input" name="password" id="password"  autocomplete="off">
				<small class="form-text text-danger feedback admin-add__feature-feedback"></small>
			</div>
			<div class="form-group admin-registration__group">
				<label for="confirmPassword admin-add__feature-label">Confirm password</label>
				<input type="password" class="form-control border admin-add__feature-input" name="confirmPassword" id="confirmPassword"  autocomplete="off">
				<small class="form-text text-danger feedback admin-add__feature-feedback"></small>
			</div>
			<div class="custom-control custom-switch mb-3 admin-registration__group">
				<input type="checkbox" class="custom-control-input" id="showPassword" name="showPassword">
				<label class="custom-control-label admin-add__feature-label" for="showPassword">Show password</label>
			</div>
			<button class="btn btn-warning button" type="submit" name="btn" id="btn" disabled>Register</button>
		</form>
	</div>
</section>

<script src="../../js/register.js"></script>
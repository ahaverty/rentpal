<!-- Login form javascript, html template and css taken from http://bootsnipp.com/snippets/z1Bpy -->
<div class="panel panel-login">
	<div class="panel-heading">
		<div class="row">
			<div class="col-xs-6">
				<a href="#" class="active" id="login-form-link">Login</a>
			</div>
			<div class="col-xs-6">
				<a href="#" id="register-form-link">Register</a>
			</div>
		</div>
		<hr>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
			
				<form id="login-form" action="index.php" method="post" role="form" style="display: block;">
					<input id='action' type='hidden' name='action' value='loginUser' />
					<div class="form-group">
						<input type="text" name="fUser" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
					</div>
					<div class="form-group">
						<input type="password" name="fPassword" id="password" tabindex="2" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3">
								<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
							</div>
						</div>
					</div>
				</form>
				
				<form id="register-form" action="index.php" method="post" role="form" style="display: none;">
					<input id='action' type='hidden' name='action' value='insertNewUser' />
					<div class="form-group">
						<input type="text" name="fUsername" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
					</div>
					<div class="form-group">
						<input type="email" name="fEmail" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
					</div>
					<div class="form-group">
						<input type="password" name="fPassword" id="password" tabindex="2" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6 col-sm-offset-3">
								<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
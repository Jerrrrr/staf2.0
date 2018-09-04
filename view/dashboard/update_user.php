<section class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Wijzig <?php echo $user["username"]; ?> </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<form id="demo-form2" data-parsley-validate method="POST" action="index.php?page=update_user&id=<?php echo $_GET['id']; ?>" class="form-horizontal form-label-left">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Naam
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="naam" name="naam" required="required" placeholder="Naam" class="form-control col-md-7 col-xs-12" value="<?php echo $user['username']; ?>">
								<?php if(!empty($errors['naam'])) echo '<span class="error">' . $errors['naam'] . '</span>';?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Rol
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="rol" name="rol" required="required" placeholder="rol" class="form-control col-md-7 col-xs-12">
									<option value="0" <?php if ($user["role"] == 0): echo "selected"; endif; ?> >Staflid</option>
									<option value="1" <?php if ($user["role"] == 1): echo "selected"; endif; ?> >SUPER USER</option>
								</select>
								<?php if(!empty($errors['rol'])) echo '<span class="error">' . $errors['rol'] . '</span>';?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Wachtwoord wijzigen
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="password" id="password" name="password" placeholder="Nieuw wachtwoord" class="form-control col-md-7 col-xs-12">
								<?php if(!empty($errors['password'])) echo '<span class="error">' . $errors['password'] . '</span>';?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Wachtwoord bevestigen
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Bevestig wachtwoord" class="form-control col-md-7 col-xs-12">
								<?php if(!empty($errors['confirmpassword'])) echo '<span class="error">' . $errors['confirmpassword'] . '</span>';?>
							</div>
						</div>
						<input type="submit" value="Wijzig gebruiker" name="action" class="btn btn-success">
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
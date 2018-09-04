<section class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Wijzig gebruiker </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<form id="demo-form2" data-parsley-validate method="POST" action="index.php?page=update_normal" class="form-horizontal form-label-left">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Wachtwoord wijzigen
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="password" name="password" required="required" placeholder="Nieuw wachtwoord" class="form-control col-md-7 col-xs-12">
								<?php if(!empty($errors['password'])) echo '<span class="error">' . $errors['password'] . '</span>';?>
							</div>
						</div>
						<input type="submit" value="Wijzig wachtwoord" name="action" class="btn btn-success">
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
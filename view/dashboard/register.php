<section class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2> Registreer gebruiker </h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />

          <form id="demo-form2" data-parsley-validate method="POST" action="index.php?page=register" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="username" name="username" required="required" placeholder="Username" class="form-control col-md-7 col-xs-12">
                <?php if(!empty($errors['email'])) echo '<span class="error">' . $errors['email'] . '</span>';?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">wachtwoord<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="password" name="password" required="required" placeholder="Password" class="form-control col-md-7 col-xs-12">
                <?php if(!empty($errors['password'])) echo '<span class="error">' . $errors['password'] . '</span>';?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">wachtwoord herhalen<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="confirm_password" name="confirm_password" required="required" placeholder="Password" class="form-control col-md-7 col-xs-12">
                <?php if(!empty($errors['confirm_password'])) echo '<span class="error">' . $errors['confirm_password'] . '</span>';?>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <input type="submit" value="Voeg gebruiker toe" name="add_user" class="btn btn-success">
                <button class="btn btn-primary" type="reset">Reset</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

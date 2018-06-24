<?php

  //login pagina

  $user = '';
  if (isset($_COOKIE['user_tHg4*t?Vrs@3K6#5J4']) && !empty($_COOKIE['user_tHg4*t?Vrs@3K6#5J4'])) {
    $user = $_COOKIE['user_tHg4*t?Vrs@3K6#5J4'];
  }
      //var_dump($_POST);

  if (!empty($user)):

  	//redarect

  else:
?>

<body class="login">

  <?php
      if(!empty($error)) {
          echo '<div class="message message_error ">' . $error . '</div>';
      }
      if(!empty($info)) {
          echo '<div class="message message_info ">' . $info . '</div>';
      }
  ?>
    <div>

    <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <h1>Login</h1>

              <!--
              <div>
                <a class="btn btn-default submit" href="index.php?&page=dashboard">Log in</a>
              </div>
              -->
            <form class="login-form" method="POST" action="index.php?page=login">

              <div class="input-container text">
                  <input type="text" class="form-control" name="username" placeholder="username" required="" />
              </div>
              <div class="input-container text">
                  <input type="password" class="form-control" name="password" placeholder="password" required="" />
              </div>

              <input type="submit" class="btn btn-default submit" value="log in" name="login" />

            </form>


            <div class="clearfix"></div>
            <div class="separator">

              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                <p>&copy; <?php echo date("Y"); ?> <br/>- Speelplein 't Speelakkertje -<br/> staf kinderen inschrijving panel</p>
              </div>
            </div>
          </section>
        </div>

      </div>
    </div>
</body>
<?php endif; ?>

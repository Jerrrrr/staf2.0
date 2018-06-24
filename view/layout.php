<?php

$user = '';

if (isset($_COOKIE['user_tHg4*t?Vrs@3K6#5J4']) && !empty($_COOKIE['user_tHg4*t?Vrs@3K6#5J4'])) {
  $user = $_COOKIE['user_tHg4*t?Vrs@3K6#5J4'];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Speelplein 't speelakkertje! | Kinderen paneel </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/bootstrap/dist/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <?php
    if (empty($user)):

      require 'dashboard/index.php';

    else:
  ?>

  <body class="nav-md ">

    <?php

        if(!empty($error)) {
            echo '<div class="message message_error">' . $error . '</div>';
        }
        if(!empty($info)) {
            echo '<div class="message message_info">' . $info . '</div>';
        }
    ?>

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php?page=dashboard" class="site_title"><i class="fa fa-paw"></i> <span>'t speelakkertje!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/Speelakkertje_logo.png" alt="profile picture" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $user; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php?page=dashboard"><i class="fa fa-home"></i> Home</a>
                    <!-- <ul class="nav child_menu">
                      <li><a href="index.php?page=dashboard">Dashboard</a></li>
                    </ul> -->
                  </li>

                  <li><a><i class="fa fa-edit"></i> weken <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=week">Aanwezigheidslijst</a></li>
                      <li><a href="index.php?page=dagen&jaar=<?php echo date("Y"); ?>">Totaal Week Overzicht</a></li>
                      <li><a href="index.php?page=weken&jaar=<?php echo date("Y"); ?>">Totaal Overzicht</a></li>
                      <li><a href="index.php?page=fiscaal">Fiscale Attesten</a></li>
                    </ul>
                  </li>

                 <!-- <li><a><i class="fa fa-child"></i> Uitstappen<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=uitstappen">Overzicht</a></li>
                      <li><a href="index.php?page=uitstap_edit">Toevoegen</a></li>
                    </ul>
                  </li> -->

                  <li><a><i class="fa fa-table"></i> Gegevens Kinderen<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=kinderen">Alle kinderen</a></li>
                      <li><a href="index.php?page=voegtoe">Kind toevoegen</a></li>
                      <li><a href="index.php?page=ouders">Ouders downlaoden</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i> Staf Leden<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?page=register">Gebruiker Toevoegen</a></li>
                      <li><a href="index.php?page=delete">Gebruiker verwijderen</a></li>
                    </ul>
                  </li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="index.php?page=logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/Speelakkertje_logo.png" alt=""><?php echo $user; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <li><a href="index.php?page=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <?php echo $content; ?>
        <!-- /page content -->

        <!-- footer content -->
        <footer class="footer_fixed">
          <div class="pull-right footer_fixed">
            V. 1.2.1 &copy; <?php echo date("Y"); ?> Speelplein 't Speelakkertje - staf kinderen inschrijving panel
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- jquery.inputmask -->
    <script src="vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <!-- Switchery -->
    <script src="vendors/switchery/dist/switchery.min.js"></script>

  </body>
<?php endif; ?>
</html>

<section class="right_col" role="main">

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2> Gebruiker vewijderen </h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />

          <form class="form-horizontal form-label-left input_mask">
          </ul>
      			<?php foreach ($users as $user): ?>

              <li class="form-group" style="list-style: none;">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="staf">Staf lid:</label>
                <div class="col-md-6 col-sm-5 col-xs-12">
                  <input type="text" id="staf" placeholder="<?php echo $user['username'] ?>" required="required" disabled="disabled" class="form-control col-md-7 col-xs-12" value="<?php echo $user['username'] ?>">
                  <a href="index.php?page=delete&id=<?php echo $user['registratiedatum'] ?>"> Delete user</a>
                </div>
              </li>

      			<?php endforeach; ?>
      			<ul>
            </form>

        </div>
      </div>
    </div>
  </div>

</section>

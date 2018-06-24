<?php

	// kind  = $kind
		$pieces = explode("-", $kind['geboortedatum']);

		$_POST['ID'] = $kind['ID'];
		$_POST['naam'] = $kind['voornaam'];
		$_POST['achternaam'] = $kind['achternaam'];
		$_POST['geslacht'] = $kind['geslacht'];
		$_POST['geboortedatum'] = $kind['geboortedatum'];
		$_POST['alleen_naar_huis'] = $kind['alleen_naar_huis'];
		$_POST['actief'] = $kind['actief'] ;
		$_POST['medische'] = $kind['medische'];
		$_POST['notities'] = $kind['notities'];

		$_POST['PARENT_ID'] = $ouder['ID'];
		$_POST['user_id'] = $ouder['user_id'];
		$_POST['voornaam'] = $ouder['voornaam'];
		$_POST['familienaam'] = $ouder['familienaam'];
		$_POST['functie'] = $ouder['functie'];
		$_POST['tel1'] = $ouder['tel1'];
		$_POST['tel2'] = $ouder['tel2'];
		$_POST['email'] = $ouder['email'];
		$_POST['adres'] = $ouder['adres'];
		$_POST['postcode'] = $ouder['postcode'];
		$_POST['stad'] = $ouder['stad'];

	// ouder = $ouder



?>
<section class="right_col" role="main">

	<?php if(!empty($errors)): ?>
		<div class="x_panel">
	    	<div class="x_title">
	    	  <h2><b class="error" style="color: #BA383C;"> Weizigen gegevens mislukt! </b></h2>
	    	  <ul class="nav navbar-right panel_toolbox">
	    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	    	  </ul>
	    	  <div class="clearfix"></div>
	    	</div>
	    	<div class="x_content">
					<span class="error" style="color: #BA383C;">
						Registratie is mislukt! Er zijn velden leeg of het email adres is ongeldig!
						<?php if(!empty($errors['bestaatal'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['bestaatal']}</p>";?>
						<?php //var_dump($_POST); ?>
					</span>
					<br />
	    	</div>
	    </div>
		<?php endif; ?>


<!-- kind  -->
	<div class="x_panel">
    	<div class="x_title">
    	  <h2><b><?php  echo $kind['voornaam']." ".$kind['achternaam'] ?> </b>weizigen</h2>
    	  <ul class="nav navbar-right panel_toolbox">
    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    	  </ul>
    	  <div class="clearfix"></div>
    	</div>
    	<div class="x_content">
<!-- action="index.php?page=kinderen" -->
          <form method="POST"  id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group" hidden>
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ID">ID <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="ID" name="ID" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['ID'])) echo $_POST['ID'] ?>">
								<span class="error" style="color: #BA383C;"><?php if(!empty($errors['ID'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['ID']}</p>";?></span>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="naam">Voornaam kind <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="naam" name="naam" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['naam'])) echo $_POST['naam'] ?>">
								<span class="error" style="color: #BA383C;"><?php if(!empty($errors['naam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['naam']}</p>";?></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Achternaam kind<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="achternaam" name="achternaam" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['achternaam'])) echo $_POST['achternaam'] ?>">
							 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['achternaam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['achternaam']}</p>";?></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="geslacht">Geslacht<span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div id="geslacht" class="btn-group" data-toggle="buttons">
									<label class="btn btn-primary <?php if (!empty($_POST['geslacht']) && $_POST['geslacht'] == "m"): echo "active"; endif; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										<input type="radio" name="geslacht" value="m" <?php if (isset($_POST['geslacht']) && $_POST['geslacht'] == "m") echo 'checked="checked"' ?> > &nbsp; Jongen &nbsp;
									</label>
									<label class="btn btn-primary <?php if (!empty($_POST['geslacht']) && $_POST['geslacht'] == "v"): echo "active"; endif; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										<input type="radio" name="geslacht" value="v" <?php if (isset($_POST['geslacht']) && $_POST['geslacht'] == "v") echo 'checked="checked"' ?> > Meisje
									</label>
								</div>
								<span class="error" style="color: #BA383C;"><?php if(!empty($errors['geslacht'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['geslacht']}</p>";?></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="geboortedatum">Geboortedatum <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input id="geboortedatum" name="geboortedatum" class="date-picker form-control col-md-7 col-xs-12" data-inputmask="'mask': '99/99/9999'" placeholder="02/02/2005" required="required" type="text" value="<?php if (isset($_POST['geboortedatum'])) echo $_POST['geboortedatum'] ?>">
					 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['geboortedatum'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['geboortedatum']}</p>";?></span>
							</div>
						</div>

						<div class="form-group">
							<label for="medische" class="control-label col-md-3 col-sm-3 col-xs-12">medische opmerkingen (verplicht of "geen")<span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="medische" name="medische" class="form-control col-md-7 col-xs-12" type="text" placeholder="Noten ellergie" value="<?php if (isset($_POST['medische'])) echo $_POST['medische'] ?>">
									<span class="error" style="color: #BA383C;"><?php if(!empty($errors['medische'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['medische']}</p>";?></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Komt dit jaar<span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div id="actief" class="btn-group" data-toggle="buttons">
									<label class="btn btn-primary <?php if (!empty($_POST['actief']) && $_POST['actief'] == "1"): echo "active"; endif; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										<input type="radio" name="actief" value="1" <?php if (isset($_POST['actief']) && $_POST['actief'] == "1") echo 'checked="true"' ?> > &nbsp; Ja &nbsp;
									</label>
									<label class="btn btn-primary <?php if (!empty($_POST['actief']) && $_POST['actief'] == "0"): echo "active"; endif; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										<input type="radio" name="actief" value="0" <?php if (isset($_POST['actief']) && $_POST['actief'] == "0") echo 'checked="true"' ?> > Neen
									</label>
								</div>
								<span class="error" style="color: #BA383C;"><?php if(!empty($errors['actief'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['actief']}</p>";?></span>

							</div>
						</div>

				 <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Opmerkingen</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<textarea name="notities" class="resizable_textarea form-control" placeholder="Mijn kind heeft hooikoorts dit is niet ernstig"><?php if(!empty($_POST['notities'])) echo $_POST['notities']; ?></textarea>
							</div>
					</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								 <button class="btn btn-primary" type="reset">Reset</button>
								 <input type="submit" class="btn btn-success" name="action_update_child" value="Kind Opslaan" class="form-submit" />
							</div>
						</div>

          </form>

    	</div>
    </div>



	<!-- ouder -->

	<div class="x_panel">
			<div class="x_title">
				<h2>Gegevens van <b><?php echo $ouder['voornaam']." ".$ouder['familienaam'] ?></b> weizigen</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

					<form method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group" hidden>
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PARENT_ID">PARENT_ID<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="text" id="PARENT_ID" name="PARENT_ID" placeholder="speelplein@speelakkertje.be" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['PARENT_ID']) && !empty($_POST['PARENT_ID'])):  echo $_POST['PARENT_ID']; endif; ?>" >
								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['PARENT_ID'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['PARENT_ID']}</p>";?></span>

							 </div>
						 </div>

						 <div class="form-group" hidden>
 							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id">user_id<span class="required">*</span>
 							 </label>
 							 <div class="col-md-6 col-sm-6 col-xs-12">
 								 <input type="text" id="user_id" name="user_id" placeholder="speelplein@speelakkertje.be" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['user_id']) && !empty($_POST['user_id'])):  echo $_POST['user_id']; endif; ?>" >
 								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['user_id'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['user_id']}</p>";?></span>

 							 </div>
 						 </div>

						<div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail adres<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="email" id="email" name="email" placeholder="speelplein@speelakkertje.be" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['email']) && !empty($_POST['email'])):  echo $_POST['email']; endif; ?>" >
								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['email'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['email']}</p>";?></span>

							 </div>
						 </div>

						 <div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="voornaam">Voornaam ouder<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="text" id="voornaam" name="voornaam" placeholder="speelplein" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['voornaam'])):  echo $_POST['voornaam']; endif; ?>">
								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['voornaam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['voornaam']}</p>";?></span>

							 </div>
						 </div>

						 <div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12">Familienaam ouder<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="text" id="familienaam" name="familienaam" required="required" placeholder="spelen" for="familienaam"  class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['familienaam'])):  echo $_POST['familienaam']; endif; ?>">
								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['familienaam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['familienaam']}</p>";?></span>

							 </div>
						 </div>
					 <div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="functie">Functie<span class="required">*</span></label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <div id="functie" class="btn-group" data-toggle="buttons">
									 <label class="btn btn-primary <?php if (!empty($_POST['functie']) && $_POST['functie'] == "m"): echo "active"; endif; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										 <input type="radio" name="functie" value="m" <?php if (!empty($_POST['functie']) && $_POST['functie'] == "m"): echo "checked"; endif; ?> > &nbsp; Mama &nbsp;
									 </label>
									 <label class="btn btn-primary <?php if (!empty($_POST['functie']) && $_POST['functie'] == "p"): echo "active"; endif; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										 <input type="radio" name="functie" value="p" <?php if (!empty($_POST['functie']) && $_POST['functie'] == "p"): echo "checked"; endif; ?>> Papa
									 </label>
								 </div>
								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['functie'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['functie']}</p>";?></span>
							 </div>
						 </div>

						 <div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adres">Straat en nummer<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="text" id="adres" name="adres" required="required" placeholder="Sint-josefstraat 10" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['adres'])):  echo $_POST['adres']; endif; ?>">
								 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['adres'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['adres']}</p>";?></span>

							 </div>
						 </div>

						 <div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="postcode">Postcode<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="text" id="postcode" name="postcode"  placeholder="9041" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['postcode'])):  echo $_POST['postcode']; endif; ?>">
								<span class="error" style="color: #BA383C;"><?php if(!empty($errors['postcode'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['postcode']}</p>";?></span>
							 </div>
						 </div>

						<div class="form-group">
							 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stad">Gemeente<span class="required">*</span>
							 </label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input type="text" id="stad" name="stad" required="required" placeholder="Oostakker" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['stad'])):  echo $_POST['stad']; endif; ?>">
								<span class="error" style="color: #BA383C;"><?php if(!empty($errors['stad'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['stad']}</p>";?></span>
							 </div>
						 </div>

						 <div class="form-group">
							 <label for="tel1" class="control-label col-md-3 col-sm-3 col-xs-12">Telefoonnummer<span class="required">*</span></label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
									 <input id="tel1" name="tel1" class="form-control col-md-7 col-xs-12" type="text" placeholder="0477 47 52 09" value="<?php if (isset($_POST['tel1'])):  echo $_POST['tel1']; endif; ?>">
									 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['tel1'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['tel1']}</p>";?></span>
							 </div>
						 </div>

						 <div class="form-group">
							 <label for="tel2" class="control-label col-md-3 col-sm-3 col-xs-12">Nood nummer</label>
							 <div class="col-md-6 col-sm-6 col-xs-12">
									 <input id="tel2" name="tel2" class="form-control col-md-7 col-xs-12" type="text" placeholder="0477 47 52 09" value="<?php if (isset($_POST['tel2'])):  echo $_POST['tel2']; endif; ?>">

							 </div>
						 </div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								 <button class="btn btn-primary" type="reset">Reset</button>
								 <input type="submit" class="btn btn-success" name="action_update_parent" value="Ouder Opslaan" class="form-submit" />
							</div>
						</div>

					</form>

			</div>
		</div>

</section>

<section class="right_col" role="main">
	<div class="x_panel">
    	<div class="x_title">
    	  <h2>Kinderen toevoegen</h2>
    	  <ul class="nav navbar-right panel_toolbox">
    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    	  </ul>
    	  <div class="clearfix"></div>
    	</div>
    	<div class="x_content">
    	<form action="index.php?page=voegtoe" method="get">
    		<button type="button" onclick="location.href='index.php?page=voegtoe&button=nieuw';"    class="btn btn-round btn-primary">Kind toevoegen van een nieuwe ouder</button>
    	  	<button type="button" onclick="location.href='index.php?page=voegtoe&button=bestaand';" class="btn btn-round btn-default">Kind toevoegen van een bestaande ouder</button>
    	</form>
    	</div>
    </div>

	<?php if (isset($nieuw)): ?>

	<div class="x_panel">
    	<div class="x_title">
    	  <h2>Nieuwe ouder toevoegen</h2>
    	  <ul class="nav navbar-right panel_toolbox">
    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    	  </ul>
    	  <div class="clearfix"></div>
    	</div>
    	<div class="x_content">

      <?php if(!empty($errors)): ?>
          <span class="error" style="color: #BA383C;">
            registratie is mislukt! er zijn velden leeg!
            <?php if(!empty($errors['bestaatal'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['bestaatal']}</p>";?>
            <?php //var_dump($_POST); ?>
          </span>
          <?php endif; ?>
           <br />

          <form method="POST" action="index.php?page=voegtoe&button=nieuw" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail adres<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="email" id="email" name="email" placeholder="speelplein@speelakkertje.be" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['email']) && !empty($_POST['email'])):  echo $_POST['email']; endif; ?>" >
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['email'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['email']}</p>";?></span>

               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="voornaam">voornaam<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="voornaam" name="voornaam" placeholder="speelplein" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['voornaam'])):  echo $_POST['voornaam']; endif; ?>">
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['voornaam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['voornaam']}</p>";?></span>

               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">familienaam<span class="required">*</span>
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
                   <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                     <input type="radio" name="functie" value="m" <?php if (!empty($_POST['functie']) && $_POST['functie'] == "m"): echo "checked"; endif; ?> > &nbsp; Mama &nbsp;
                   </label>
                   <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
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
                 <input type="submit" class="btn btn-success" name="action_insert_parent" value="Doorgaan" class="form-submit" />
              </div>
            </div>

          </form>

    	</div>
    </div>

	<?php endif; ?>
	<?php if (isset($ouders)): ?>

	<div class="x_panel">
    	<div class="x_title">
    	  <h2>Kies ouder</h2>
    	  <ul class="nav navbar-right panel_toolbox">
    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    	  </ul>
    	  <div class="clearfix"></div>
    	</div>
    	<div class="x_content">

			<?php //var_dump($selectedParent) ?>
			<form action="index.php?page=voegtoe&button=bestaand&parent=<?php echo $ouder['ID'] ?>" method="POST">
				<!-- <input type="text" name="parent" id="parent" placeholder="naam ouder" required >-->
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="parents">Ouder:</label>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<input placeholder="Naam ouder" class="form-control" list="parents" name="parents" id="answerInput" />
	 	 				<datalist id="parents">
	 	 					<option data-value="0">Kies ouder</option>
	 	 					<?php foreach ($ouders as $ouder): ?>
	 	 						<option data-value="<?php echo $ouder['ID'] ?>" value="<?php echo $ouder['familienaam'] ?> <?php echo $ouder['voornaam'] ?>" >
	 	 							<?php echo $ouder['familienaam'] ?> <?php echo $ouder['voornaam'] ?>
	 	 						</option>
	 	 					<?php endforeach; ?>
	 	 				</datalist>
					</div>
				</div>

				<input type="hidden" name="parent" id="answerInput-hidden">
				<!-- <input type="submit" name="ouder"> -->
	    	<button type="submit" name="submitParent" formmethod="post" formaction="index.php?page=voegtoe&button=bestaand" class="btn btn-round btn-default">Voeg kind toe aan deze ouder!</button>
				</form>

    	</div>
    </div>

		<?php if (isset($selectedParent)):?>

	    <div class="x_panel">
	    	<div class="x_title">
	    	  <h2>Kind toevoegen aan <b><?php echo $selectedParent['voornaam']." ".$selectedParent['familienaam']  ?></b> </h2>
	    	  <ul class="nav navbar-right panel_toolbox">
	    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	    	  </ul>
	    	  <div class="clearfix"></div>
	    	</div>
	    	<div class="x_content">

				<?php if(!empty($errors)): ?>
					<span class="error" style="color: #BA383C;">
						registratie is mislukt! er zijn velden leeg!
						<?php if(!empty($errors['bestaatal'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['bestaatal']}</p>";?>
					</span>
					<?php endif; ?>
                <br />

                <form method="POST" action="index.php?page=voegtoe&button=bestaand&parent=<?php echo $selectedParent['ID'] ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

									<input type="text" hidden name="user_id" value="<?php echo $selectedParent['user_id'] ?>">
									<input type="text" hidden name="ID" value="<?php echo $selectedParent['ID'] ?>">
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
                      <input type="text" id="lastname" name="lastname" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname'] ?>">
			               <span class="error" style="color: #BA383C;"><?php if(!empty($errors['lastname'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['lastname']}</p>";?></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="geslacht">Geslacht<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div id="geslacht" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary <?php if (isset($_POST['geslacht']) && $_POST['geslacht'] == 'm') echo 'active'?> " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="geslacht" value="m" <?php if (isset($_POST['geslacht']) && $_POST['geslacht'] == 'm') echo 'checked'?> > &nbsp; Jongen &nbsp;
                        </label>
                        <label class="btn btn-primary <?php if (isset($_POST['geslacht']) && $_POST['geslacht'] == 'v') echo 'checked'?> " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="geslacht" value="v" <?php if (isset($_POST['geslacht']) && $_POST['geslacht'] == 'v') echo 'checked'?> > Meisje
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
                      	<input id="medische" name="medische" class="form-control col-md-7 col-xs-12" type="text" placeholder="Noten allergie" value="<?php if (isset($_POST['medische'])) echo $_POST['medische'] ?>">
						            <span class="error" style="color: #BA383C;"><?php if(!empty($errors['medische'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['medische']}</p>";?></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Komt dit jaar<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div id="actief" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="actief" checked="checked" required="required"  value="1"> &nbsp; Ja &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="actief" value="0"> Neen
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
                       <input type="submit" class="btn btn-success" name="action" value="Opslaan" class="form-submit" />
			                 <input type="submit" class="btn btn-success" name="add" value="Opslaan en nog een kind toevoegen" class="form-submit" />

                    </div>
                  </div>

                </form>
            </div>
	    </div>

		<?php endif; ?>
	<?php endif; ?>
</section>
<script type="text/javascript" src="js/datalist.js"></script>

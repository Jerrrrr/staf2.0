<section class="right_col" role="main">
	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Aanwezigheidslijst Settings</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">

					<form action="index.php?page=week" id="weekform" name="weekform" method="POST">
						<div class="form-group">
							<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="dag"> Dag:</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<select class="form-control" name="dag" id="dag">
									<option value="0"> Dag </option>
									<option value="1" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 1)): echo "selected"; endif; ?>>Maandag</option>
									<option value="2" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 2)): echo "selected"; endif; ?>>Dinsdag</option>
									<option value="3" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 3)): echo "selected"; endif; ?>>Woensdag</option>
									<option value="4" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 4)): echo "selected"; endif; ?>>Donderdag</option>
									<option value="5" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 5)): echo "selected"; endif; ?>>Vrijdag</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="week">Week:</label>
							<div class="col-md-2 col-sm-3 col-xs-12">
							 <select class="form-control" name="week" id="week">
								 <option value="0"> Week </option>
								 <?php for ($i = 1; $i <= 5; $i++): ?>
									 <option value="<?php echo $i ?>" <?php if (isset($_POST['week'])): if ($_POST['week'] == $i): echo "selected"; endif; endif; ?>>Week <?php echo $i; ?></option>
								<?php endfor; ?>
							</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="jaar"> Naam:</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<select  class="form-control" name="jaar" id="jaar">
									<?php for ($i = 2016; $i <= date("Y"); $i++): ?>
										<option value="<?php echo $i; ?>" <?php if (isset($_POST["jaar"])): if ($_POST["jaar"] == $i): echo "selected"; endif; else: if ($i == date("Y")): echo "selected"; endif; endif; ?> form="dag" onChange="this.form.submit()"><?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="jaar"> Naam: </label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input style="margin-bottom: 2rem;" placeholder="Naam" class="form-control"type="text" name="filter" id="filter" value="<?php if (isset($_POST['filter'])): echo $_POST['filter']; endif; ?>" />
							</div>
						</div>
						<!-- <input type="submit"> -->
					</form>
			</div>
		</div>
	</div>


	<?php if (isset($aanwezigheden) && isset($aantalAanwezigheden)): ?>
	<div id="aanwezigheid" class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Aanwezigheidslijst</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<table  class="table">
					<tr>
						<th>Naam</th>
						<th class="center" >Voormiddag</th>
						<th class="center" >Volle Dag</th>
						<th class="center" >Namiddag</th>
						<th class="center" >Halve dagen aanwezig</th>
						<th class="center" >Volle dagen aanwezig</th>
						<th class="center" >TOTAAL aanwezig</th>
					</tr>
					<?php foreach ($aanwezigheden as $aanwezigheid): ?>
							<tr>
								<form action="index.php?page=week" method="post" id="<?php echo $aanwezigheid['ID']; ?>">
									<td>
										<?php
										$pieces = explode("-", $aanwezigheid['geboortedatum']);
										$year =  $pieces[2];
										if ((date('Y') -6) < $year ):
											echo '<span style="color: #FDA73D;"><b>';
										elseif ((date('Y') -6) == $year ):
											echo '<span style="color: #71BDCF"><b>';
										else:
											echo '<span><b>';
										endif;
										echo $aanwezigheid["voornaam"] . " " . $aanwezigheid["achternaam"];
										echo '</b><span>';
										 ?>
										<input type="text" class="hidden" name="id" value="<?php echo $aanwezigheid['ID']; ?>" form="<?php echo $aanwezigheid['ID']; ?>"/>
										<input type="text" class="hidden" value="<?php echo $_POST['jaar']; ?>" name="jaar" form="<?php echo $aanwezigheid['ID']; ?>"/>
										<input type="text" class="hidden" value="<?php echo $_POST['week']; ?>" name="week" form="<?php echo $aanwezigheid['ID']; ?>"/>
										<input type="text" class="hidden" value="<?php echo $_POST['dag']; ?>" name="dag" form="<?php echo $aanwezigheid['ID']; ?>"/>
										<input type="text" class="hidden" value="<?php echo $_POST['filter']; ?>" name="filter" form="<?php echo $aanwezigheid['ID']; ?>"/>
									</td>
									<td class="center" ><input type="checkbox" name="dagtype" value="VM" form="<?php echo $aanwezigheid['ID']; ?>"
									<?php if (strpos($aanwezigheid["dagtypes"], "VM") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "VD") !== false || (strpos($aanwezigheid["dagtypes"], "VM") === false && strpos($aanwezigheid["dagtypes"], "NM") !== false  )): echo "disabled"; endif; ?> ></td>
									<td class="center" ><input type="checkbox" name="dagtype" value="VD" form="<?php echo $aanwezigheid['ID']; ?>"
									<?php if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "M") !== false): echo "disabled"; endif; ?> ></td>
									<td class="center" ><input type="checkbox" name="dagtype" value="NM" form="<?php echo $aanwezigheid['ID']; ?>"
									<?php if (strpos($aanwezigheid["dagtypes"], "NM") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "disabled"; endif; ?> ></td>

									<td class="center" ><?php echo $aanwezigheid['halvedagen_aanwezig']; ?></td>
									<td class="center" ><?php echo $aanwezigheid['volledagen_aanwezig']; ?></td>
									<td class="center"><?php echo $aanwezigheid['halvedagen_aanwezig'] / 2 + $aanwezigheid['volledagen_aanwezig']; ?></td>
									<td><input class="hidden" type="submit" /></td>
								</form>
							</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<?php endif; ?>
<script src="js/weekajax.js"></script>
</section>

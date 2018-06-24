<section class="right_col" role="main">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Settings </h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="index.php?page=dagen" method="post">

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-3 col-xs-12" hidden for="week">week:</label>
							<div class="col-md-2 col-sm-3 col-xs-12">
								<select class="form-control" name="week" id="week">
									<?php for ($i = 1; $i <= 5; $i++): ?>
										<option value="<?php echo $i ?>"
											<?php if (isset($_POST["week"])): if($_POST["week"] == $i): echo "selected"; endif; endif; ?>
										 ><?php echo "week ". $i ?></option>
									<?php endfor; ?>
								</select>
							</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-3 col-xs-12" hidden for="jaar">jaar:</label>
							<div class="col-md-2 col-sm-3 col-xs-12">
								<select class="form-control" name="jaar" id="jaar">
									<?php for ($i = 2016; $i <= date("Y"); $i++): ?>
										<option value="<?php echo $i ?>"
											<?php if (isset($_GET["jaar"])): if($_GET["jaar"] == $i): echo "selected"; endif; endif; ?>
											<?php if (isset($_POST["jaar"])): if($_POST["jaar"] == $i): echo "selected"; endif; endif; ?>
										 ><?php echo $i ?></option>
									<?php endfor; ?>
								</select>
							</div>
					</div>

					<button type="submit" class="btn btn-round btn-primary">Kies jaar</button>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Totaal Week Overzicht Kinderen</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">

				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<th class="center">Naam</th>
						<th class="center">Voornaam</th>
						<th class="center">Maandag</th>
						<th class="center">Dinsdag</th>
						<th class="center">Woensdag</th>
						<th class="center">Donderdag</th>
						<th class="center">Vrijdag</th>
						<th class="center" >TOTAAL dagen aanwezig per week</th>
					</thead>


					<?php if ($overzicht != 0 || !empty($overzicht)): ?>
				    <?php foreach ($overzicht as $kind): ?>
				      <tr>
				        <td ><?php echo $kind["achternaam"]; ?></td>
						<td ><?php echo $kind["voornaam"]; ?></td>
								<td class="center"><?php if (!empty($kind[0]['maandag'])) echo $kind[0]['maandag'] ?></td>
								<td class="center"><?php if (!empty($kind[0]['dinsdag'])) echo $kind[0]['dinsdag'] ?></td>
								<td class="center"><?php if (!empty($kind[0]['woensdag'])) echo $kind[0]['woensdag'] ?></td>
								<td class="center"><?php if (!empty($kind[0]['donderdag'])) echo $kind[0]['donderdag'] ?></td>
								<td class="center"><?php if (!empty($kind[0]['vrijdag'])) echo $kind[0]['vrijdag'] ?></td>
								<td class="center"><?php if (!empty($kind[0]['TOTAAL'])) echo $kind[0]['TOTAAL'] ?></td>
				      </tr>
				    <?php endforeach; ?>
				  <?php else: ?>
				    <tr class="center">
				      <td colspan="7"> Geen kinderen aanwezig. </td>
				    </tr>
				  <?php endif; ?>

				</table>

			</div>
		</div>
	</div>


</section>

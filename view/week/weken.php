<section class="right_col" role="main">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Totaal Overzicht Kinderen</h2>
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
						<th>Naam</th>
						<?php for ($i = 1; $i < 6; $i++): ?>
				      <th class="center" >Week <?php echo $i; ?></th>
				    <?php endfor; ?>
						<th class="center" >TOTAAL dagen aanwezig</th>
					</thead>


					<?php if ($overzicht != 0 || !empty($overzicht)): ?>
				    <?php foreach ($overzicht as $kind): ?>
				      <tr>
				        <td ><?php echo $kind["voornaam"] . " " . $kind["achternaam"]; ?></td>
				        <td class="center"><?php echo $kind["week_1"] ?></td>
								<td class="center"><?php echo $kind["week_2"] ?></td>
								<td class="center"><?php echo $kind["week_3"] ?></td>
								<td class="center"><?php echo $kind["week_4"] ?></td>
								<td class="center"><?php echo $kind["week_5"] ?></td>
								<td class="center"><?php echo $kind["TOTAAL"] ?></td>
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
				<form action="index.php?page=weken" method="post">
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


</section>

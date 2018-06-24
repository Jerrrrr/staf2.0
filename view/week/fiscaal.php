<!-- <section class="right_col" role="main">

		<div class="x_panel">
	    	<div class="x_title">
	    	  <h2><b class="error" style="color: #BA383C;"> Fiscale attesten </b></h2>
	    	  <ul class="nav navbar-right panel_toolbox">
	    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	    	  </ul>
	    	  <div class="clearfix"></div>
	    	</div>
	    	<div class="x_content">
					<span class="error" style="color: #BA383C;">
						voor fiscale attesten te vergemakkelijken..
					</span>
					<br />
	    	</div>
	    </div>
</section> -->

<section class="right_col" role="main">

	<div class="x_panel">
			<div class="x_title">
				<h2>Kies kind</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

			<form action="index.php?page=fiscaal" method="POST">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="childs">Kind:</label>
					<div class="col-md-2 col-sm-3 col-xs-12">
						<input placeholder="Naam kind" class="form-control" list="childs" name="childs" id="answerInput" />
						<datalist id="childs">
							<option data-value="0">Kies kind</option>
							<?php foreach ($kinderen as $kind): ?>
								<option data-value="<?php echo $kind['ID'] ?>" value="<?php echo $kind['achternaam'] ?> <?php echo $kind['voornaam'] ?>" >
									<?php echo $kind['achternaam'] ?> <?php echo $kind['voornaam'] ?>
								</option>
							<?php endforeach; ?>
						</datalist>
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

				<input type="hidden" name="parent" id="answerInput-hidden">
				<button type="submit" name="submitParent" formmethod="post" formaction="index.php?page=fiscaal" class="btn btn-round btn-default">Zoek kind!</button>
				</form>

			</div>
		</div>

		<?php if(!empty($data) && $data !== null){ ?>
			<?php if($data === 1 ){ ?>
				<div class="x_panel">
					<div class="x_title">
						<h2>ERROR</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li>
									<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						There went something wrong Contact the developer. You submitted a non ... child id
					</div>
				</div>
			<?php }else{ ?>
				<?php //var_dump($data); $data ?>
				<div class="x_panel">
					<div class="x_title">
						<h2> <?php echo $kind_gegevens['voornaam']." ". $kind_gegevens['achternaam'] ?></h2>
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
								<th class="center" >Eerste dag</th>
								<th class="center" >Laatste dag</th>
								<th class="center" >Halve dagen aanwezig</th>
								<th class="center" >Volle dagen aanwezig</th>
								<th class="center" >Totaal ontvangen geld</th>
								<th class="center" >Jaar</th>
							</tr>
									<tr>
											<td class="center"><?php echo $tableOne['eersteDag'] ?></td>
											<td class="center"><?php echo $tableOne['laatsteDag'] ?></td>
											<td class="center"><?php echo $tableOne['HD'] ?></td>
											<td class="center"><?php echo $tableOne['VD'] ?></td>
											<td class="center"> &euro; <?php echo $tableOne['geld'] ?></td>
											<td class="center"><?php echo $tableOne['jaar'] ?></td>
									</tr>

						</table>
					</div>
				</div>

				<!-- <div class="x_panel">
					<div class="x_title">
						<h2>Tabel</h2>
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
								<th class="center" > </th>
								<th class="center" >Maandag</th>
								<th class="center" >Dinsdag</th>
								<th class="center" >Woensdag</th>
								<th class="center" >Dodnerdag</th>
								<th class="center" >Vrijdag</th>
							</tr>
							<?php for($i=1; $i <= 5 ; $i++) { ?>
								<tr>
									<th class="center">Week <?php echo $i; ?></th>
									<td class="center"> <?php var_dump($data['week']) ?> </td>
									<td class="center">  </td>
									<td class="center"> </td>
									<td class="center"> </td>
									<td class="center"> </td>
								</tr>
							<?php  } ?>

						</table>
					</div>
				</div> -->
			<?php } ?>
		<?php } ?>

</section>
<script type="text/javascript" src="js/datalist.js"></script>

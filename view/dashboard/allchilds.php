<section class="right_col" role="main">

<!--
	<table border="1">
		<tr>
			<th>ID</th>
			<th>NAAM</th>
			<th>VOORNAAM</th>	
			<th>GESLACHT</th>	
			<th>GEBOORTEDATUM</th>	
			<th>MEDISCH!</th>
			<th>TEL. NR. 1</th>
			<th>TEL. NR. 2</th>
			<th>NAAM OUDER</th>
			<th>VOORNAAM OUDER</th>
			<th>E-MAIL</th>
			<th>ADRES</th>
			<th>POSTCODE</th>
			<th>GEMEENTE</th>
			<th>NOTITIE</th>
			<th></th>
			<th>REGISTRATIE DATUM</th>
			<th>UPDATE DATUM</th>

		<tr>
		-->
   <?php  
   /*
   foreach ($kinderen as $row):  

		echo '  <tr>  
			<td>' . $row["ID"] . '</td>  
			<td>' . $row['achternaam'] . '</td>
			<td>' . $row['voornaam'] . '</td>
			<td>' . $row['geslacht'] . '</td>
			<td>' . $row['geboortedatum'] . '</td>
			<td>' . $row['medische'] . '</td>
			<td>' . $row['tel1'] . '</td>
			<td>' . $row['tel2'] . '</td>
			<td>' . $row['oudernaam'] . '</td>
			<td>' . $row['oudervoornaam'] . '</td>
			<td>' . $row['email'] . '</td>
			<td>' . $row['adres'] . '</td>
			<td>' . $row['postcode'] . '</td>
			<td>' . $row['stad'] . '</td>
			<td>' . $row['notities'] . '</td>  
			<td></td>  
			<td>' . $row['registratiedatum'] . '</td>  
			<td>' . $row['updatedatum'] . '</td>  
		</tr> ';  
	endforeach;
	*/
	?>
	<!--
	</table>-->

		<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Alle kinderen </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                      	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>

                    <div class="clearfix"></div>
                  </div>

                  <form action="index.php?page=kinderen" method="POST">
		
					<label for="allYear">Toon ingeschreven alle jaren</label>
					<input name="allYear" type="checkbox" <?php if(isset($_POST['allYear'])): echo 'checked'; endif; ?>>
					<!-- <div class="title_right">
			            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			              <div class="input-group">
			                <input type="text" class="form-control" placeholder="Zoek kind...">
			                <span class="input-group-btn">
			                  <button class="btn btn-default" type="button">Go!</button>
			                </span>
			              </div>
			            </div>
			        </div>
			        -->
			        <input type="submit" name="years"  class="btn btn-default" value="Go">
				</form>

                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
							<th>ID</th>
							<th>Naam</th>
							<th>Voornaam</th>	
							<th>Geslacht</th>	
							<th>Geboortedatum</th>	
							<th>MEDISCH!</th>
							<th>Tel. 1</th>
							<th>Tel. 2</th>
							<th>Naan ouder</th>
							<th>Voornaam ouder</th>
							<th>E-mail</th>
							<th>Adres</th>
							<th>Postcode</th>
							<th>Gemeente</th>
							<th>Notitie</th>
							<th></th>
							<th>Registratiedatum</th>
							<th>Updatedatum</th>
						<tr>
                      </thead>


                      <tbody>
                       <?php  
						   foreach ($kinderen as $row):  

								echo '  <tr>  
									<td>' . $row["ID"] . '</td>  
									<td>' . $row['achternaam'] . '</td>
									<td>' . $row['voornaam'] . '</td>
									<td>' . $row['geslacht'] . '</td>
									<td>' . $row['geboortedatum'] . '</td>
									<td>' . $row['medische'] . '</td>
									<td>' . $row['tel1'] . '</td>
									<td>' . $row['tel2'] . '</td>
									<td>' . $row['oudernaam'] . '</td>
									<td>' . $row['oudervoornaam'] . '</td>
									<td>' . $row['email'] . '</td>
									<td>' . $row['adres'] . '</td>
									<td>' . $row['postcode'] . '</td>
									<td>' . $row['stad'] . '</td>
									<td>' . $row['notities'] . '</td>  
									<td></td>  
									<td>' . $row['registratiedatum'] . '</td>  
									<td>' . $row['updatedatum'] . '</td>  
								</tr> ';  
							endforeach;
							?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

</section>

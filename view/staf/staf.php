<section class="account">
	<article class="main">
		<?php
	 		if(!empty($error)) { echo '<div class="error box">'.$error.'</div>'; }
			if(!empty($info))  { echo '<div class="info box">'.$info.'</div>'; }
		?>
	</article>
	
	<?php if(empty($_SESSION['user'])){ ?>
		<article class="main inloggen">
			<h2>Mijn account</h2>
			    <form method="post" action="index.php?page=login">
					<fieldset>

						<label for="username">username:</label> 
						<input type="username" name="username" autofocus value="<?php if(!empty($_POST['username'])) echo $_POST['username']; ?>"/>
						<span class="error"><?php if(!empty($errors['username'])) echo "<p class=\"error\">{$errors['username']}</p>";?></span>
						
						<label for="pasword" >wachtwoord:</label> 
						<input type="password" name="password" />
						<span class="error"><?php if(!empty($errors['password'])) echo "<p class=\"error\">{$errors['password']}</p>";?></span>

						<input class="inloggen" type="submit" value="inloggen" />
					</fieldset>
				</form>		
		</article>
	<?php }else{ ?>
		<article class="main uploadadmin">
			<header>
				<h2>welkome <?php echo $_SESSION['user']['username'] ?>  </h2>
				<h5 class="boc error">De afbeelding MOET een jpg zijn!!</h5>
			</header>
			<article class="uploadboxke">
				<form method="post" class="upload-form" enctype="multipart/form-data" action="index.php?page=staf">
					
					<!-- 
					<ul>
						<li>
							<span class="error"><?php if(!empty($errors['size'])) echo "<p class=\"error\">{$errors['size']}</p>";?></span>
						</li>
						<li>
							<input type="radio" name="size" value="1">
							<label class="form-answer" for="size"> klein: 150 x 150 pixels ( vierkant )</label>
						</li>
						<li>
							<input type="radio" name="size" value="2">
							<label class="form-answer" for="size"> groot: 150 x 300 pixels ( rechthoek )</label>
						</li>
					</ul>
					-->

					<div class="form-group">
						<label>
							<span class="form-label">Select An Image</span>
							<div class="input-group input-group-image">
								<input name="image" class="form-input form-input-image" type="file" />
								<?php if(!empty($errors['image'])) echo '<span class="error">' . $errors['image'] . '</span>';?>
							</div>
						</label>
					</div>

					<div class="form-group">
						<input type="hidden" name="action" value="upload" />
						<div class="input-group input-group-submit">
							<input type="submit" class="form-submit" value="Upload" />
						</div>
					</div>

				</form>
			</article>
			<div class="result">
					<ul>
					<?php
						if(!empty($images)) {
							foreach($images as $image){
								echo "<li><img src=\"images/sponsors/{$image['image']}\" alt=\"Sponsor\" title=\"Sponsor\"></li>";
							}
						}
					?>
					</ul>
				</div>
		</article>
 	<?php } ?>
 </section>
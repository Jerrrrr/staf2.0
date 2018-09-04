<section class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Wijzig gebruikers </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<table class="table table-striped table-bordered">
						<thead>
							<th>ID</th>
							<th>Naam</th>
							<th>Rol</th>
							<th></th>
						</thead>
						<tbody>
							<?php foreach ($users as $user): ?>
								<tr>
									<td><?php echo $user["ID"]; ?></td>
									<td><?php echo $user["username"]; ?></td>
									<td><?php if ($user["role"] == 1): echo "SUPER USER"; else: echo "Staflid"; endif; ?></td>
									<td>
										<strong>
											<a href="index.php?page=update_user&id=<?php echo $user['ID']; ?>" class="collapse-link">Bewerken</a>
										</strong>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
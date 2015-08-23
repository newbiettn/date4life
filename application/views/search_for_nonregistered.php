<?php include 'metadata.php'?>
<body>
	<?php include 'nav.php'?>
	<div class="row">
		<div class="large-10 large-centered columns container">
			<h3>Request random friends</h3>
			<?php echo form_open('search_for_nonregistered/search_for_non_registered'); ?>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Gender</label>
							</div>
							<div class="small-9 columns">
								<select name="gender">
									<option value="1">Male</option>
									<option value="0">Female</option>
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Minimum age</label>
							</div>
							<div class="small-9 columns">
								<select name="min_age">
									<?php for($i = 18; $i <= 70; $i++) {?>
										<option value="<?php echo $i?>"><?php echo $i?></option>
									<?php } ?>
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Maximum age</label>
							</div>
							<div class="small-9 columns">
								<select name="max_age">
									<?php for($i = 19; $i <= 70; $i++) {?>
										<option value="<?php echo $i?>"><?php echo $i?></option>
									<?php } ?>
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Location</label>
							</div>
							<div class="small-9 columns">
								<select name="location">
									<option value="1">Brussels</option>
									<option value="2">Leuven</option>
									<option value="3">Antwerp</option>
									<option value="4">Ostend</option>
							</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<input type="submit" value="Find" class="button"/>
					</div>
			</form>
		</div>
		<?php if (isset($search_result)) {?>
		<div class="large-10 large-centered columns container">
			<h4>Search result</h4>
			<p><i>There are <?php echo count($search_result)?> friends in total</i></p>
			<div class="row" >
				<div class="large-12 columns">
				<table>
					<thead>
						<tr>
							<th width="223">Picture</th>
							<th width="160">Username</th>
							<th width="160">Date of Birth</th>
							<th width="223">Email</th>
							<th width="160">Gender</th>
							<th width="160">Location</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($search_result as $person) {?>
						<tr>
							<td>
								<img class="personal-profile-picture" width="66"
								src="<?php echo base_url(); ?>static/upload/<?php echo $person["picture"]; ?>"
								class="" />
							</td>
							<td><a target="_blank" href="<?php echo base_url('index.php/profile/view_profile')?>/<?php echo $person["username"]; ?>"><?php echo $person["username"]?></a></td>
							<td><?php echo $person["dob"]?></td>
							<td><?php echo $person["email"]?></td>
							<td><?php if ($person["gender"] == 1) {
								echo 'Male';
							} else {
								echo 'Female';}?>
							</td>
							<td><?php echo $person["city"]?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
	
			</div>
		</div>
		<?php } ?>
	</div>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</body>
</html>

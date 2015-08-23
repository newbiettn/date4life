<?php include 'metadata.php'?>
<body>
	<?php include 'nav.php'?>
	<div class="row">
		<div class="large-10 large-centered columns container">
			<h3>Search</h3>
			<p>Please enter a query in the box to search</p>
			<?php echo form_open('search/do_search'); ?>			
			<div class="row collapse">
					<div class="large-10 columns">
						<input type="text" name="query" placeholder="Enter search keyword">
					</div>
					<div class="large-2 columns">
						<input class="button postfix" type="submit" value="Search"/>
					</div>
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
							<td><?php echo $person["location_name"]?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
	
			</div>
		</div>
		<?php } ?>
	</div>
	<?php require 'notification_script.php' ?>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</body>
</html>

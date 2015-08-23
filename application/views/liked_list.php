<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<div class="row main-content">
		<div class="large-6 large-centered columns container">
			<h3>Liked List</h3>
			<?php if (!is_null($list)) {?>
			<table>
				<thead>
					<tr>
						<th width="223">Picture</th>
						<th width="160">Username</th>
						<th width="160">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list as $person) {?>
					<tr>
						<td>
							<img class="personal-profile-picture" width="66"
							src="<?php echo base_url(); ?>static/upload/<?php echo $person["picture"]; ?>"
							class="" />
						</td>
						<td><a target="_blank" href="<?php echo base_url('index.php/profile/view_profile')?>/<?php echo $person["username"]; ?>"><?php echo $person["username"]?></a></td>
						<td>
							<a href="#" class="button tiny unlike-user" data-id="<?php echo $person["oid"] ?>">Unlike</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
		</div>
	</div>
	<?php require 'notification_script.php' ?>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</body>
<script>
	$('.unlike-user').click(function(){
		var ajaxData = {};
		ajaxData["current_user_id"] = <?php echo $this->session->userdata ( 'oid' )?>;
		ajaxData["favorite_user_id"] = $(this).data("id");
		$.ajax({
			url: "<?php echo base_url('index.php/like/unlike_user')?>",
			data: ajaxData,
			dataType: 'json',
			method: 'POST',
			success: function(status) {
				location.reload();
			}
		});
	});
</script>
</html>
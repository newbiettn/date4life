<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<div class="row main-content">
		<div class="large-6 large-centered columns container">
			<h3>Attention List</h3>
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
							
							<a id="send-attention-button-<?php echo $person["oid"] ?>" data-reveal-id="attention-modal-<?php echo $person["oid"] ?>" href="#" class="button tiny send-attention-back" data-id="<?php echo $person["oid"] ?>">Send Attention Back</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
		</div>
	</div>
	<?php if (!is_null($list)) {?>
	<?php foreach ($list as $person) {?>
	<div data-id="<?php echo $person["oid"] ?>" id="attention-modal-<?php echo $person["oid"] ?>" class="reveal-modal attention-form-for-the-list" data-reveal
		aria-labelledby="firstModalTitle" aria-hidden="true" role="dialog">
		<h4 id="attention-modal-title">Pick an item</h4>
		<?php $attributes = array('id' => 'attention-form', 'class' => 'row');?>
		<?php echo form_open('attention/send_attention', $attributes); ?>
			<div class=large-6">
				<input type="radio" name="attention_type" value="1" id="flower"><label for="flower">Flower</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="2" id="handshake"><label for="handshake">Handshake</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="3" id="smiley"><label for="smiley">Smiley</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="4" id="kiss"><label for="kiss">Kiss</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="5" id="tap_on_the_back"><label for="tap_on_the_back">Tap on the back</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="6" id="thumb_up"><label for="thumb_up">Thumbs up</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="7" id="bottom_of_wine"><label for="bottom_of_wine">Bottle of Wine</label>
			</div>
			<div class=large-6">
				<input type="submit" value="Send Attention" id="send-attention-submit" class="button tiny small">
			</div>
			<input type="hidden" name="current_user_id" value="<?php echo $this->session->userdata ( 'oid' )?>">
			<input type="hidden" name="received_user_id" value="<?php echo $person["oid"] ?>">
		</form>
	</div>
	<?php } ?>
	<?php } ?>
	
	<?php require 'notification_script.php' ?>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</body>
<script>
	$(document).ready(function(){
		$('.attention-form-for-the-list').submit(function() {
			id = $(this).data('id');
			$form = $(this);
			$.ajax({
				url: "<?php echo base_url('index.php/attention/send_attention')?>",
				data: $("#attention-form").serialize(),
				dataType: 'json',
				method: 'POST',
				success: function(data) {
					if (data.status = 'success'){
						$('#send-attention-button-'+id).text('Sent!');
					}
					$form.foundation('reveal', 'close');
				}
			});
			return false;
		});
	});
</script>
</html>
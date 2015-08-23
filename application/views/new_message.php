<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<?php require 'header.php'?>
	<div class="row">
		<div class="large-6 large-centered columns container">
			<h3>New Message</h3>
			<p>You don't have any message, compose new message now!</p>
			<?php echo form_open('message/create_very_first_message'); ?>
				 <fieldset>
					<div class="large-12">
						<label>To <small>required</small></label>
						<input type="text" name="message_to" placeholder="Username" id="message_to"/>
				        <?php echo form_error('username', '<small class="error">', '</small>'); ?>
				    </div>
					<div class="large-12">
						<label>Content <small>required</small></label>
						<textarea type="text" name="message_detail" placeholder="Message Content" rows="4"></textarea>
				        <?php echo form_error('password', '<small class="error">', '</small>'); ?>
				    </div>
				    <input type="hidden" value="" name="message_to_id" id="message_to_id"/>
				</fieldset>
				<div class="large-12">
					<input class="button small" type="submit" value="Send"/>
				</div>
			</form>
		</div>
	</div>
	<?php require 'notification_script.php' ?>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</html>
<script>
	$(document).ready(function(){
		$('#message_to').autocomplete({
			serviceUrl: '<?php echo base_url("index.php/search/user_suggestion") ?>',
			onSelect: function(suggestion){
				$('#message_to_id').val(suggestion.data);
			}
		})
	});
</script>
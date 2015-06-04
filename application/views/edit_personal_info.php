<?php include 'metadata.php'?>
<body>
	<?php include 'nav.php'?>
	<div class="row">
		<div class="large-4 columns">
			<ul class="side-nav">
				<li class="active">
					<a href="<?php echo base_url()?>index.php/user/manage/show_account">Basic Info</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>index.php/user/manage/show_change_password">Personal Info</a>
				</li>
				<li>
					<a href="#">Favorite Info</a>
				</li>
			</ul>
		</div>
		<div class="large-8 columns container wow fadeInRight">
			<h3>Edit password</h3>
			<p>You can update your password</p>
			<?php echo form_open('user/manage/update_password'); ?>
				<fieldset>
					<legend>Change password</legend>
					<div class="large-12">
						<label>Old password <small>required</small></label>
						<input type="password" name="old_password" placeholder="" />
						<?php echo form_error('old_password', '<small class="error">', '</small>'); ?>
					</div>
					<div class="large-12">
						<label>New password <small>required</small></label>
						<input type="password" name="new_password" placeholder="" />
						<?php echo form_error('new_password', '<small class="error">', '</small>'); ?>
					</div>
					<div class="large-12">
						<label>Re-enter new password <small>required</small></label>
						<input type="password" name="password_confirm" placeholder="" />
						<?php echo form_error('password_confirm', '<small class="error">', '</small>'); ?>
					</div>
					
					<div class="large-12">
						<input class="button small" type="submit" value="Update"/>
					</div>						
				</fieldset>
			</form>
		</div>
	</div>
	<?php require 'scripts.php'?>
	<?php require 'footer.php'?>
</body>
</html>

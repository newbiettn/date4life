<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<div class="row">
		<div class="large-6 large-centered columns container">
			<h3>Login</h3>
			<?php echo form_open('user/do_login'); ?>
				 <fieldset>
    				<legend>Login detail</legend>
					<div class="large-12">
						<label>Nickname <small>required</small></label>
						<input type="text" name="username" placeholder="Username" />
				        <?php echo form_error('username', '<small class="error">', '</small>'); ?>
				    </div>
					<div class="large-12">
						<label>Password <small>required</small></label>
						<input type="password" name="password" placeholder="Password" />
				        <?php echo form_error('password', '<small class="error">', '</small>'); ?>
				    </div>
				</fieldset>
				<div class="large-12">
					<input class="button small" type="submit" value="Login"/>
				</div>
			</form>
		</div>
	</div>
	<?php require 'scripts.php'?>
	<?php require 'footer.php'?>
</body>
</html>
<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<div class="row">
		<div class="large-6 large-centered columns container">
			<h3>Register new account</h3>
			<p>Register your account at Date4Life and enjoy!</p>
			<?php $attributes = array('id' => 'register-form');?>
			<?php echo form_open('user/create_member', $attributes); ?>
				<fieldset>
					<legend>Date4Life Register</legend>
					<div class="large-12">
	                    <label>Nickname <small>required</small></label>
	                    <input name="username" required="required" type="text" placeholder="mysupernickname" />
	                    <?php echo form_error('username', '<small class="error">', '</small>'); ?>
	                </div>
	                <div class="large-12">
	                    <label>Email <small>required</small></label>
	                    <input name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>
	                    <?php echo form_error('email', '<small class="error">', '</small>'); ?> 
	                </div>
	                <div class="large-12">
	                    <label>Password <small>required</small></label>
	                    <input name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
	                    <?php echo form_error('password', '<small class="error">', '</small>'); ?>
	                </div>
	                <div class="large-12">
	                    <label>Date of Birth <small>required</small></label>
	                    <input name="dob" required="required" type="date" class="dob"/>
	                    <?php echo form_error('dob', '<small class="error">', '</small>'); ?>
	                </div>
	                <div class="large-12">
	                    <label>Location <small>required</small></label>
	                    <select name="location">
	                    	<option value="1" >Brussels</option>
	                    	<option value="2">Leuven</option>
	                    	<option value="3">Antwerpt</option>
	                    	<option value="4">Ostend</option>
	                    </select>
	                </div>
	                <div class="large-12">
	                    <label>Gender <small>required</small></label>
	                    <select name="gender">
	                    	<option value="1" >Male</option>
	                    	<option value="0">Female</option>
	                    </select>
	                </div>
	                <div class="large-12">
	                    <label>Purpose <small>required</small></label>
	                    <select name="looking_for">
							<option value="love">Love</option>
							<option value="friendship">Friendship</option>
							<option value="penpal">Pen pal</option>
							<option value="activities">Activities</option>
						</select>
	                </div>
	                <div class="large-12">
	                    <label>Description <small>required</small></label>
	                    <textarea name="description" required="required"></textarea>
	                    <?php echo form_error('description', '<small class="error">', '</small>'); ?>
	                </div>
	                <div class="large-12">
	                    <label>Profile picture <small>required</small></label>
	                    <div class="dropzone" id="dropzone_profile_picture"></div>
	                </div>
	                <div class="large-12">
	                    Already a member ?
	                    <a href="<?php echo base_url()?>index.php/user/show_login" class="to_register"> Log in </a>
	                </div>
	                <input name="profile_picture_name" type="hidden" id="profile_picture_name"/>
				</fieldset>
				 <div class="large-12">
					<input class="button small" type="submit" value="Register"/>
				</div>
			</form>
		</div>
	</div>
	<?php require 'footer.php'?>
	<?php require 'general_script.php'?>
	<?php require 'register_script.php'?>
</body>
</html>
<?php include 'metadata.php'?>
<body>
	<div class="full-picture">
		<div class="row logo-welcome">
			<img width="140" src="<?php echo base_url(); ?>static/img/logo.png"/>
		</div>
		<div class="row">
			<div class="large-6 large-centered columns">
				<?php $attributes = array('class' => 'row search-form-welcome');?>
				<?php echo form_open('search_for_nonregistered/search_for_non_registered', $attributes); ?>
					<div class="large-12 columns">
						<label>I am seeking
							<select name="gender">
								<option value="1">Male</option>
								<option value="0">Female</option>
							</select>
						</label>
					</div>
					<div class="large-6 columns">
		    			<label>Age from
							<input type="number" min="18" max="50" name="min_age"/>
						</label>
		    		</div>
		    		<div class="large-6 columns">
		    			<label>To
							<input type="number" min="19" max="80" name="max_age"/>
						</label>
		    		</div>
		    		<div class="large-12 columns">
		    			<label>Location
							<select name="location">
								<option value="1">Brussels</option>
								<option value="2">Leuven</option>
								<option value="3">Antwerp</option>
								<option value="4">Ostend</option>
							</select>
						</label>
		    		</div>
		    		<div class="large-12 columns">
		    			<input class="button radius expand" type="submit" value="Search"/>
		    		</div>
		    		<div class="large-12 columns login-register-btn">
		    			<a href="<?php echo base_url('index.php/user/show_login')?>">Login</a> or <a href="<?php echo base_url('index.php/user/show_register')?>">Register</a>
		    		</div>
				</div>
    		</div>
		</div>
	</div>
</body>
<?php include 'general_script.php'?>
</html>
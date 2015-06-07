<?php include 'metadata.php'?>
<body>
	<form class="full-picture">
		<div class="row logo-welcome">
			<img width="140" src="<?php echo base_url(); ?>static/img/logo.png"/>
		</div>
		<div class="row">
			<div class="large-6 large-centered columns">
				<div class="row search-form-welcome">
					<div class="large-12 columns">
						<label>I am seeking
							<select>
								<option value="husker">Male</option>
								<option value="starbuck">Female</option>
							</select>
						</label>
					</div>
					<div class="large-6 columns">
		    			<label>Age from
							<input type="number" min="18" max="50" name="from-age"/>
						</label>
		    		</div>
		    		<div class="large-6 columns">
		    			<label>To
							<input type="number" min="19" max="55" name="to-age"/>
						</label>
		    		</div>
		    		<div class="large-12 columns">
		    			<label>Location
							<select>
								<option value="husker">Brussels</option>
								<option value="starbuck">Leuven</option>
							</select>
						</label>
		    		</div>
		    		<div class="large-12 columns">
		    			<a href="#" class="button radius expand">CONTINUE</a>
		    		</div>
		    		<div class="large-12 columns login-register-btn">
		    			<a href="<?php echo base_url('index.php/user/show_login')?>">Login</a> or <a href="<?php echo base_url('index.php/user/show_register')?>">Register</a>
		    		</div>
		    		
				</div>
				
    		</div>
		</div>
	</form>
</body>
<?php include 'general_script.php'?>
</html>
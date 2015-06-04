<?php include 'metadata.php'?>
<body>
	<?php include 'nav.php'?>
	<div class="row">
		<div class="large-10 large-centered columns container">
			<h3>Search</h3>
			<p>Please enter a query in the box to search</p>
			<div class="row collapse">
				<div class="large-10 columns">
					<input type="text" placeholder="Enter search keyword">
				</div>
				<div class="large-2 columns">
					<a href="#" class="button postfix">Go</a>
				</div>
      		</div>
		</div>
		<div class="large-10 large-centered columns container">
			<h4>Search result</h4>
			<div class="row">
				<div class="large-6 columns">
					<div class="row">
						<div class="large-3 columns">
							<img width="80" src="<?php echo base_url(); ?>static/img/avatar.jpg"/>
						</div>
						<div class="large-9 columns">
							<p><span>William Shaw</span><br/>
							<span>newbiettn@gmail.com</span><br/>
							<span>02 January, 1988</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require 'scripts.php'?>
	<?php require 'footer.php'?>
</body>
</html>

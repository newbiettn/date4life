<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<?php require 'header.php'?>
	<div class="row">
		<div class="large-8 large-centered columns profile-container">
			<h3>William Shaw</h3>
			<div class="row">
				<div class="large-4 columns">
					<img class="personal-profile-picture" width="240" src="<?php echo base_url(); ?>static/img/avatar.jpg" class=""/>
					<div class="row">
						<div class="large-11 large-centered columns">
							<ul class="stack-for-small secondary button-group">
								<li><a href="#" class="button tiny"><i class="fa fa-comments-o"></i> Message</a></li>
								<li><a href="#" class="button tiny"><i class="fa fa-plus-circle"></i> Add to List</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="large-8 columns">
					<!-- Basic Info -->
					<div class="row">
						<h5 class="large-11 personal-info-section"><i class="fa fa-user"></i> Basic Info</h5>
						<div class="large-12 columns">
							<div class="large-4 columns">
								<span class="personal-info-title">Date of Birth</span>
								<span class="personal-info-title">Location</span>
								<span class="personal-info-title">Email</span>
							</div>
							<div class="large-8 columns">
								<span class="personal-info-detail">02 August 1988</span>
								<span class="personal-info-detail">Brussesls, Belgium</span>
								<span class="personal-info-detail">newbiettn@gmail.com</span>
							</div>
						</div>
					</div>
					<!-- Personal Info -->
					<div class="row">
						<h5 class="large-11 personal-info-section"><i class="fa fa-info-circle"></i> Personal Info</h5>
						<div class="large-12 columns">
							<div class="large-4 columns">
								<span class="personal-info-title">Degree</span>
								<span class="personal-info-title">Nationality</span>
								<span class="personal-info-title">Clothing Style</span>
								<span class="personal-info-title">Hair Style</span>
								<span class="personal-info-title">Eye Color</span>
								<span class="personal-info-title">Number of Children</span>
								<span class="personal-info-title">Maritial Status</span>
								<span class="personal-info-title">Looking for</span>
								<span class="personal-info-title">Description</span>
							</div>
							<div class="large-8 columns">
								<span class="personal-info-detail">Master of Computer Science</span>
								<span class="personal-info-detail">Vietnamese</span>
								<span class="personal-info-detail">Flexible</span>
								<span class="personal-info-detail">Flexible</span>
								<span class="personal-info-detail">Brown</span>
								<span class="personal-info-detail">0</span>
								<span class="personal-info-detail">Single</span>
								<span class="personal-info-detail">Women</span>
								<span class="personal-info-detail">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy </span>
							</div>
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
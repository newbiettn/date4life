<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<?php require 'header.php'?>
	<div class="row">
		<div class="large-9 large-centered columns profile-container">
			<div class="row">
				<h3 class="large-4 columns"><?php echo $username ?></h3>
				<div class="large-8 columns">
					<ul class="stack-for-small secondary button-group personal-button">
						<li><a href="#" class="button tiny success"><i
								class="fa fa-comments-o"></i> Contact</a></li>
						<?php if (!$isAlreadyLiked) {?>
						<li class="like-unlike-item"><a href="#" class="button tiny success" id="like_user"><i
								class="fa fa-thumbs-up"></i> Like</a></li>
						<?php } else {?>
						<li class="like-unlike-item"><a href="#" class="button tiny alert unlike_user" id="unlike_user"><i
								class="fa fa-thumbs-down"></i> Unlike</a></li>
						<?php } ?>
						<li><a data-reveal-id="attention-modal" href="#" class="button tiny success "><i class="fa fa-gift"></i>
								Attention</a></li>
						<li><a data-reveal-id="block-modal" href="#" class="button tiny success"><i class="fa fa-ban"></i>
								Block</a></li>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="large-5 columns">
					<img class="personal-profile-picture" width="280"
						src="<?php echo base_url(); ?>static/upload/<?php echo $picture ?>" class="" />
				</div>
				<div class="large-7 columns">
					<!-- Basic Info -->
					<div class="row">
						<h5 class="large-11 personal-info-section">
							<i class="fa fa-user"></i> Basic Info
						</h5>
						<div class="large-12 columns">
							<div class="large-4 columns">
								<span class="personal-info-title">Date of Birth</span> <span
									class="personal-info-title">Location</span> <span
									class="personal-info-title">Email</span>
							</div>
							<div class="large-8 columns">
								<span class="personal-info-detail"><?php echo $dob?></span> <span
									class="personal-info-detail">Brussesls, Belgium</span> <span
									class="personal-info-detail"><?php echo $email?></span>
							</div>
						</div>
					</div>
					<!-- Personal Info -->
					<div class="row">
						<h5 class="large-11 personal-info-section">
							<i class="fa fa-info-circle"></i> Personal Info
						</h5>
						<div class="large-12 columns">
							<div class="large-4 columns">
								<span class="personal-info-title">Degree</span> <span
									class="personal-info-title">Nationality</span> <span
									class="personal-info-title">Clothing Style</span> <span
									class="personal-info-title">Hair Style</span> <span
									class="personal-info-title">Eye Color</span> <span
									class="personal-info-title">Number of Children</span> <span
									class="personal-info-title">Maritial Status</span> <span
									class="personal-info-title">Looking for</span> <span
									class="personal-info-title">Description</span>
							</div>
							<div class="large-8 columns">
								<span class="personal-info-detail">Master of Computer Science</span>
								<span class="personal-info-detail">Vietnamese</span> <span
									class="personal-info-detail">Flexible</span> <span
									class="personal-info-detail">Flexible</span> <span
									class="personal-info-detail">Brown</span> <span
									class="personal-info-detail">0</span> <span
									class="personal-info-detail">Single</span> <span
									class="personal-info-detail">Women</span> <span
									class="personal-info-detail">Lorem ipsum dolor sit amet,
									consectetuer adipiscing elit, sed diam nonummy </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="attention-modal" class="reveal-modal" data-reveal
		aria-labelledby="firstModalTitle" aria-hidden="true" role="dialog">
		<h4 id="attention-modal-title">Pick an item</h4>
		<form class="row">
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="flower"><label for="flower">Flower</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="handshake"><label for="handshake">Handshake</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="smiley"><label for="smiley">Smiley</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="kiss"><label for="kiss">Kiss</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="tap_on_the_back"><label for="tap_on_the_back">Tap on the back</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="thumb_up"><label for="thumb_up">Thumbs up</label>
			</div>
			<div class=large-6">
				<input type="radio" name="attention_type" value="Red" id="bottom_of_wine"><label for="bottom_of_wine">Bottle of Wine</label>
			</div>
			<div class=large-6">
				<input type="submit" value="Send Attention" class="button tiny small">
			</div>
		</form>
	</div>
	<div id="block-modal" class="reveal-modal" data-reveal
		aria-labelledby="block-modal-title" aria-hidden="true" role="dialog">
		<h4 id="firstModalTitle">Confirm</h4>
		<?php echo form_open('block/block_user'); ?>
			<div class=large-7">
				<p>Are you sure you want to block the user <b><?php echo $username ?></b>?</p>
			</div>
			<div class=large-7">
				<input type="submit" value="Confirm" class="button tiny small">
			</div>
			<input type="hidden" name="current_user_id" value="<?php echo $this->session->userdata ( 'oid' )?>"/>
			<input type="hidden" name="blocked_user_id" value="<?php echo $oid?>" />
			<a class="close-reveal-modal" aria-label="Close">&#215;</a>
		</form>
	</div>
	<?php require 'private_action_script.php'?>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</body>
</html>
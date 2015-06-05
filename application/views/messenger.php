<?php include 'metadata.php'?>
<body>
	<?php require 'nav.php'?>
	<?php require 'header.php'?>
	<div class="row">
		<div class="large-12 columns chat-container">
			<div class="row window">
				<div class="large-4 columns conv-list-view ">
					<header class="conv-list-view__header">
					</header>
					<ul class="conv-list">
						<li>
							<div class="status">
								<i class="status__indicator--read-message"></i>
								<figure class="status__avatar">
									<img
										src="http://0.gravatar.com/avatar/729edf889ced7863dedba95452272bca?size=80">
								</figure>
								<div class="meta">
									<div class="meta__name">Hugo Giraudel</div>
									<div class="meta__sub--dark">Ok!</div>
								</div>
							</div>
						</li>
						<li class="selected">
							<div class="status">
								<i class="status__indicator--replied-message"></i>
								<figure class="status__avatar">
									<img
										src="http://1.gravatar.com/avatar/34735b367f6bf8d5d2f38cb3d20d5e36?size=80" />
								</figure>
								<div class="meta">
									<div class="meta__name">Tim Pietrusky</div>
									<div class="meta__sub--dark">Browserhacks looks great!</div>
								</div>
							</div>
						</li>
						<li>
							<div class="status">
								<i class="status__indicator--unread-message"></i>
								<figure class="status__avatar">
									<img
										src="http://1.gravatar.com/avatar/7ec0cac01b6d505b2bbb2951a722e202?size=80" />
								</figure>
								<div class="meta">
									<div class="meta__name">Mads Cordes</div>
									<div class="meta__sub--dark">Hi there :)</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="large-8 columns chat-view">
					<div class="chat-view__header">
						<div class="cf">
							<div class="status">
								<i class="status__indicator--online"></i>
								<div class="meta">
									<div class="meta__name">Tim Pietrusky</div>
									<div class="meta__sub--light">Adium that ass!</div>
								</div>
							</div>
						</div>
					</div>
					<div class="message-view">
						<div class="message--send">
							<div class="message__bubble--send">Hi Tim!</div>
							<figure class="message__avatar">
								<img
									src="http://1.gravatar.com/avatar/89b9501f0f9e3020aab173f9a5a47683?size=80" />
							</figure>
						</div>
						<div class="cf"></div>

						<div class="message">
							<figure class="message__avatar">
								<img
									src="http://1.gravatar.com/avatar/34735b367f6bf8d5d2f38cb3d20d5e36?size=80" />
							</figure>
							<div class="message__bubble">Hi</div>
						</div>
						<div class="cf"></div>

						<div class="message--send">
							<div class="message__bubble--send">Browserhacks looks great!</div>
							<figure class="message__avatar">
								<img
									src="http://1.gravatar.com/avatar/89b9501f0f9e3020aab173f9a5a47683?size=80" />
							</figure>
						</div>
					</div>
					<div class="chat-view__input">
						<div class="input">
							<input /></span>
						</div>
						<div class="status">
							<figure class="status__avatar--small">
								<img
									src="http://1.gravatar.com/avatar/89b9501f0f9e3020aab173f9a5a47683?size=80" />
							</figure>
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
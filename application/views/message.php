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
					<?php if (isset($conversation_list)) {?>
					<?php foreach ($conversation_list as $conversation) {?>
						<li data-id="<?php echo $conversation["conversation_id"] ?>" 
							id="conversation-<?php echo $conversation["friend_id"] ?>"
							data-picture="<?php echo $conversation["picture"]?>"
							data-username="<?php echo $conversation["username"]?>"
							class="a-conversation">
							<div class="status">
								<i class="status__indicator--unread-message"></i>
								<figure class="status__avatar">
									<img width=80 height=80
										src="<?php echo base_url(); ?>static/upload/<?php echo $conversation["picture"]?>" />
								</figure>
								<div class="meta">
									<div class="meta__name"><?php echo $conversation["username"]?></div>
									<div class="meta__sub--dark"></div>
								</div>
							</div>
						</li>
					<?php }} ?>
					</ul>
				</div>
				<div class="large-8 columns chat-view">
					<div class="chat-view__header">
						<div class="cf">
							<div class="status">
								<i class="status__indicator--online"></i>
								<div class="meta">
									<div class="meta__name"></div>
									<div class="meta__sub--light"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="message-view">
					</div>
					<div class="chat-view__input">
						<div class="input">
							<input name="message_content" type="text"/></span>
						</div>
						<div class="status">
							<figure class="status__avatar--small">
								<img
									src="<?php echo base_url('static/upload/') . '/'.  $this->session->userdata()["picture"]?>" />
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require 'notification_script.php' ?>
	<?php require 'general_script.php'?>
	<?php require 'footer.php'?>
</body>
<script>
	var current_user = <?php echo json_encode ($this->session->userdata()) ?>;
	var current_user_picture = "<?php echo base_url("static/upload/")?>" + "/" + current_user["picture"];
	
	$(function(){
		<?php if (!$friend_id) {?>
			target_user_id = "<?php echo $friend_id?>";
		<?php } else {?>
			target_user_id = "<?php echo $conversation_list[0]["friend_id"]?>";
		<?php } ?>
		$('#conversation-' + target_user_id). trigger("click");
	});
	$(document).ready(function(){
		$('#s_keyword').autocomplete({
			serviceUrl: '<?php echo base_url("index.php/user/search/search_suggestion") ?>',
		});
		
		$('.a-conversation').click(function(){
			console.log("click");
			conversation_id = $(this).data("id");
			target_username = $(this).data("username");

			$('.meta__name').html(target_username);
			picture = $(this).data("picture");
			friend_data = {};
			friend_data["picture"] = picture;
			get_all_messages_for_a_conversation(conversation_id, friend_data);
		});

		$(document).keypress(function(e) {
			if(e.which == 13) {
				msg = $("input[name=message_content]").val();
				if (msg.length > 0) {
					send_msg(msg);
					insert_new_message_to_view(msg, current_user_picture);
					$("input[name=message_content]").val("");
				}
			}
		});
	});
	
	function send_msg(msg) {
		data = {};
		data["sender_id"] = current_user["oid"];
		data["chat_conversation_id"] = <?php echo $chat_conversation_id?>;
		data["message"] = msg;
		$.ajax({
			url: "<?php echo base_url('index.php/message/send_message')?>",
			data: data,
			method: "POST",
			dataType: 'json',
			success: function(status) {
				console.log(status);
			}
		});
	}
	function get_all_messages_for_a_conversation(conversation_id) {
		data = {};
		data["conversation_id"] = conversation_id;
		$.ajax({
			url: "<?php echo base_url('index.php/message/get_all_messages_for_a_conversation')?>",
			data: data,
			method: "POST",
			dataType: 'json',
			success: function(chat_data) {
				console.log(data);
				construct_message_view(chat_data, friend_data);
			}
		});
	}
	function insert_new_message_to_view(msg, picture){
		html_str = "";
		html_str += '<div class="message--send">';
		html_str += '<div class="message__bubble--send">' + msg + '</div>';
		html_str += '<figure class="message__avatar">';
		html_str += '<img src="' + picture + '" />';
		html_str += '</figure>';
		html_str += '</div>';
		html_str += '<div class="cf"></div>';
		$('.message-view').append(html_str);
	}
	function construct_message_view(chat_data, friend_data){
		var html_str = "";
		current_user_id = current_user["oid"];
		for (i=0; i < chat_data.length; i++) {
			msg = chat_data[i];
			if (msg["sender"] == current_user_id) {
				html_str += '<div class="message--send">';
				html_str += '<div class="message__bubble--send">' + msg["message"] + '</div>';
				html_str += '<figure class="message__avatar">';
				html_str += '<img src="' + current_user_picture + '" />';
				html_str += '</figure>';
				html_str += '</div>';
			} else {
				picture = "<?php echo base_url("static/upload/")?>" + "/" + friend_data["picture"];
				html_str += '<div class="message">';
				html_str += '<figure class="message__avatar">';
				html_str += '<img src="' + picture + '" />';
				html_str += '</figure>'
				html_str += ' <div class="message__bubble">' + msg["message"] +  '</div>';
				html_str += '</div>';
			}
			html_str += '<div class="cf"></div>';
		}
		$('.message-view').html(html_str);
	}
</script>
</html>
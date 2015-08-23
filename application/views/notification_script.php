<script>
function NGOCTRAN_NOTIFICATION() {
	var SELF = this;
	<?php if ($this->session->userdata ( 'username' )) {?>
	SELF.user = <?php echo json_encode ($this->session->userdata()) ?>,
	<?php }?>
	SELF.pusher_connection_socket_id = null;
	SELF.pusher = null;
	SELF.user_id = SELF.user["oid"];
	SELF.notification_count = 0;
	SELF.invokeNotificationPanel = function(message) {
		notification_panel = new NotificationFx({
			wrapper : document.body,
			message : message,
			layout : 'growl',
			effect : 'genie',
			type : 'notice', // notice, warning or error
			onClose : function() {
			}
		});
		notification_panel.show();
	}
	//channel initalize
	<?php if ($this->session->userdata('oid')) { ?>
		SELF.pusher = new Pusher('612cb18b054eb8cc1309', { authEndpoint: '<?php echo base_url("/index.php/user/pusher_authentication"); ?>' });
		var channel = SELF.pusher.subscribe('new_attention_notification_channel_' + SELF.user_id);
		channel.bind('new_attention_notification_event', function(data) {
			SELF.invokeNotificationPanel(data.message_panel);
			SELF.addNewNotificationTop(jQuery.parseJSON(data.message_top));
		});
	<?php } ?>
	
	SELF.setupNotificationAtStart = function () {
		console.log("setupNotificationAtStart");
		$.post('<?php echo base_url("/index.php/notify/retrieve_all"); ?>', {user_id : SELF.user_id}, function(data){
			if (data.length>0) {
				dataJson = jQuery.parseJSON(data);
				console.log(dataJson['results'][0]);
				
				SELF.notification_count = dataJson['unseen_notification'];
				$('.js-count').attr('data-count', SELF.notification_count).html(SELF.notification_count);

				var d = dataJson['results'];
				$(d).each(function(index){
					if (d[index]['status'] == 'seen') {
						status = 'expired'
					} else {
						status = '';
					}
					itemStr = 	'<li class="item js-item '+ status + '" data-id="'+ d[index]['id'] +'">' +
								'<a href="#">' +
		            			'<div class="details">' +
		            				'<span class="title">' + d[index]['title'] + '</span>' +
		            				'<span class="date">' + d[index]['created_date'] +'</span>' +
		          				'</div>' +
		          				'<button data-href="'+d[index]["url"]+'"type="button" class="button-default button-dismiss js-dismiss">×</button>' +
		          				'</a>' +
		        				'</li>';
					$('.notifications-list').prepend(itemStr);
				});
				
			}
		});
	},
	SELF.handleNotificationTopAction = function(){
		var cssTransitionEnd = getTransitionEnd();
		var container = $('body');
		$('.js-show-notifications').click(function(){
			$('.js-notifications').toggleClass('notifications-active');
			$('.js-dismiss').click(function(event){
				
				var addressValue = $(this).data("href");
				$.post(addressValue, function(){
					console.log("remove notification");
				});
				
				var item = $(event.currentTarget).parents('.js-item');
				console.log( item[0]);
				var removeItem = function() {
					item[0].removeEventListener(cssTransitionEnd, removeItem, false);
					item.remove();
			        
			        /* update notifications' counter */
			        var countElement = container.find('.js-count');
			        var prevCount = +countElement.attr('data-count');
			        var newCount = prevCount - 1;
			        countElement
			          .attr('data-count', newCount)
			          .html(newCount);
			        
			        if(newCount === 0) {
			          countElement.remove();
			          container.find('.js-notifications').addClass('empty');
			        }
			      };
			      
			      item[0].addEventListener(cssTransitionEnd, removeItem, false);
			      item.addClass('dismissed');
			      return true;
			});
		});
		
		function getTransitionEnd() {
			var supportedStyles = window.document.createElement('fake').style;
			var properties = {
					'webkitTransition': { 'end': 'webkitTransitionEnd' },
					'oTransition': { 'end': 'oTransitionEnd' },
					'msTransition': { 'end': 'msTransitionEnd' },
					'transition': { 'end': 'transitionend' }
			};
			var match = null;
			Object.getOwnPropertyNames(properties).forEach(function(name) {
				if (!match && name in supportedStyles) {
					match = name;
					return;
				}
			});
			return (properties[match] || {}).end;
		}
	},
	SELF.addNewNotificationTop = function(item) {
		itemStr = '<li class="item js-item {{#isExpired}}expired{{/isExpired}}" data-id="{{id}}">' +
        			'<div class="details">' +
        				'<span class="title">' + item.title + '</span>' +
        				'<span class="date">' + item.created_date +'</span>' +
      				'</div>' +
      				'<button type="button" class="button-default button-dismiss js-dismiss">×</button>' +
    			'</li>';
		$('.notifications-list').prepend(itemStr);
		//update count
		SELF.notification_count += 1;
		$('.js-count').attr('data-count', SELF.notification_count).html(SELF.notification_count);
	}
}
	var ngoctran_notification = new NGOCTRAN_NOTIFICATION();
	
	$(function () {
		console.log("private");
		ngoctran_notification.handleNotificationTopAction();
		ngoctran_notification.setupNotificationAtStart();
	});

</script>
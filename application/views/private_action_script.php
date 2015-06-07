<script>
	function NGOCTRAN_PERSONAL() {
		var SELF = this;
		<?php if ($this->session->userdata ( 'username' )) {?>
		SELF.user = <?php echo json_encode ($this->session->userdata()) ?>,
		<?php }?>
		SELF.likeUser = function() {
			var ajaxData = {};
			ajaxData["current_user_id"] = SELF.user["oid"];
			ajaxData["favorite_user_id"] = <?php echo $oid ?>;
			$.ajax({
				url: "<?php echo base_url('index.php/like/like_user')?>",
				data: ajaxData,
				dataType: 'json',
				method: 'POST',
				success: function(status) {
					console.log(status);
					html_str = '<a href="#" class="button tiny alert" id="unlike_user">';
					html_str += '<i class="fa fa-thumbs-down"></i> Unlike</a>';
					$('.like-unlike-item').html(html_str);
					$('#unlike_user').click(SELF.unlikeUser);
				}
			});
		},
		SELF.unlikeUser = function() {
			var ajaxData = {};
			ajaxData["current_user_id"] = SELF.user["oid"];
			ajaxData["favorite_user_id"] = <?php echo $oid ?>;
			$.ajax({
				url: "<?php echo base_url('index.php/like/unlike_user')?>",
				data: ajaxData,
				dataType: 'json',
				method: 'POST',
				success: function(status) {
					console.log(status);
					html_str = '<a href="#" class="button tiny success" id="like_user">';
					html_str += '<i class="fa fa-thumbs-up"></i> Like</a>'
					$('.like-unlike-item').html(html_str);
					$('#like_user').click(SELF.likeUser);
				}
			});
		},
		SELF.setupLikeUnlikeUser = function(){
			$('#like_user').click(function(){
				SELF.likeUser();
			});
			$('#unlike_user').click(function(){
				SELF.unlikeUser();
			});
		}
	}
	var ngoctran_personal = new NGOCTRAN_PERSONAL();
	$(document).ready(function(){
		console.log(ngoctran_personal.user);
		ngoctran_personal.setupLikeUnlikeUser();
	});
</script>
<script>
	function NGOCTRAN_REGISTER() {
		var SELF = this;
		SELF.validateAgeRange = function () {
			$
			var $from = $('input[name=from-age]'),
				$to = $('input[name=to-age]');
			$to.change(function(){
				$to.attr("min", $from.val());
			});
			
		},
		SELF.setupDatePicker = function () {
			$('.dob').pickadate({
				formatSubmit: 'yyyy-mm-dd',
				format: 'yyyy-mm-dd'
			});
		},
		SELF.setUpProfilePictureUpload = function(){
			 var myDropzone = new Dropzone("div#dropzone_profile_picture", { 
				url: "<?php echo base_url("index.php/user/upload_file");?>",
				paramName: "profile_picture",
				addRemoveLinks: true,
				clickable: true,
				dictDefaultMessage: "Drop file here to upload <br> Max: 1 file",
				acceptedFiles: "image/*",
				maxFiles: "1"
			});
			myDropzone.on("success", function(file, server_response) {
				response = jQuery.parseJSON(server_response);
				$('input[name=profile_picture_name]').val(response["msg"]);
			});
		}
	}
	var ngoctran_register = new NGOCTRAN_REGISTER();
	$(document).ready(function(){
		ngoctran_register.validateAgeRange();
		ngoctran_register.setupDatePicker();
		ngoctran_register.setUpProfilePictureUpload();
	});
</script>
<script>
	function NGOCTRAN() {
		var SELF = this;
		SELF.setupFoundation = function (){
			$(document).foundation();		
		},
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
				formatSubmit: 'dd/mm/yyyy'
			});
		},
		SELF.setUpProfilePictureUpload = function(){
			$(".profile_picture").change(function () {
		        if (this.files && this.files[0]) {
		            var reader = new FileReader();
		            reader.onload = imageIsLoaded;
		            reader.readAsDataURL(this.files[0]);
		        }
		    });
		}
	}
	function imageIsLoaded(e) {
	    $('#profile-picture-img').attr('src', e.target.result);
	};
	var ngoctran = new NGOCTRAN();
	$(document).ready(function(){
		ngoctran.setupFoundation();
		ngoctran.validateAgeRange();
		ngoctran.setupDatePicker();
		ngoctran.setUpProfilePictureUpload();
	});
</script>
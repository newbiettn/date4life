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
			
		}
	}
	var ngoctran = new NGOCTRAN();
	$(document).ready(function(){
		ngoctran.setupFoundation();
		ngoctran.validateAgeRange();
	});
</script>
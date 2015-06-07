<script>
	function NGOCTRAN() {
		var SELF = this;
		SELF.setupFoundation = function (){
			$(document).foundation();		
		}
	}
	var ngoctran = new NGOCTRAN();
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		ngoctran.setupFoundation();
	});
</script>
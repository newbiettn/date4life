<?php include 'metadata.php'?>
<body>
	<?php include 'nav.php'?>
	<?php if (isset($new_update)) {?>
	<div class="row">
		<div class="large-9 large-centered columns container">
			<h4>Update successfully!</h4>	
		</div>
	</div>
	<?php }?>
	<div class="row">
		<div class="large-9 large-centered columns container">
			<h3>Edit personal information</h3>
			<p>You can update your personal information</p>
			<?php echo form_open('profile/edit_personal_profile'); ?>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Marital Status</label>
							</div>
							<div class="small-9 columns">
								<select name="marital_status">
								<?php if (strlen($marital_status) >0) {
									if ($marital_status == "single") {
										echo '<option selected value="single">Single</option><option value="married">Married</option><option value="separated">Separated</option><option value="divorced">Divorced</option><option value="widowed">Widowed</option>';
									} else if ($marital_status == "married") {
										echo '<option value="single">Single</option><option selected value="married">Married</option><option value="separated">Separated</option><option value="divorced">Divorced</option><option value="widowed">Widowed</option>';
									} else if ($marital_status == "separated") {
										echo '<option value="single">Single</option><option value="married">Married</option><option selected value="separated">Separated</option><option value="divorced">Divorced</option><option value="widowed">Widowed</option>'; 
									} else if ($marital_status == "divorced") {
										echo '<option value="single">Single</option><option value="married">Married</option><option value="separated">Separated</option><option selected value="divorced">Divorced</option><option value="widowed">Widowed</option>'; 
									} else if ($marital_status == "widowed") {
										echo '<option value="single">Single</option><option value="married">Married</option><option value="separated">Separated</option><option value="divorced">Divorced</option><option selected value="widowed">Widowed</option>'; 
									}} else {
									?>
									<option value="single">Single</option>
									<option value="married">Married</option>
									<option value="separated">Separated</option>
									<option value="divorced">Divorced</option>
									<option value="widowed">Widowed</option>
								
								<?php }?>
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Amount of children</label>
							</div>
							<div class="small-9 columns">
								<select name="amount_of_children">
								<?php if (strlen($amount_of_children) > 0 ){
									if ($amount_of_children == 0) {
										echo '<option selected value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>';
									} else if ($amount_of_children == 1) {
										echo '<option value="0">0</option>
											<option selected value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>';
									} else if ($amount_of_children == 3) {
										echo '<option value="0">0</option>
											<option value="1">1</option>
											<option selected value="2">2</option>
											<option value="3">3</option>';
									} else {
										echo '<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option selected value="3">3</option>';
									}
								} else {?>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								<?php }?>
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Eye color</label>
							</div>
							<div class="small-9 columns">
								<select name="eye_color">
								<?php if (strlen($eye_color) > 0 ){
									if ($eye_color == "amber") {
										echo '<option selected value="amber">Amber</option>
									<option value="blue">Blue</option>
									<option value="brown">Brown</option>
									<option value="gray">Gray</option>';
									} else if ($eye_color == "blue") {
										echo '<option value="amber">Amber</option>
									<option selected value="blue">Blue</option>
									<option value="brown">Brown</option>
									<option value="gray">Gray</option>';
									} else if ($eye_color == "brown") {
										echo '<option value="amber">Amber</option>
									<option value="blue">Blue</option>
									<option selected value="brown">Brown</option>
									<option value="gray">Gray</option>';
									} else {
										echo '<option value="amber">Amber</option>
									<option value="blue">Blue</option>
									<option value="brown">Brown</option>
									<option selected value="gray">Gray</option>';
									}
								} else {?>
									<option value="amber">Amber</option>
									<option value="blue">Blue</option>
									<option value="brown">Brown</option>
									<option value="gray">Gray</option>
								<?php }?>
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Hair color</label>
							</div>
							<div class="small-9 columns">
								<select name="hair-color">
								<?php if (strlen($hair_color) > 0 ){
									if ($hair_color == "black") {
										echo '<option selected value="black">Black</option>
									<option value="brown">Brown</option>
									<option value="blond">Blond</option>
									<option value="auburn">Auburn</option>';
									} else if ($hair_color == "brown") {
										echo '<option value="black">Black</option>
									<option selected value="brown">Brown</option>
									<option value="blond">Blond</option>
									<option value="auburn">Auburn</option>';
									} else if ($hair_color == "blond") {
										echo '<option value="black">Black</option>
									<option value="brown">Brown</option>
									<option selected value="blond">Blond</option>
									<option value="auburn">Auburn</option>';
									} else {
										echo '<option value="black">Black</option>
									<option value="brown">Brown</option>
									<option value="blond">Blond</option>
									<option selected value="auburn">Auburn</option>';
									}
								} else {?>
									<option value="black">Black</option>
									<option value="brown">Brown</option>
									<option value="blond">Blond</option>
									<option value="auburn">Auburn</option>
								<?php }?>
								
									
								</select>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Clothing style</label>
							</div>
							<div class="small-9 columns">
								<input type="text" name="clothing-style" value="<?php echo $clothing_style;?>"/>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Nationality</label>
							</div>
							<div class="small-9 columns">
								<input type="text" name="nationality" value="<?php echo $nationality;?>"/>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Knowledge of language</label>
							</div>
							<div class="small-9 columns">
								<input type="text" name="languages" value="<?php echo $languages;?>"/>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Occupation</label>
							</div>
							<div class="small-9 columns">
								<input type="text" name="occupation" value="<?php echo $occupation;?>"/>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Degree</label>
							</div>
							<div class="small-9 columns">
								<input type="text" name="degree" value="<?php echo $degree;?>"/>
        					</div>
						</div>
					</div>
					<div class="large-9">
						<div class="row">
							<div class="small-3 columns">
								<label for="right-label" class="right">Favorite</label>
							</div>
							<div class="small-9 columns">
								<ul id=singleFieldTags></ul>
								<input type="hidden" name="favorite" id="mySingleField" value="<?php echo $favorite;?>"/>
        					</div>
						</div>
					</div>
					
					<div class="large-9">
						<div class="row">
							<div class="small-3 large-offset-5 columns">
								<input class="button small" type="submit" value="Update"/>
        					</div>
						</div>
					</div>
			</form>
		</div>
	</div>
	<?php require 'footer.php'?>
</body>
<script type="text/javascript">
    $(document).ready(function() {
    	$('#singleFieldTags').tagit({
    		autocomplete: false,
            singleField: true,
            singleFieldNode: $('#mySingleField')
        });
    
    });
</script>
</html>

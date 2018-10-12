<?php include(__DIR__ . '/../vars.php'); ?>

<script type="text/javascript">
	function verifyForm(requiredFields) {
		var errors = false;

		requiredFields.forEach(function(field) {
			var elem = document.getElementsByName(field)[0];
			var help = document.getElementById(field + '-help');

			if(elem.value == '') {
				errors = true;

				elem.classList.add('is-danger');
				help.classList.remove('is-hidden');
			}

			else {
				elem.classList.remove('is-danger');
				help.classList.add('is-hidden');
			}
		});

		if(errors) 
			return false;

		return true;
	}

	function toggleModal() {
		var landingFormModal = document.getElementById('landing-form-modal');

		landingFormModal.classList.toggle("is-active");
	}

	function form1() {
		if(verifyForm(['fromZip', 'toZip', 'toState']))
			toggleModal();
	}

	function form2() {
		var landingForm = document.getElementById('landing-form');

		if(verifyForm(['date', 'type', 'firstName', 'lastName', 'email', 'phone'])) {
			toggleModal();
			landingForm.submit();
		}
	}
</script>

<?php
	if(isset($_POST['submit']) && !get_post_id_by_meta_key_and_value('email', $_POST["email"])) {
		$postarr = array(
			'post_title' => $_POST['firstName'] . ' ' . $_POST['lastName'],
			'post_type' => 'client',
			'post_status'  => 'publish'
		);

		$postId = wp_insert_post($postarr);

		update_post_meta($postId, "email", $_POST["email"]);
		update_post_meta($postId, "phone", $_POST["phone"]);
		update_post_meta($postId, "from", $_POST["fromZip"]);
		update_post_meta($postId, "to", $_POST["toState"] . ', ' . $_POST["toZip"]);
		update_post_meta($postId, "type", $_POST["type"]);
		update_post_meta($postId, "auto_transport", $_POST["auto_transport"]);
	}
?>

<form id="landing-form" action="" method="post" onsubmit="form2(); return false;">
	<div id="landing-form-modal" class="modal">
		<div class="modal-background" onclick="toggleModal()"></div>
		<div class="modal-content">
			<div class="box">
				<div class="has-text-centered">
			    	<figure class="image is-96x96 is-centered">
						<img src="<?=wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0];?>" alt="Logo">
					</figure>
					<h4 class="title is-4 has-text-grey-dark">Last Step</h4>
				</div>

				<hr/>

				<div class="field is-horizontal">
				  <div class="field-body">
				    <div class="field">
				      <div class="control">
					  	<label class="label">When:</label>
					    <input class="input" type="date" name="date" />
					  </div>
					  <p id="date-help" class="help is-danger is-hidden">Required</p>
				    </div>
				    <div class="field">
				      <div class="control">
					  	<label class="label">Size:</label>
					    <div class="select is-max-width">
					      <select name="type">
					        <option value="Local">Local</option>
					        <option value="Long Distance">Long Distance</option>
					        <option value="Auto Transport">Auto Transport</option>
					        <option value="International">International</option>
					      </select>
					    </div>
					  </div>
					  <p id="type-help" class="help is-danger is-hidden">Required</p>
				    </div>
				  </div>
				</div>

				<div class="field is-horizontal">
				  <div class="field-body">
				    <div class="field">
				      <div class="control">
					  	<label class="label">First Name:</label>
					    <input class="input" type="text" name="firstName" placeholder="John"/>
					  </div>
					  <p id="firstName-help" class="help is-danger is-hidden">Required</p>
				    </div>
				    <div class="field">
				      <div class="control">
					  	<label class="label">Last Name:</label>
					    <input class="input" type="text" name="lastName" placeholder="Doe" />
					  </div>
					  <p id="lastName-help" class="help is-danger is-hidden">Required</p>
				    </div>
				  </div>
				</div>

				<div class="field is-horizontal">
				  <div class="field-body">
				    <div class="field">
				      <div class="control">
					  	<label class="label">Email:</label>
					    <input class="input" type="text" name="email" placeholder="john@gmail.com"/>
					  </div>
					  <p id="email-help" class="help is-danger is-hidden">Required</p>
				    </div>
				    <div class="field">
				      <div class="control">
					  	<label class="label">Phone Number:</label>
					    <input class="input" type="text" name="phone" placeholder="888-888-8888" />
					  </div>
					  <p id="phone-help" class="help is-danger is-hidden">Required</p>
				    </div>
				  </div>
				</div>

				<div class="field is-horizontal">
					<p class="has-text-grey-light is-size-7">
						* Don't worry If you're not comfortable with giving your phone, you can always ask the representitives not to call you, but please provide a correct number so we can reach you in case of a problem.<br/>
						* By participating, you agree to our terms of use, privacy policy and receiving prerecorded ivr calls and text messages.
					</p>
				</div>

				<button class="button is-secondary is-fullwidth is-large" name="submit">Submit</button>
			</div>
		</div>
	</div>

	<div class="field">
	  <label class="label">From: </label>
	  <div class="control has-icons-right">
	    <input class="input" type="text" name="fromZip" placeholder="Zip Code">
	    <span class="icon is-small is-right">
	      <i class="fas fa-location-arrow"></i>
	    </span>
	  </div>
	  <p id="fromZip-help" class="help is-danger is-hidden">Required</p>
	</div>

	<div class="field is-horizontal">
	  <div class="field-body">
	    <div class="field">
	      <div class="control">
		  	<label class="label">To:</label>
		    <div class="select is-max-width">
		      <select name="toState">
		        <option value="">Select State</option>
		        <?php foreach ($states as $state) { ?>
		        	<option value="<?=$state?>"><?=$state?></option>
		        <?php } ?>
		      </select>
		    </div>
		    <p id="toState-help" class="help is-danger is-hidden">Required</p>
		  </div>
	    </div>
	    <div class="field">
	      <div class="control">
		  	<label class="label">&nbsp;</label>
		    <input class="input" type="text" name="toZip" placeholder="Zip Code" />
		  </div>
		  <p id="toZip-help" class="help is-danger is-hidden">Required</p>
	    </div>
	  </div>
	</div>

	<div class="field">
	  <div class="control">
	    <a class="button is-fullwidth is-secondary is-medium" onclick="form1()">Get Free Quotes</a>
	  </div>
	</div>	
</form>
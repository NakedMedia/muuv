<?php include(__DIR__ . '/../vars.php'); ?>

<script type="text/javascript">
	function toggleModal() {
		var landingFormModal = document.getElementById('landing-form-modal');

		landingFormModal.classList.toggle("is-active");
	}
</script>

<?php

	if(isset($_POST['submit'])) {
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

<form action="" method="post">
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
				    </div>
				    <div class="field">
				      <div class="control">
					  	<label class="label">Last Name:</label>
					    <input class="input" type="text" name="lastName" placeholder="Doe" />
					  </div>
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
				    </div>
				    <div class="field">
				      <div class="control">
					  	<label class="label">Phone Number:</label>
					    <input class="input" type="text" name="phone" placeholder="888-888-8888" />
					  </div>
				    </div>
				  </div>
				</div>

				<div class="field is-horizontal">
					<p class="has-text-grey-light is-size-7">
						* Don't worry If you're not comfortable with giving your phone, you can always ask the representitives not to call you, but please provide a correct number so we can reach you in case of a problem.<br/>
						* By participating, you agree to our terms of use, privacy policy and receiving prerecorded ivr calls and text messages.
					</p>
				</div>

				<button class="button is-secondary is-fullwidth is-large" type="submit" name="submit">Submit</button>
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
	</div>

	<div class="field is-horizontal">
	  <div class="field-body">
	    <div class="field">
	      <div class="control">
		  	<label class="label">To:</label>
		    <div class="select is-max-width">
		      <select name="toState">
		        <option>Select State</option>
		        <?php foreach ($states as $state) { ?>
		        	<option value="<?=$state?>"><?=$state?></option>
		        <?php } ?>
		      </select>
		    </div>
		  </div>
	    </div>
	    <div class="field">
	      <div class="control">
		  	<label class="label">&nbsp;</label>
		    <input class="input" type="text" name="toZip" placeholder="Zip Code" />
		  </div>
	    </div>
	  </div>
	</div>

	<div class="field">
	  <div class="control">
	    <a class="button is-fullwidth is-secondary is-medium" onclick="toggleModal()">Get Free Quotes</a>
	  </div>
	</div>	
</form>
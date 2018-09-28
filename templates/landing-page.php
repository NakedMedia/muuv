<?php /* Template Name: Landing Page */ ?>

<?php get_header(); ?>

<section class="hero is-medium" style="background-image: url('<?= get_the_post_thumbnail_url(''); ?>');">
  <div class="hero-body">
	<div class="columns is-marginless">
	  	<div class="column is-one-third has-medium-padding card">
	  		<h3 class="title">100% Free Moving Quotes From The Best Moving Companies Near You</h3>
	  		<form>
		  		<div class="field">
				  <label class="label">From: </label>
				  <div class="control has-icons-right">
				    <input class="input" type="email" placeholder="Zip Code">
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
					      <select>
					        <option>Select State</option>
					        <option>With options</option>
					      </select>
					    </div>
					  </div>
				    </div>
				    <div class="field">
				      <div class="control">
					  	<label class="label">&nbsp;</label>
					    <div class="select is-max-width">
					      <select>
					        <option>Select City</option>
					        <option>With options</option>
					      </select>
					    </div>
					  </div>
				    </div>
				  </div>
				</div>

				<div class="field">
				  <div class="control">
				    <button class="button is-fullwidth">Submit</button>
				  </div>
				</div>
			</form>
	  	</div>
	</div>
  </div>
</section>
<section class="section">
	<div class="container">
		<h2 class="title is-2 has-text-centered">Compare Moving Quotes From <br/> Top Moving Companies</h2>
		<hr class="yellow-bar" />
		<h5 class="subtitle is-5 has-text-centered has-text-weight-light">Look no further, using cutting edge technologies, you will get quotes from top moving companies and movers in your area. We will be guiding you through the process and supplying with tips to get the best price for value.</h5>
	</div>
</section>

<?php get_footer(); ?>
<?php /* Template Name: Landing Page */ ?>

<?php get_header(); ?>

<section id="get-quotes" class="hero is-medium" style="background-image: url('<?= get_the_post_thumbnail_url(''); ?>');">
  <div class="hero-body container">
	<div class="columns is-marginless">
	  	<div class="column is-half has-medium-padding card">
	  		<h3 class="title is-3">100% Free Moving Quotes From The Best Moving Companies Near You</h3>
	  		
	  		<?php include(__DIR__ . '/../common/components/landing-form-modal.php') ?>

	  	</div>
	</div>
  </div>
</section>
<section class="section">
	<div class="container">
		<h2 class="title is-2 has-text-centered is-marginless">Compare Moving Quotes From Top Moving Companies</h2>
		<hr class="bar-secondary is-centered" />
		<h6 class="subtitle is-6 has-text-centered has-text-weight-light has-text-grey">Look no further, using cutting edge technologies, you will get quotes from top moving companies and movers in your area. We will be guiding you through the process and supplying with tips to get the best price for value.</h6>
		<div class="level">
			<figure class="level-item landing-mover-card">
				<img src="<?= get_template_directory_uri() . "/img/indi-mover-card.png"?>"/>
			</figure>
			<figure class="level-item landing-mover-card">
				<img src="<?= get_template_directory_uri() . "/img/ne-mover-card.png"?>"/>
			</figure>
			<figure class="level-item landing-mover-card">
				<img src="<?= get_template_directory_uri() . "/img/ld-mover-card.png"?>"/>
			</figure>
		</div>
	</div>
</section>
<section class="section has-background-white-ter">
	<div class="container">
		<div class="level">
			<figure class="level-item">
				<img src="<?= get_template_directory_uri() . "/img/truck1.png"?>"/>
			</figure>
			<div class="level-item">
				<div>
					<h2 class="title is-2 is-marginless">Accurate, Fast,Reliable</h2>
					<hr class="bar-secondary" />
					<h6 class="subtitle is-6 has-text-weight-light has-text-grey">Time is precious. That’s why we’re dedicated to providing you accurate and reliable service delivered in the quickest possible way, you can expect getting the quotes in minutes.</h6>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hero is-primary phone-hero">
	<div class="hero-body is-paddingless">
		<div class="container has-text-centered-mobile">
			<div class="level">
				<div class="level-item">
					<div>
						<h1 class="title is-1">Multiple Quotes, Single Click</h1>
						<h6 class="subtitle is-6">No need to look elsewhere. Save time and get multiple quotes from our top matching companies with just one click. You’ll see full price breakdown, no hidden fees.</h6>
						<br/>
						<h1 class="title is-1">Top Caliber Movers</h1>
						<h6 class="subtitle is-6">Get nothing but the best. We filter and pre-screen all our moving service providers before adding them to our roster. This ensures that only certified and positively-rated movers.</h6>
					</div>
				</div>
				<figure class="level-item">
					<img src="<?= get_template_directory_uri() . "/img/phone-quotes.png"?>"/>
				</figure>
			</div>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<div class="level">
			<figure class="level-item">
				<img src="<?= get_template_directory_uri() . "/img/dialog.png"?>"/>
			</figure>
			<div class="level-item">
				<div>
					<h2 class="title is-2 is-marginless">Book Your Move in Minutes</h2>
					<hr class="bar-secondary" />
					<h6 class="subtitle is-6 has-text-weight-light has-text-grey">Though our cutting edge technology, companies’ representatives will be able to contact you online regarding your move, from there you will be able to book in minutes, absolutely with no hassles.</h6>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hero is-primary is-medium" style="background-image: url('<?= get_template_directory_uri() . "/img/map-bg.png"?>');">
	<div class="hero-body">
		<div class="container has-text-centered-mobile">
			<h4 class="title is-4 is-marginless">Call Now <?= get_theme_mod('phone_number'); ?> or</h4>
			<h6 class="subtitle is-6 has-text-weight-light">Fill in the form for a free quote</h6>
			<hr class="bar-secondary" />
			<a href="./#get-quotes" class="button is-white is-large">Get Free Quotes!</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
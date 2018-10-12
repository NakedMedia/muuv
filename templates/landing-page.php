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
		<h2 class="title is-2 has-text-centered is-marginless">Where Can I Look For<br class="is-hidden-mobile" /> The Best Moving Companies?</h2>
		<hr class="bar-secondary is-centered" />
		<h6 class="subtitle is-6 has-text-centered has-text-weight-light has-text-grey">If you are looking to hire movers, take a good look at your best options. Look into customer<br class="is-hidden-mobile"/> reviews and summaries all in one place. With our friendly and up to date staff, we can help find the perfect movers for you.</h6>
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
					<h2 class="title is-2 is-marginless has-text-centered-mobile">Dependable And Fast</h2>
					<hr class="bar-secondary is-centered-mobile" />
					<h6 class="subtitle is-6 has-text-weight-light has-text-grey has-text-centered-mobile">Speed is important, so we dedicate our time and<br class="is-hidden-mobile" /> efforts to getting you where you need to go faster.<br class="is-hidden-mobile" /> Doing things faster though doesn't keep us from doing a job well done.<br class="is-hidden-mobile" /> Get all the quotes you need today!</h6>
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
						<h1 class="title is-1">All The Quotes,<br class="is-hidden-mobile" /> None Of The Work</h1>
						<h6 class="subtitle is-6">We have the highest ranking mover businesses and their reviews<br class="is-hidden-mobile" /> conveniently listed for you. We also include moving rates to compare.</h6>
						<br/>
						<h1 class="title is-1">Settle Only For The Best</h1>
						<h6 class="subtitle is-6">All Movers we recommend have been hand-picked and personally tested by us.<br class="is-hidden-mobile" /> Only qualified professionals, that offer more than a skilled and troubleless move, can make our list.</h6>
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
					<h2 class="title is-2 is-marginless has-text-centered-mobile">Quick And Easy</h2>
					<hr class="bar-secondary is-centered-mobile" />
					<h6 class="subtitle is-6 has-text-weight-light has-text-grey has-text-centered-mobile">Once you've made your decision, hire them<br class="is-hidden-mobile" /> the same place you found them, it's that easy!</h6>
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
			<hr class="bar-secondary is-centered-mobile" />
			<a href="./#get-quotes" class="button is-white is-large">Get Free Quotes!</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

		<footer id="colophon" class="site-footer">
			<div class="hero is-medium is-dark has-text-centered">
				<div class="hero-body">
					<figure class="has-text-centered">
						<img src="<?=wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0];?>" alt="Logo">
					</figure>
					<h4 class="title is-4">Call us at any time:</h4>
					<h2 class="title is-2 has-text-secondary"><?= get_theme_mod('phone_number'); ?></h2>
				</div>
			</div>
			<div class="hero is-primary is-small">
				<div class="hero-body">
					<h6 class="title is-6 has-text-centered has-text-weight-light">© Copyright 2018, all rights reserved.</h6>
				</div>
			</div>
		</footer>
	</div><!-- #root -->

	<?php wp_footer(); ?>

</body>
</html>

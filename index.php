<?php get_header();?>
<?php if( have_posts()): while ( have_posts()): the_post(); ?>
<div class="top-container">
	<video class="background-vid hide-laptops" id="backgroundVid" preload autoplay muted playsinline loop>
		<source src="<?php echo(get_template_directory_uri() . "/img/planet.mp4");?>">
	</video>
	<div class="header-nav">
		<!-- <div class="animated-veil"></div> -->
		<img class="logo-dark hidden" src="<?php echo(get_template_directory_uri() . "/img/logo_dark.png");?>"/>
		<img class="logo-light" src="<?php echo(get_template_directory_uri() . "/img/logo_light.png");?>"/>
		<nav class="navigation hide-tablets">
			<a href="#leistungen" class="nav-item">Leistungen</a>
			<a href="#referenzen" class="nav-item">Referenzen</a>
			<a href="#technologien" class="nav-item">Technologien</a>
			<a href="#projekte" class="nav-item hide-laptops">Eigene Projekte</a>
			<a href="#impressum" class="nav-item hide-large">Impressum</a>
		</nav>

		<button class="contact-btn hide-mobile">Kontakt </button>
		<span class="dashicons dashicons-email show-mobile contact-icon"></span>
	</div>
	<div class="about-me-block">
		<h1 class="animated">Angelos Ioannou</h1>
		<?php $querySubtitle = new WP_Query( array( "category_name" => "subtitle", "oderby"=>"date","order"=>"asc")); ?>
		<?php while ( $querySubtitle->have_posts() ): $querySubtitle->the_post(); ?>
			<div class="subtitle-item" style="display: none"><?php the_field("subtitle");?></div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<h2 id="subtitle-animated">Web-Entwicklung</h2>
		<p class="profile-description hide-mobile"><?php the_field("profile_paragraph");?></p>
	</div>
</div>

<div style="height: 1500px; background-color: grey; width: 100;">
	<p>
	Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	</p>
</div>

<?php endwhile; else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
<?php get_footer();?>
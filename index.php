<?php get_header();?>
<?php if( have_posts()): while ( have_posts()): the_post(); ?>
<div class="top-container">
	<video class="background-vid hide-laptops" id="backgroundVid" preload autoplay muted playsinline loop>
		<source src="<?php echo(get_template_directory_uri() . "/img/planet.mp4");?>">
	</video>
	<div class="header-nav">
		<!-- <div class="animated-veil"></div> -->
		<!-- <img class="logo-dark hidden" src="<?php echo(get_template_directory_uri() . "/img/logo_dark.png");?>"/> -->
		<img class="logo-light" src="<?php echo(get_template_directory_uri() . "/img/logo_light.png");?>"/>
		<nav class="navigation hide-tablets">
			<a href="#aboutMe" class="nav-item">Über mich</a>
			<a href="#leistungen" class="nav-item">Leistungen</a>
			<a href="#referenzen" class="nav-item">Referenzen</a>
			<a href="#technologien" class="nav-item hide-laptops">Technologien</a>
			<a href="#projekte" class="nav-item hide-large">Eigene Projekte</a>
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

<section id="aboutMe">
	<div class="picture-container">
		<img loading="lazy" class="image" src="<?php the_field('profile_picture');?>">
	</div>
	<div class="description-container">
		<h2><?php the_field("subheader");?></h2>
		<p>
			<?php the_field("profile_description");?>
		</p>
	</div>
</section>

<section id="leistungen">
	<h1>Leistungen</h1>
	<div class="leistung-card-container">
		<?php $queryProjects = new WP_Query( array( "category_name" => "leistung")); ?>
			<?php while( $queryProjects->have_posts()): $queryProjects->the_post(); ?>
				<div class="leistung-card">
					<div class="leistung-card__icon"><?php the_field("leistung_icon");?></div>
					<h2 class="leistung-card__header"><?php the_field("leistung_subheader");?></h2>
					<div class="leistung-card__desc"><?php the_field("leistung_desc");?></div>
				</div>
			<?php endwhile;?>
			<!-- necessary for custom loop -->
		<?php wp_reset_postdata();?>
	</div>
</section>

<section id="referenzen">
	referenzen
</section>

<?php endwhile; else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
<?php get_footer();?>
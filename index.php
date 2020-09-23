<?php get_header();?>
<?php if( have_posts()): while ( have_posts()): the_post(); ?>
<div class="top-container">
	<div class="header-nav">
		<div class="animated-veil"></div>
		<img class="logo-dark hidden" src="<?php echo(get_template_directory_uri() . "/img/logo_dark.png");?>"/>
		<img class="logo-light" src="<?php echo(get_template_directory_uri() . "/img/logo_light.png");?>"/>
		<nav class="navigation">
			<a href="#" class="nav-item">Leistungen</a>
			<a href="#" class="nav-item">Referenzen</a>
			<a href="#" class="nav-item">Technologien</a>
			<a href="#" class="nav-item hide-laptops">Eigene Projekte</a>
			<a href="#" class="nav-item hide-large">Impressum</a>
		</nav>

		<button class="contact-btn" id="contactBtn">Kontakt</button>
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

<?php endwhile; else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
<?php get_footer();?>
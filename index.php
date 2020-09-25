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
			<a href="#projekte" class="nav-item hide-laptops">Eigene Projekte</a>
			<a href="#impressum" class="nav-item hide-large">Impressum</a>
		</nav>

		<a href="#kontakt" class="contact-btn hide-mobile">Kontakt </a>
		<a href="#kontakt" class="contact-icon show-mobile"><img src="<?php echo(get_template_directory_uri() . "/img/mail-icon.png");?>"/></a>
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
		<img class="image" src="<?php the_field('profile_picture');?>">
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
					<div class="leistung-card__icon"><img src="<?php the_field("leistung_icon");?>"/></div>
					<h2 class="leistung-card__header"><?php the_field("leistung_subheader");?></h2>
					<div class="leistung-card__desc"><?php the_field("leistung_desc");?></div>
				</div>
			<?php endwhile;?>
			<!-- necessary for custom loop -->
		<?php wp_reset_postdata();?>
	</div>
</section>

<section id="referenzen" style="position: relative;">
	<h1 class="section-header">Referenzen</h1>
	<div class="projects-wrapper">
	<?php $queryProjects = new WP_Query( array( "category_name" => "big_project")); ?>
		<?php while( $queryProjects->have_posts()): $queryProjects->the_post(); ?>
			<div class="project-container">
				<div class="text-container">
					<h2 class="text-container__title"><?php the_field("project_title");?></h2>
					<p class="text-container__desc"><?php the_field("project_desc");?></p>
					<a target="_blank" class="text-container__link" href="<?php the_field("project_link");?>">Besuchen</a>
				</div>

				<div class="image-container">
					<img class="main-image" src="<?php the_field('project_image');?>">
					<img class="responsive-image" src="<?php the_field('responsive_image');?>">
				</div>
			</div>
		<?php endwhile;?>
		<!-- necessary for custom loop -->
	<?php wp_reset_postdata();?>
	</div>
	<div id="kontakt" style="position: absolute; bottom: 150px;"></div>
</section>

<section class="kontakt">
	<form class="form-container" id="kontaktContainer">
		<h1 class="form-header">Kontakt</h1>
		<div class="form-group">
				<input placeholder="Name" type="text" name="name"/>
				<input placeholder="E-Mail" type="email" name="email"/>
		</div>
		<input placeholder="Projekt Name" type="text" name="project"/>

		<label for="desc" style="margin-bottom: 8px;">Beschreibung</label>
		<textarea name="desc" rows=6></textarea>

		<div id="responses"></div>
		<input type="submit" value="Abschicken" class="submit-btn"/>
	</form>
</section>

<section id="projekte">
	<h1 class="section-header">Eigene Projekte</h1>
	<div class="small-projects">
	<?php $querySmallProjects = new WP_Query( array( "category_name" => "small_project")); ?>
		<?php while ( $querySmallProjects->have_posts() ): $querySmallProjects->the_post(); ?>
			<a target="_blank" href="<?php the_field("project_link"); ?>" class="small-project-container">
				<h3 class="small-project__header"><?php the_title(); ?></h3>
				<div class="small-project__desc">
					<?php the_content(); ?>
				</div>
			</a>
		<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	</div>
</section>


<?php endwhile; else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
<?php get_footer();?>
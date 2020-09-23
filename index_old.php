<?php get_header();?>
<div id="loader">
	<div class="sk-chase">
		<div class="sk-chase-dot"></div>
		<div class="sk-chase-dot"></div>
		<div class="sk-chase-dot"></div>
		<div class="sk-chase-dot"></div>
		<div class="sk-chase-dot"></div>
		<div class="sk-chase-dot"></div>
	</div>
</div>

<div class="container" id="contentWrapper">
	<div class="landing-page">
		<div class="bg-image"></div>
		<div class="contact-group">
			<h1>Angelos Ioannou</h1>
			<?php $querySubtitle = new WP_Query( array( "category_name" => "subtitle", "oderby"=>"date","order"=>"asc")); ?>
			<?php while ( $querySubtitle->have_posts() ): $querySubtitle->the_post(); ?>
				<div class="subtitle-item" style="display: none"><?php the_field("subtitle");?></div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<h2 id="subtitle-animated">Web-Entwicklung</h2>
			<button id="contact-btn">Kontakt</button>
		</div>
	</div>

	<div id="modal" class="animated">
		<div class="modal-body">
			<div class="modal-title">
				<h3>Schreib mir!</h3>
				<i class="fa fa-times" id="close-modal" aria-hidden="true"></i>
			</div>
			<form id="modal-form">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name"/>
				</div>

				<div class="form-group">
					<label for="email">E-Mail</label>
					<input type="email" name="email"/>
				</div>

				<div class="form-group">
					<label for="project">Projekt</label>
					<input type="text" name="project"/>
				</div>

				<label for="desc">Beschreibung</label>
				<textarea name="desc" rows=7></textarea>
				<div id="responses"></div>

				<input type="submit" value="Abschicken" class="ai-btn"/>

			</form>
		</div>
	</div>

	<!-- Standard Wordpress Loop -->
	<?php if( have_posts()): while ( have_posts()): the_post(); ?>
	<div class="profile-page">
		<div class="profile-image">
			<img class="image" src="<?php the_field('profile_picture');?>">
		</div>
		<div class="profile-desc">
			<h1>Herzlich <span class="red">Willkommen!</span></h1>
			<!-- Advanced Custom Fields -->
			<h2><?php the_field("subheader");?></h2>
			<p><?php the_field("profile_description");?></p>
		</div>
	</div>

	<h2 class="page-heading">Projekte</h2>
	<div class="projects-page">
		<!-- Another loop to display the Projects -->
		<?php $queryProjects = new WP_Query( array( "category_name" => "big_project")); ?>
		<?php while( $queryProjects->have_posts()): $queryProjects->the_post(); ?>
			<div class="flex-container">
				<div class="project-desc">
					<!-- get Data from advanced custom fields -->
					<span><?php the_field("project_title");?></span>
					<p><?php the_field("project_desc");?></p>
					<a href="<?php the_field("project_link");?>" class="project-button" target="_blank">Besuchen</a>
				</div>
				<div class="project-img">
					<img src="<?php the_field('project_image');?>">
				</div>

			</div>
		<?php endwhile;?>
		<!-- necessary for custom loop -->
		<?php wp_reset_postdata();?>
	</div>


	<h2 class="page-heading">Technologien</h2>
	<div class="skills-page">
		<div class="skills-group">
			<div class="skill">
				<?php the_field("skill1");?>
			</div>
			<div class="skill">
				<?php the_field("skill2");?>
			</div>
			<div class="skill">
				<?php the_field("skill3");?>
			</div>
		</div>
	</div>


	<h2 class="page-heading">Eigene Projekte</h2>
	<div class="custom-projects-page">
		<!-- Loop over Posts with category 'small project' here -->
		<?php $querySmallProjects = new WP_Query( array( "category_name" => "small_project")); ?>
		<?php while ( $querySmallProjects->have_posts() ): $querySmallProjects->the_post(); ?>
			<a target="_blank" href="<?php the_field("project_link"); ?>" class="small-project-container">
				<div><?php the_title(); ?></div>
				<?php the_content(); ?>
			</a>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>


	<?php endwhile; else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
</div>
<?php get_footer();?>
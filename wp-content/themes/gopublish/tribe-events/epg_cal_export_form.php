<?php
/*
Template Name: Events Export Form
*/
?>

<?php get_header(); ?>

	<section class="content export-events">

		<h1>Export</h1>

		<form action="" method="post">

			<h2>Date Range</h2>

			<p>
				Select a date range to pull events from:
			</p>

			<p>
				<label for="startdate">Start:</label>
				<input type="date" name="startdate" value="" />
				<label for="enddate">End:</label>
				<input type="date" name="enddate" value="" />
			</p>

			<h2>Categories</h2>

			<p>
				Select category or categories:
			</p>

			<ul>
				<?php
				$event_categories = get_terms('tribe_events_cat');
				foreach ( $event_categories as $category ) {
					echo '<li>';
					echo '<input type="checkbox" name="categories" value="' . $category->slug . '" /> ' . $category->name;
					echo '</li>';
				}
				?>
			</ul>

			<h2>Regions</h2>

			<p>
				Select a region or regions:
			</p>

			<ul>
				<?php $event_regions = get_terms('event_regions');
				foreach ( $event_regions as $region ) { ?>
					<li>
						<input type="checkbox" name="categories" value="<?php echo $region->slug; ?>" /> <?php echo $region->name; ?>
					</li>
				<?php } ?>
			</ul>

			<p>
				<input type="submit" /> <input type="reset" />
			</p>

		</form>

	</section>

<?php get_footer(); ?>
<?php
/**
 * The template for displaying all pages
 *
 * @package Gold_Rate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

// Determine if this is a commodity page based on slug or title
// In a real scenario, you might use custom fields or a specific template.
// Here we'll do simple string matching for demonstration.
$slug = get_post_field( 'post_name', get_post() );
$is_commodity = false;
$chart_type = 'gold';

if ( strpos($slug, 'gold') !== false ) {
    $is_commodity = true;
    $chart_type = 'gold';
} elseif ( strpos($slug, 'silver') !== false ) {
    $is_commodity = true;
    $chart_type = 'silver';
} elseif ( strpos($slug, 'oil') !== false ) {
    $is_commodity = true;
    $chart_type = 'oil';
}
?>

	<main id="primary" class="site-main container">

		<?php
		while ( have_posts() ) :
			the_post();
            ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>

                <div class="entry-content">
                    <?php 
                    if ( $is_commodity ) {
                        get_template_part( 'template-parts/price-chart', null, array( 'type' => $chart_type ) );
                    }
                    ?>
                    
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gold-rate' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>
            </article>

            <?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();

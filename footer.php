<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
	<footer id="colophon" class="site-footer">
        <div class="container footer-inner">
            <div class="footer-widget-area">
                <h3><?php bloginfo( 'name' ); ?></h3>
                <p>Your trusted source for live Gold, Silver, and Oil rates.</p>
            </div>
            <div class="footer-links">
                <!-- Add footer links here dynamically later -->
            </div>
        </div>
		<div class="site-info container">
            <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

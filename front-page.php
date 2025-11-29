<?php
/**
 * The template for displaying the front page
 *
 * @package Gold_Rate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-inner">
            <div class="hero-content">
                <span class="hero-label">Live Market Data</span>
                <h1 class="hero-title">Track Real-Time <span class="text-gold">Gold</span> & Commodity Rates</h1>
                <p class="hero-desc">Get instant access to live 22K/24K Gold, Silver, and Oil prices with advanced charting and historical data.</p>
                <div class="hero-cta">
                    <a href="<?php echo esc_url( home_url( '/gold/' ) ); ?>" class="btn btn-primary">Check Gold Rate</a>
                    <a href="#market-grid" class="btn btn-outline">View All Markets</a>
                </div>
            </div>
            <div class="hero-chart">
                <!-- Main Gold Chart Widget -->
                <?php get_template_part( 'template-parts/price-chart', null, array( 'type' => 'gold' ) ); ?>
            </div>
        </div>
    </section>

    <!-- Market Grid Section -->
    <section id="market-grid" class="market-grid-section">
        <div class="container">
            <h2 class="section-title">Market Overview</h2>
            <div class="commodity-grid">
                <!-- Gold Card -->
                <a href="<?php echo esc_url( home_url( '/gold/' ) ); ?>" class="commodity-card">
                    <div class="card-icon">🏆</div>
                    <h3>Gold (22K)</h3>
                    <p class="price-display">₹ <span class="live-price" data-commodity="gold">Loading...</span></p>
                    <span class="trend positive">+0.45% ▲</span>
                </a>
                
                <!-- Silver Card -->
                <a href="<?php echo esc_url( home_url( '/silver/' ) ); ?>" class="commodity-card">
                    <div class="card-icon">🥈</div>
                    <h3>Silver</h3>
                    <p class="price-display">₹ <span class="live-price" data-commodity="silver">Loading...</span></p>
                    <span class="trend negative">-0.12% ▼</span>
                </a>
                
                <!-- Oil Card -->
                <a href="<?php echo esc_url( home_url( '/oil/' ) ); ?>" class="commodity-card">
                    <div class="card-icon">🛢️</div>
                    <h3>Crude Oil</h3>
                    <p class="price-display">$ <span class="live-price" data-commodity="oil">Loading...</span></p>
                    <span class="trend positive">+1.2% ▲</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-title">Market Insights</h2>
            <div class="news-grid">
                <?php
                $args = array(
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                );
                $news_query = new WP_Query( $args );

                if ( $news_query->have_posts() ) :
                    while ( $news_query->have_posts() ) :
                        $news_query->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('news-card'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="news-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="news-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="news-excerpt"><?php the_excerpt(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="read-more">Read More &rarr;</a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No recent news available.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

</main>

<style>
/* Hero Styles */
.hero-section {
    padding: var(--spacing-lg) 0;
    background: linear-gradient(to bottom, var(--color-bg-light), rgba(212, 175, 55, 0.05));
}
[data-theme="dark"] .hero-section {
    background: linear-gradient(to bottom, var(--color-bg-light), rgba(0,0,0,0.2));
}
.hero-inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-lg);
    align-items: center;
}
.hero-title {
    font-size: 3rem;
    line-height: 1.2;
    margin-bottom: var(--spacing-md);
}
.text-gold { color: var(--color-gold); }
.hero-cta { display: flex; gap: var(--spacing-sm); }
.btn-outline {
    border: 1px solid var(--color-text-light);
    padding: 0.8rem 1.5rem;
    border-radius: 4px;
    font-weight: 600;
}
[data-theme="dark"] .btn-outline { border-color: var(--color-text-dark); color: var(--color-text-dark); }

/* Market Grid */
.market-grid-section { padding: var(--spacing-lg) 0; }
.commodity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
}
.commodity-card {
    background: var(--color-bg-light);
    padding: var(--spacing-md);
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    text-align: center;
    border: 1px solid transparent;
    transition: transform 0.2s, border-color 0.2s;
}
[data-theme="dark"] .commodity-card { background: #1e1e1e; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
.commodity-card:hover { transform: translateY(-5px); border-color: var(--color-gold); }
.card-icon { font-size: 2.5rem; margin-bottom: var(--spacing-sm); }
.price-display { font-size: 1.5rem; font-weight: 700; margin: 0.5rem 0; }
.trend { font-size: 0.9rem; font-weight: 600; }
.trend.positive { color: #2ecc71; }
.trend.negative { color: #e74c3c; }

/* News Section */
.news-section { padding: var(--spacing-lg) 0; background: rgba(0,0,0,0.02); }
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
}
.news-card {
    background: var(--color-bg-light);
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}
[data-theme="dark"] .news-card { background: #1e1e1e; }
.news-content { padding: var(--spacing-md); }
.read-more { color: var(--color-gold); font-weight: 600; }

@media (max-width: 768px) {
    .hero-inner { grid-template-columns: 1fr; text-align: center; }
    .hero-cta { justify-content: center; }
}
</style>

<?php
get_footer();

<?php
/**
 * Vascular Grace — page.php
 *
 * Default page fallback template. Used only if a page has no
 * specific page template selected. All named templates in
 * page-templates/ take precedence via the Template Name header.
 *
 * @package VascularGrace
 */

get_header();
?>
    <main class="site-main py-large">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>">
                    <h1><?php the_title(); ?></h1>
                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </main>
<?php
get_footer();

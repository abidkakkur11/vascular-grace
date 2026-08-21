<?php
/**
 * Vascular Grace — index.php
 *
 * Fallback template. WordPress requires this file.
 * All actual pages use named page templates from page-templates/.
 *
 * @package VascularGrace
 */

get_header();
?>
    <main class="site-main py-large">
        <div class="container">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
            else :
                ?>
                <p><?php esc_html_e( 'No content found.', 'vascular-grace' ); ?></p>
                <?php
            endif;
            ?>
        </div>
    </main>
<?php
get_footer();

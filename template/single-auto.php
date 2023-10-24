<?php
/**
 * The main single item template file.
 *
 * @package kadence
 */

namespace Kadence;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

kadence()->print_styles( 'kadence-content' );

/**
* Hook for Hero Section
*/
do_action( 'kadence_hero_header' );
?>
<div id="primary" class="content-area" style="margin-top:0">
	<div class="content-container site-container">
		<main id="main" class="site-main" role="main">
			<?php
			/**
			 * Hook for anything before main content
			 */
			do_action( 'kadence_before_main_content' );
			?>
			<div class="content-wrap">
				<?php
				if ( is_404() ) {
					do_action( 'kadence_404_content' );
				} elseif ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						/**
						 * Hook in content single entry template.
						 */
						//do_action( 'kadence_single_content' );

                        $ids = get_post_meta($post->ID, 'DREAM_auto_slider', true);

                        ?>
                        <div class="alignfull">
                            <div class="splide" role="group">
                                <div class="splide__track">
                                    <ul class="splide__list kb-gallery-magnific-init">                                    
                                    <?php   
                                    if ($ids) : 
                                        foreach ($ids as $key => $value) {
                                            $image = wp_get_attachment_image_src($value, 'large');
                                            $full_src = wp_get_attachment_image_src( $value, 'full' );
                                            ?>
                                            <li class="splide__slide">
                                                <a href="<?php echo esc_url( $full_src[0] ); ?>" class="kb-gallery-item-link">
                                                    <img src="<?php echo $image[0]; ?>" alt="">
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    endif;
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
						<div class="has-sidebar has-right-sidebar">
							<div id="primary" class="content-area">
								<div class="content-container site-container" style="grid-template-columns:1fr 25%">
									<main id="main" class="site-main">
										<?php 
										
										$termMarchio = get_the_terms($post->ID,'auto-brand');
										$term_image = get_term_meta( $termMarchio[0]->term_id, 'kwp-tax-image-id', true);
										
										?>
										<div class="content-info">
											<div class="wrapper-top">
												<div class="image">
													<?php echo wp_get_attachment_image( $term_image, 'large', array('class' => 'alignnone')); ?>
												</div>
												<h2><?php echo get_the_title($post->ID); ?></h2>
												<div class="price">
													<?php
													$price = get_post_meta($post->ID, 'DREAM_auto_price',true);
													echo "&euro; ".number_format($price,0,",",".");
													?>
												</div>
											</div>

											<div class="wrapper-feature">
												<div class="item km">
													<div class="label">Chilometri</div>
													<div class="value">
														<?php 
														$km_done = get_post_meta($post->ID,'DREAM_auto_km_done', true);
														echo number_format($km_done,0,",",".");
														?>
													</div>
												</div>
												<div class="item year">
													<div class="label">cilindrata</div>
													<div class="value">
													<?php
													$engine = get_post_meta($post->ID,'DREAM_auto_engine', true);
													echo $engine." cc";
													?>
												</div>
												</div>
												<div class="item engine">
													<div class="label">posti</div>
													<div class="value">
													<?php
													$seat = get_post_meta($post->ID,'DREAM_auto_seat_capacity', true);
													echo $seat;
													?>
													</div>
												</div>
												<div class="item cambio">
													<div class="label">anno</div>
													<div class="value">
													<?php
													$termYear = get_the_terms($post->ID,'year-model');
													echo $termYear[0]->name;
													?>
													</div>
												</div>
												<div class="item cc">
													<div class="label">motore</div>
													<div class="value">
													<?php
													$termAlimentazione = get_the_terms($post->ID,'alimentazione-auto');
													echo $termAlimentazione[0]->name;
													?>
													</div>
												</div>
												<div class="item seat">
													<div class="label">cambio</div>
													<div class="value">
													<?php
													$termCambio = get_the_terms($post->ID,'cambio-auto');
													echo $termCambio[0]->name;
													?>
													</div>
												</div>
											</div>
										</div>
										<div class="post-content">
											<div class="title">
												Descrizione auto
											</div>
											<?php the_content(); ?>
										</div>

									</main>
									<aside id="secondary" class="primary-sidebar">
										<h3>Vuoi ricevere maggiori informazioni per <?php echo get_the_title($post->ID); ?>?</h3>
										<div class="wrapper-form">
											
											<?php echo do_shortcode('[contact-form-7 id="1182" title="Modulo di contatto 1"]'); ?>
										</div>
									</aside>

									

								</div>
							</div>
						</div>
                        <?php
					}
				} else {
					get_template_part( 'template-parts/content/error' );
				}
				?>
			</div>
			<?php			
			/**
			 * Hook for anything after main content
			 */
			do_action( 'kadence_after_main_content' );
			?>
		</main><!-- #main -->
		<?php
		get_sidebar();
		?>
	</div>
</div><!-- #primary -->

<?php get_footer(); ?>
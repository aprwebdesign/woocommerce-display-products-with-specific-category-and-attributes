<?php /* Template Name: page template name */
get_header();
//Woocommerce get products from specific category with specific attribute
?>

<div class="container-fluid">


<div class="col-md-12 col-sm-12">

<?php
// The query
$products = new WP_Query( array(
   'post_type'      => array('product'),
   'post_status'    => 'publish',
    'product_cat' => 'dames-jassen',
   'posts_per_page' => -1,
   'meta_query'     => array( array(
        'key' => '_visibility',
        'value' => array('catalog', 'visible'),
        'compare' => 'IN',
    ) ),
   'tax_query'      => array( array(
   //Set kleur
        'taxonomy'        => 'pa_kleur',
        'field'           => 'slug',
        'terms'           =>  array('rood'),
        'operator'        => 'IN',
    ) )
) );
global $product;

$product_ids ='';
// The Loop
if ( $products->have_posts() ): while ( $products->have_posts() ):
    $products->the_post();
	
	//Set seizoen
	if (strpos($product->get_attribute( 'pa_seizoen' ), 'Winter') !== false) {
 

	
    $product_ids.= $products->post->ID.',';
	
	}
	

	
endwhile;
    wp_reset_postdata();
endif;





echo do_shortcode('[products ids="'.$product_ids.'"]');?>

</div>



		<div class="clearfix"> </div>
	</div>
 <?php get_footer();?>

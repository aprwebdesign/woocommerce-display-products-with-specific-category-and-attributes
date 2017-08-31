<?php /* Template Name: page template name */
get_header();
//Woocommerce get products from specific category with specific attribute
?>

<div class="product-landingspage-banner"><div class="container-fluid"><h1><?php the_title(); ?></h1> <em></em></div></div>

<div class="container-fluid">

<div class="row">
<div class="col-md-12 col-sm-12 landing-content">
<?php $meta =  get_post_meta( get_the_ID(), 'advanced_options_landingspage-intro');
echo $meta[0];
?>

</div>
</div>

<div class="col-md-12 col-sm-12">

<?php
// The query
$products = new WP_Query( array(
   'post_type'      => array('product'),
   'post_status'    => 'publish',
    'product_cat' => 'category slug',
   'posts_per_page' => -1,
   
   'tax_query'      => array( 
      array(
   
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
		
		<div class="row">
		<div class="col-md-12 col-sm-12">
		<hr>
		<?php the_content();?>
		</div></div>
				<div class="clearfix"> </div>

	</div>
 <?php get_footer();?>

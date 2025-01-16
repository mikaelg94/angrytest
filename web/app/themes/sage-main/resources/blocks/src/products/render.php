<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<?php if(!empty($attributes['products'])) : ?>
	<div <?php echo get_block_wrapper_attributes(); ?>>
		<h2 class="text-4xl mb-6 mt-10 font-normal font-garamond">
			<?php echo $attributes['title']; ?>
		</h2>
		<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
			<?php foreach($attributes['products'] as $product_id) : ?>
				<?php
					$product = wc_get_product( $product_id );
					$image = wp_get_attachment_image_src( $product->get_image_id(), 'large' );
				?>
				<div>
					<a class="relative" href="<?php echo esc_url(get_permalink($product_id)); ?>">
						<img class="mb-2 object-cover aspect-square w-full" src="<?php echo !empty($image[0]) ? esc_url($image[0]) : 'https://placehold.co/1024x1024'; ?>" alt="<?php echo $product->get_title(); ?>">
					</a>
					<h3 class="text-2xl font-garamond font-light">
						<?php echo $product->get_name() ;?>
					</h3>
					<span class="text-gray-400 text-md"><?php echo $product->get_short_description(); ?></span>
					<h4 class="text-green-700 text-md"><?php echo wc_price( $product->get_price()) ;?></h4>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

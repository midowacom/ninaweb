<div id="about-us">
	<div class="mw wrap">
		<?=$func->title_main("ABOUT US")?>
		<div class="text-center mbb">
			<?=htmlspecialchars_decode($about_index["mota$lang"])?>
		</div>
		<div class="content">

			<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="autoplay: true">
				<ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid">
					<?php foreach($index_product_nb as $item){ ?>
						<li>
							<div class="uk-panel product-slider-panel">
								<?=$func->get_product_item($item)?>
							</div>
						</li>
					<?php } ?>

				</ul>

				<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
				<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

			</div>


		
		</div>
	</div>
</div>
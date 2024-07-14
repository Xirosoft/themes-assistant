<?php

use ATA\Admin\Views\AtaAssetsManager;
/**
 * Global functions
 *
 * This function manage all globlal functions
 *
 * @package ATA
 */

/*------------------------------------------*
*				Excerpt Length              *
*-------------------------------------------*/
if(!function_exists('ata_excerpt')){
	function ata_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt);
		} else {
			$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
	}
}

/*------------------------------------------*
*				Global Function             *
*-------------------------------------------*/
function ata_assets_manager( $handle, $type = null, $deps = [], $ver = false, $in_footer_or_media = 'all' ) {
    $assets_manager = AtaAssetsManager::get_instance();
    $assets_manager->ata_enqueue_asset( $handle, $type, $deps, $ver, $in_footer_or_media );
}

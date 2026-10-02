<?php
/**
 * The `kadence()` function.
 *
 * @package kadence
 */

namespace Kadence;

use Kadence\Template_Tags;
use Kadence\Theme;
use KadenceWP\KadenceShopKit\App;
use KadenceWP\KadenceShopKit\Features\Feature_Repository;

use function get_template_directory;

/**
 * Provides access to all available template tags of the theme.
 *
 * When called for the first time, the function will initialize the theme.
 *
 * @return Template_Tags Template tags instance exposing template tag methods.
 */
function kadence() : Template_Tags {
	static $theme = null;

	if ( null === $theme ) {
		$theme = Theme::instance();
	}

	return $theme->template_tags();
}
/**
 * Checks if a Kadence Shop Kit feature is enabled.
 *
 * @param string $feature_id The feature ID to check.
 * @return bool True if the feature is enabled, false otherwise.
 */
function is_shopkit_feature_enabled( string $feature_id ) : bool {
	if ( ! class_exists( App::class ) ) {
		return false;
	}

	/** @var Feature_Repository $repository */
	$repository = App::container()->get( Feature_Repository::class );

	return $repository->has( $feature_id ) && $repository->is_enabled( $feature_id );
}

// Load the CSS class.
require get_template_directory() . '/inc/class-kadence-css.php';
// Load the Local Font class.
require get_template_directory() . '/inc/class-local-gfonts.php';

// Load the Customizer class.
require get_template_directory() . '/inc/customizer/class-theme-customizer.php';

// Load Settings Page Class.
require get_template_directory() . '/inc/dashboard/class-theme-dashboard.php';

// Load the Meta class.
require get_template_directory() . '/inc/meta/class-theme-meta.php';

// Load the template functions.
require get_template_directory() . '/inc/template-functions/header-functions.php';
require get_template_directory() . '/inc/template-functions/title-functions.php';
require get_template_directory() . '/inc/template-functions/single-functions.php';
require get_template_directory() . '/inc/template-functions/footer-functions.php';
require get_template_directory() . '/inc/template-functions/archive-functions.php';

// Load the template hooks.
require get_template_directory() . '/inc/template-hooks.php';

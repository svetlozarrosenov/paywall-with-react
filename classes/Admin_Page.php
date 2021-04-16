<?php
declare(strict_types = 1);

namespace Paywall_Package;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Paywall_Custom_Fields\Drupal_Database_Field;

/**
 * Admin Page class.
 * Manage The Admin ( Create The Options Pages )
 */
class Admin_Page {

	public function __construct() {
		add_filter('carbon_fields_migrator_button_label', function() {
            return __( 'Migrate', 'crb' );
        } );

		$this->addMigratorOptionsPage();
	}

	/**
	 * Create admin page
	 */
	public function attachMigratorOptionsPage() {
		 Container::make( 'theme_options', __( 'Paywall', 'crb' ) )
			->set_page_file( 'paywall-options-page.php' )
			->add_fields( array(
				Field::make( 'text', 'crb_paywall_free_articles', __( 'Free Articles', 'crb' ) ),
			) );
	}

	/**
	 * Attach the admin page.
	 */
	private function addMigratorOptionsPage() {
		add_action(
			'after_setup_theme',
			function () {
				add_action( 'carbon_fields_register_fields', array( $this, 'attachMigratorOptionsPage' ) );
			},
			11
		);
	}
}

<?php
/**
 * Frontend Class
 *
 * This class manages all API functionality.
 *
 * @package AT_Assistant
 */

namespace AT_Assistant;

/**
 * This class using for manage all Frontend raleted class
 *
 * @FrotnendPanel
 */
class FrontendPanel {

	/**
	 * FrontendPanel constructor.
	 * Add the FrontendPanel.
	 */
	public function __construct() {

		/**
		 * Handles frontend asset enqueueing.
		 * Frontend All endquee class
		 */
		new Frontend\FrontendEnqueue();

		/**
		 * Handles DOM manipulation for views.
		 * Dom Mange class
		 */
		new Frontend\views\DomHandle();
	}
}

<?php

/**
 * Manages copy and synchronization of terms and post metas
 *
 * @since 1.2
 */
class PLL_Admin_Sync extends PLL_Sync {

	/**
	 * Constructor
	 *
	 * @since 1.2
	 *
	 * @param object $polylang
	 */
	public function __construct( &$polylang ) {
		parent::__construct( $polylang );

		add_filter( 'wp_insert_post_parent', array( $this, 'wp_insert_post_parent' ), 10, 3 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 5, 2 ); // Before Types which populates custom fields in same hook with priority 10
	}

	/**
	 * Translate post parent if exists when using "Add new" ( translation )
	 *
	 * @since 0.6
	 *
	 * @param int   $post_parent Post parent ID
	 * @param int   $post_id     Post ID, unused
	 * @param array $postarr     Array of parsed post data
	 * @return int
	 */
	public function wp_insert_post_parent( $post_parent, $post_id, $postarr ) {
		// Make sure not to impact media translations created at the same time
		return isset( $_GET['from_post'], $_GET['new_lang'], $_GET['post_type'] ) && $_GET['post_type'] === $postarr['post_type'] && ( $id = wp_get_post_parent_id( (int) $_GET['from_post'] ) ) && ( $parent = $this->model->post->get_translation( $id, $_GET['new_lang'] ) ) ? $parent : $post_parent;
	}

	/**
	 * Copy post metas, menu order, comment and ping status when using "Add new" ( translation )
	 * formerly used dbx_post_advanced deprecated in WP 3.7
	 *
	 * @since 1.2
	 *
	 * @param string $post_type unused
	 * @param object $post      current post object
	 */
	public function add_meta_boxes( $post_type, $post ) {
		if ( 'post-new.php' == $GLOBALS['pagenow'] && isset( $_GET['from_post'], $_GET['new_lang'] ) && $this->model->is_translated_post_type( $post->post_type ) ) {
			// Capability check already done in post-new.php
			$from_post_id = (int) $_GET['from_post'];
			$from_post = get_post( $from_post_id );
			$lang = $this->model->get_language( $_GET['new_lang'] );

			if ( ! $from_post || ! $lang ) {
				return;
			}

			$this->taxonomies->copy( $from_post_id, $post->ID, $lang->slug );
			$this->post_metas->copy( $from_post_id, $post->ID, $lang->slug );

			if ( is_sticky( $from_post_id ) ) {
				stick_post( $post->ID );
			}

			// Classic Editor
			foreach ( array( 'menu_order', 'comment_status', 'ping_status' ) as $property ) {
				$post->$property = $from_post->$property;
			}

			// Copy the date only if the synchronization is activated
			if ( in_array( 'post_date', $this->options['sync'] ) ) {
				$post->post_date = $from_post->post_date;
				$post->post_date_gmt = $from_post->post_date_gmt;
			}

			// Blocks editor
			add_filter( "rest_prepare_{$post_type}", array( $this, 'block_editor_copy_post_fields' ), 10, 2 );
		}
	}

	/**
	 * Copy menu order, comment, ping status and optionally the date
	 * when creating a new tanslation with the block editor
	 *
	 * @since 2.4
	 *
	 * @param object $response The response object.
	 * @param object $post     Post object.
	 */
	public function block_editor_copy_post_fields( $response, $post ) {
		$from_post_id = (int) $_GET['from_post'];
		$from_post = get_post( $from_post_id );

		foreach ( array( 'menu_order', 'comment_status', 'ping_status' ) as $property ) {
			$response->data[ $property ] = $from_post->$property;
		}

		// Copy the date only if the synchronization is activated
		if ( in_array( 'post_date', PLL()->options['sync'] ) ) {
			$response->data['date'] = $from_post->post_date;
			$response->data['date_gmt'] = $from_post->post_date_gmt;
		}

		return $response;
	}

	/**
	 * Get post fields to synchornize
	 *
	 * @since 2.4
	 *
	 * @param object $post Post object
	 * @return array
	 */
	protected function get_fields_to_sync( $post ) {
		global $wpdb;

		$postarr = parent::get_fields_to_sync( $post );

		// For new drafts, save the date now otherwise it is overriden by WP. Thanks to JoryHogeveen. See #32.
		if ( in_array( 'post_date', $this->options['sync'] ) && 'post-new.php' === $GLOBALS['pagenow'] && isset( $_GET['from_post'], $_GET['new_lang'] ) ) {
			unset( $postarr['post_date'] );
			unset( $postarr['post_date_gmt'] );

			$original = get_post( (int) $_GET['from_post'] );
			$wpdb->update(
				$wpdb->posts,
				array(
					'post_date'     => $original->post_date,
					'post_date_gmt' => $original->post_date_gmt,
				),
				array( 'ID' => $post->ID )
			);
		}

		if ( isset( $GLOBALS['post_type'] ) ) {
			$post_type = $GLOBALS['post_type'];
		} elseif ( isset( $_REQUEST['post_type'] ) ) {
			$post_type = $_REQUEST['post_type']; // 2nd case for quick edit
		}

		// Make sure not to impact media translations when creating them at the same time as post
		if ( in_array( 'post_parent', $this->options['sync'] ) && ( ! isset( $post_type ) || $post_type !== $post->post_type ) ) {
			unset( $postarr['post_parent'] );
		}

		return $postarr;
	}

	/**
	 * Synchronizes post fields in translations
	 *
	 * @since 1.2
	 *
	 * @param int    $post_id      post id
	 * @param object $post         post object
	 * @param array  $translations post translations
	 */
	public function pll_save_post( $post_id, $post, $translations ) {
		parent::pll_save_post( $post_id, $post, $translations );

		// Sticky posts
		if ( in_array( 'sticky_posts', $this->options['sync'] ) ) {
			$stickies = get_option( 'sticky_posts' );
			if ( isset( $_REQUEST['sticky'] ) && 'sticky' === $_REQUEST['sticky'] ) {
				$stickies = array_merge( $stickies, array_values( $translations ) );
			} else {
				$stickies = array_diff( $stickies, array_values( $translations ) );
			}
			update_option( 'sticky_posts', array_unique( $stickies ) );
		}
	}

	/**
	 * Some backward compatibility with Polylang < 2.3
	 * allows to call PLL()->sync->copy_post_metas() and PLL()->sync->copy_taxonomies()
	 * used for example in Polylang for WooCommerce
	 * the compatibility is however only partial as the 4th argument $sync is lost
	 *
	 * @since 2.3
	 *
	 * @param string $func Function name
	 * @param array  $args Function arguments
	 */
	public function __call( $func, $args ) {
		$obj = substr( $func, 5 );

		if ( is_object( $this->$obj ) && method_exists( $this->$obj, 'copy' ) ) {
			if ( WP_DEBUG ) {
				$debug = debug_backtrace();
				$i = 1 + empty( $debug[1]['line'] ); // The file and line are in $debug[2] if the function was called using call_user_func

				trigger_error(
					sprintf(
						'%1$s was called incorrectly in %3$s on line %4$s: the call to PLL()->sync->%1$s() has been deprecated in Polylang 2.3, use PLL()->sync->%2$s->copy() instead.' . "\nError handler",
						$func,
						$obj,
						$debug[ $i ]['file'],
						$debug[ $i ]['line']
					)
				);
			}
			return call_user_func_array( array( $this->$obj, 'copy' ), $args );
		}

		$debug = debug_backtrace();
		trigger_error( sprintf( 'Call to undefined function PLL()->sync->%1$s() in %2$s on line %3$s' . "\nError handler", $func, $debug[0]['file'], $debug[0]['line'] ), E_USER_ERROR );
	}
}

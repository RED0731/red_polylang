<?php
class PLL_REST_Context extends PLL_Context {


	public function get_name() {
		return PLL_REST_Request::class;
	}

	protected function do_wordpress_actions() {
		global $wp_rewrite;

		$this->do_pll_actions( 'setup_theme' );
		$this->do_pll_actions( 'after_setup_theme' );
		$this->do_pll_actions( 'init' );
		$this->do_pll_actions( 'widgets_init' );
		$this->do_pll_actions( 'rest_api_init' );
		$this->do_pll_actions( 'wp_loaded' );

		$wp_rewrite->flush_rules();

		$this->do_pll_actions( 'parse_request' );
	}
}
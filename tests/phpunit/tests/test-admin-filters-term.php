<?php

class Admin_Filters_Term_Test extends PLL_UnitTestCase {
	static $editor;

	static function wpSetUpBeforeClass() {
		parent::wpSetUpBeforeClass();

		self::create_language( 'en_US' );
		self::create_language( 'fr_FR' );
		self::create_language( 'de_DE_formal' );
		self::create_language( 'es_ES' );

		self::$editor = self::factory()->user->create( array( 'role' => 'editor' ) );
	}

	function setUp() {
		parent::setUp();

		wp_set_current_user( self::$editor ); // set a user to pass current_user_can tests
		self::$polylang = new PLL_Admin( self::$polylang->links_model );
		self::$polylang->filters = new PLL_Admin_Filters( self::$polylang ); // To activate the fix_delete_default_category() filter
		self::$polylang->filters_term = new PLL_Admin_Filters_Term( self::$polylang );
	}

	function tearDown() {
		parent::tearDown();

		$_REQUEST = $_GET = $_POST = array();
	}

	function test_default_language() {
		// user preferred language
		self::$polylang->pref_lang = self::$polylang->model->get_language( 'fr' );
		$term_id = $this->factory->category->create();
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $term_id )->slug );

		// language set from parent
		$parent = $this->factory->category->create();
		self::$polylang->model->term->set_language( $parent, 'de' );
		$term_id = $this->factory->category->create( array( 'parent' => $parent ) );
		$this->assertEquals( 'de', self::$polylang->model->term->get_language( $term_id )->slug );
	}

	function test_save_term_from_edit_tags() {
		$_REQUEST = $_POST = array(
			'action'           => 'add-tag',
			'term_lang_choice' => 'en',
			'_pll_nonce'       => wp_create_nonce( 'pll_language' ),
		);
		$en = $this->factory->category->create();
		$this->assertEquals( 'en', self::$polylang->model->term->get_language( $en )->slug );

		// set the language and translations
		$_REQUEST = $_POST = array(
			'action'           => 'add-tag',
			'post_lang_choice' => 'fr',
			'_pll_nonce'       => wp_create_nonce( 'pll_language' ),
			'term_tr_lang'     => array( 'en' => $en ),
		);

		$fr = $this->factory->category->create();
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $fr )->slug );
		$this->assertEqualSets( compact( 'en', 'fr' ), self::$polylang->model->term->get_translations( $en ) );
	}

	function test_create_term_from_categories_metabox() {
		$_REQUEST = $_POST = array(
			'action'                   => 'add-category',
			'term_lang_choice'         => 'fr',
			'_ajax_nonce-add-category' => wp_create_nonce( 'add-category' ),
		);

		$fr = $this->factory->category->create();
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $fr )->slug );
	}

	function test_save_term_from_quick_edit() {
		$term_id = $en = $this->factory->category->create();
		self::$polylang->model->term->set_language( $en, 'en' );

		$de = $this->factory->category->create();
		self::$polylang->model->term->set_language( $de, 'de' );

		$es = $this->factory->category->create();
		self::$polylang->model->term->set_language( $es, 'es' );

		self::$polylang->model->term->save_translations( $en, compact( 'en', 'de', 'es' ) );

		// post quick edit
		// + the language is free in the translation group
		$_REQUEST = $_POST = array(
			'action'             => 'inline-save',
			'inline_lang_choice' => 'fr',
			'_inline_edit'       => wp_create_nonce( 'inlineeditnonce' ),
		);

		wp_update_term( $fr = $term_id, 'category' );
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $term_id )->slug );
		$this->assertEqualSetsWithIndex( compact( 'fr', 'de', 'es' ), self::$polylang->model->term->get_translations( $es ) );

		// edit-tags quick edit
		// + the language is *not* free in the translation group
		$_REQUEST = $_POST = array(
			'action'             => 'inline-save-tax',
			'inline_lang_choice' => 'de',
			'_inline_edit'       => wp_create_nonce( 'taxinlineeditnonce' ),
		);

		wp_update_term( $term_id, 'category' );
		$this->assertEquals( 'de', self::$polylang->model->term->get_language( $term_id )->slug );
		$this->assertEqualSetsWithIndex( compact( 'de', 'es' ), self::$polylang->model->term->get_translations( $es ) );
		$this->assertEquals( array( 'de' => $term_id ), self::$polylang->model->term->get_translations( $term_id ) );
	}

	function test_create_term_from_post_bulk_edit() {
		self::$polylang->filters_post = new PLL_Admin_Filters_Post( self::$polylang ); // we need this too

		$posts = $this->factory->post->create_many( 2 );
		self::$polylang->model->post->set_language( $posts[0], 'en' );
		self::$polylang->model->post->set_language( $posts[1], 'fr' );

		$test_tag = $this->factory->tag->create( array( 'name' => 'test_tag' ) );
		self::$polylang->model->term->set_language( $test_tag, 'fr' );

		// first do not modify any language
		$_REQUEST = $_GET = array(
			'inline_lang_choice' => -1,
			'_wpnonce'           => wp_create_nonce( 'bulk-posts' ),
			'bulk_edit'          => 'Update',
			'post'               => $posts,
			'_status'            => 'publish',
			'tax_input'          => array( 'post_tag' => 'new_tag,test_tag' ),
		);
		$done = bulk_edit_posts( $_REQUEST );

		$tags_en = wp_get_post_tags( $posts[0] );
		$new_en = wp_filter_object_list( $tags_en, array( 'name' => 'new_tag' ), 'AND', 'term_id' );
		$new_en = reset( $new_en );
		$test_en = wp_filter_object_list( $tags_en, array( 'name' => 'test_tag' ), 'AND', 'term_id' );
		$test_en = reset( $test_en );

		$tags_fr = wp_get_post_tags( $posts[1] );
		$new_fr = wp_filter_object_list( $tags_fr, array( 'name' => 'new_tag' ), 'AND', 'term_id' );
		$new_fr = reset( $new_fr );
		$test_fr = wp_filter_object_list( $tags_fr, array( 'name' => 'test_tag' ), 'AND', 'term_id' );
		$test_fr = reset( $test_fr );

		$this->assertEquals( $test_tag, $test_fr );
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $new_fr )->slug );
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $test_fr )->slug );
		$this->assertEquals( 'en', self::$polylang->model->term->get_language( $new_en )->slug );
		$this->assertEquals( 'en', self::$polylang->model->term->get_language( $test_en )->slug );
		$this->assertEqualSetsWithIndex( array( 'en' => $new_en, 'fr' => $new_fr ), self::$polylang->model->term->get_translations( $new_en ) );
		$this->assertEqualSetsWithIndex( array( 'en' => $test_en, 'fr' => $test_fr ), self::$polylang->model->term->get_translations( $test_en ) );

		// second modify all languages
		$_GET['inline_lang_choice'] = $_REQUEST['inline_lang_choice'] = 'fr';
		$_GET['tax_input']  = $_REQUEST['tax_input'] = array( 'post_tag' => 'third_tag' );
		$done = bulk_edit_posts( $_REQUEST );

		$tags = wp_get_post_tags( $posts[0] );
		$third = wp_filter_object_list( $tags , array( 'name' => 'third_tag' ), 'AND', 'term_id' );
		$third = reset( $third );
		$this->assertEquals( 'fr', self::$polylang->model->term->get_language( $third )->slug );

		$tags = wp_list_pluck( $tags, 'term_id' );
		$this->assertEqualSets( array( $new_fr, $test_fr, $third ), $tags );

		$tags = wp_get_post_tags( $posts[1] );
		$tags = wp_list_pluck( $tags, 'term_id' );
		$this->assertEqualSets( array( $new_fr, $test_fr, $third ), $tags );
	}

	function test_delete_term() {
		$en = $this->factory->category->create();
		self::$polylang->model->term->set_language( $en, 'en' );

		$fr = $this->factory->category->create();
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$de = $this->factory->category->create();
		self::$polylang->model->term->set_language( $de, 'de' );

		self::$polylang->model->term->save_translations( $en, compact( 'en', 'fr', 'de' ) );

		wp_delete_term( $en, 'category' ); // forces delete
		$this->assertEqualSetsWithIndex( compact( 'fr', 'de' ), self::$polylang->model->term->get_translations( $fr ) );
	}

	function get_edit_term_form( $tag_ID, $taxonomy ) {
		// prepare all needed info before loading the entire form
		$GLOBALS['post_type'] = 'post';
		$tax = get_taxonomy( $taxonomy );
		$_REQUEST['tag_ID'] = $_GET['tag_ID'] = $tag_ID;
		$tag = get_term( $tag_ID, $taxonomy, OBJECT, 'edit' );
		$wp_http_referer = home_url( '/wp-admin/edit-tags.php?taxonomy=category' );
		$message = '';
		set_current_screen( 'edit-tags' );
		$GLOBALS['pagenow'] = 'term.php'; // WP 4.5+
		self::$polylang->set_current_language();

		ob_start();
		include ABSPATH . 'wp-admin/edit-tag-form.php';
		return ob_get_clean();
	}

	function test_parent_dropdown_in_edit_tags() {
		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'essai' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		$tag_ID = $this->factory->term->create( array( 'taxonomy' => 'category' ) );
		self::$polylang->model->term->set_language( $tag_ID, 'fr' );

		self::$polylang->links = new PLL_Admin_Links( self::$polylang );

		$form = $this->get_edit_term_form( $tag_ID, 'category' );
		$this->assertFalse( strpos( $form, 'test' ) );
		$this->assertNotFalse( strpos( $form, 'essai' ) );

		// the admin language filter must have no impact
		self::$polylang->pref_lang = self::$polylang->filter_lang = self::$polylang->model->get_language( 'en' );
		$form = $this->get_edit_term_form( $tag_ID, 'category' );
		$this->assertFalse( strpos( $form, 'test' ) );
		$this->assertNotFalse( strpos( $form, 'essai' ) );
		self::$polylang->filter_lang = false;

		// even when we just activated the admin language filter
		$_REQUEST['lang'] = $_GET['lang'] = 'en';
		$form = $this->get_edit_term_form( $tag_ID, 'category' );
		$this->assertFalse( strpos( $form, 'test' ) );
		$this->assertNotFalse( strpos( $form, 'essai' ) );
		unset( $_GET['lang'] );
/*
 * FIXME it does not make sense to make ajax tests here
		$_REQUEST['lang'] = $_POST['lang'] = 'en'; // prevails on the term language (ajax response to language change)
		$form = $this->get_edit_term_form( $tag_ID , 'category' );
		$this->assertNotFalse( strpos( $form, 'test' ) );
		$this->assertFalse( strpos( $form, 'essai' ) );
*/
		unset( $_REQUEST, $_GET, $_POST, $GLOBALS['post_type'] );
	}

	function test_language_dropdown_and_translations_in_edit_tags() {
		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'essai' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		self::$polylang->model->term->save_translations( $en, compact( 'en', 'fr' ) );

		self::$polylang->links = new PLL_Admin_Links( self::$polylang );

		$lang = self::$polylang->model->get_language( 'fr' );
		$form = $this->get_edit_term_form( $fr, 'category' );
		$xml = simplexml_load_string( "<root>$form</root>" ); // add a root xml tag to get a valid xml doc

		$option = $xml->xpath( '//select[@name="term_lang_choice"]/option[.="' . $lang->name . '"]' );
		$attributes = $option[0]->attributes();
		$this->assertEquals( 'selected', $attributes['selected'] );
		$input = $xml->xpath( '//input[@id="tr_lang_en"]' );
		$attributes = $input[0]->attributes();
		$this->assertEquals( 'test', $attributes['value'] );
		$input = $xml->xpath( '//input[@id="tr_lang_de"]' );
		$attributes = $input[0]->attributes();
		$this->assertEquals( '', $attributes['value'] ); // no translation in German
	}

	function test_default_category_in_edit_tags() {
		self::$polylang->links = new PLL_Admin_Links( self::$polylang );

		$default = self::$polylang->model->term->get( get_option( 'default_category' ), 'de' );
		$de = self::$polylang->model->get_language( 'de' );
		$form = $this->get_edit_term_form( $default, 'category' );
		$xml = simplexml_load_string( "<root>$form</root>" ); // add a root xml tag to get a valid xml doc

		$option = $xml->xpath( '//select[@name="term_lang_choice"]' );
		$attributes = $option[0]->attributes();
		$this->assertEquals( 'disabled', $attributes['disabled'] );
		$option = $xml->xpath( '//select[@name="term_lang_choice"]/option[.="' . $de->name . '"]' );
		$attributes = $option[0]->attributes();
		$this->assertEquals( 'selected', $attributes['selected'] );
		$input = $xml->xpath( '//input[@id="tr_lang_fr"]' );
		$attributes = $input[0]->attributes();
		$this->assertEquals( 'disabled', $attributes['disabled'] ); // disabled
	}

	function get_parent_dropdown_in_new_term_form( $taxonomy ) {
		// NB: impossible to load edit-tags.php entirely as it would attempt to load a second instance of WP
		// which is impossible due to constant definitions such as ABSPATH

		set_current_screen( 'edit-tags.php' );

		// so let's copy paste WP 4.4 code:
		ob_start();
		$dropdown_args = array(
			'hide_empty'       => 0,
			'hide_if_empty'    => false,
			'taxonomy'         => $taxonomy,
			'name'             => 'parent',
			'orderby'          => 'name',
			'hierarchical'     => true,
			'show_option_none' => __( 'None' ),
		);

		// FIXME this filter is available since WP 4.2 and is worth looking at ( could simplify get_queried_language? )
		$dropdown_args = apply_filters( 'taxonomy_parent_dropdown_args', $dropdown_args, $taxonomy, 'new' );
		wp_dropdown_categories( $dropdown_args );
		unset( $GLOBALS['current_screen'] );
		return ob_get_clean();
	}

	function test_parent_dropdown_in_new_tag() {
		self::$polylang->pref_lang = self::$polylang->model->get_language( 'en' );
		$_GET['taxonomy'] = 'category';

		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'essai' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		$child = $this->factory->term->create( array( 'taxonomy' => 'category', 'parent' => $en ) );

		$GLOBALS['pagenow'] = 'edit-tags.php';
		self::$polylang->set_current_language();
		$dropdown = $this->get_parent_dropdown_in_new_term_form( 'category' );

		$this->assertNotFalse( strpos( $dropdown, '<option class="level-0" value="' . $en . '">test</option>' ) );
		$this->assertFalse( strpos( $dropdown, '<option class="level-0" value="' . $fr . '">essai</option>' ) );
		$this->assertFalse( strpos( $dropdown, 'selected' ) );

		$_GET = array(
			'taxonomy' => 'category',
			'new_lang' => 'fr',
			'from_tag' => $child,
		);
		self::$polylang->set_current_language();
		$dropdown = $this->get_parent_dropdown_in_new_term_form( 'category' );

		$this->assertFalse( strpos( $dropdown, '<option class="level-0" value="' . $en . '">test</option>' ) );
		$this->assertNotFalse( strpos( $dropdown, '<option class="level-0" value="' . $fr . '">essai</option>' ) );
		$this->assertFalse( strpos( $dropdown, 'selected' ) );

		self::$polylang->model->term->save_translations( $en, compact( 'en', 'fr' ) );
		$dropdown = $this->get_parent_dropdown_in_new_term_form( 'category' );

		$this->assertNotFalse( strpos( $dropdown, '<option class="level-0" value="' . $fr . '" selected="selected">essai</option>' ) );

		unset( $_GET );
	}

	function test_language_dropdown_and_translations_in_new_tags() {
		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		self::$polylang->links = new PLL_Admin_Links( self::$polylang );

		$_GET['taxonomy'] = 'category';
		$GLOBALS['post_type'] = 'post';
		$lang = self::$polylang->pref_lang = self::$polylang->model->get_language( 'en' );
		self::$polylang->set_current_language();

		ob_start();
		do_action( 'category_add_form_fields' );
		$form = ob_get_clean();
		$xml = simplexml_load_string( "<root>$form</root>" ); // add a root xml tag to get a valid xml doc

		$option = $xml->xpath( '//select[@name="term_lang_choice"]/option[.="' . $lang->name . '"]' );
		$attributes = $option[0]->attributes();
		$this->assertEquals( 'selected', $attributes['selected'] );
		$this->assertEmpty( '', $xml->xpath( '//input[@id="tr_lang_en"]' ) );
		$input = $xml->xpath( '//input[@id="tr_lang_fr"]' );
		$attributes = $input[0]->attributes();
		$this->assertEquals( '', $attributes['value'] ); // no translation in French

		$_GET['from_tag'] = $en;
		$_GET['new_lang'] = 'fr';
		self::$polylang->set_current_language();
		$lang = self::$polylang->model->get_language( 'fr' );

		ob_start();
		do_action( 'category_add_form_fields' );
		$form = ob_get_clean();
		$xml = simplexml_load_string( "<root>$form</root>" ); // add a root xml tag to get a valid xml doc

		$option = $xml->xpath( '//select[@name="term_lang_choice"]/option[.="' . $lang->name . '"]' );
		$attributes = $option[0]->attributes();
		$this->assertEquals( 'selected', $attributes['selected'] );
		$this->assertEmpty( '', $xml->xpath( '//input[@id="tr_lang_fr"]' ) );
		$input = $xml->xpath( '//input[@id="tr_lang_en"]' );
		$attributes = $input[0]->attributes();
		$this->assertEquals( 'test', $attributes['value'] ); // no translation in French
		$input = $xml->xpath( '//input[@id="tr_lang_de"]' );
		$attributes = $input[0]->attributes();
		$this->assertEquals( '', $attributes['value'] ); // no translation in German

		unset( $_GET, $GLOBALS['post_type'] );
	}

	function test_term_list_with_admin_language_filter() {
		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'essai' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'enfant', 'parent' => $fr ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'child', 'parent' => $en ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		$GLOBALS['taxnow'] = $_REQUEST['taxonomy'] = $_GET['taxonomy'] = 'category'; // WP_Screen tests $_REQUEST, Polylang tests $_GET
		$GLOBALS['hook_suffix'] = 'edit-tags.php';
		set_current_screen();
		$wp_list_table = _get_list_table( 'WP_Terms_List_Table' );
		self::$polylang->set_current_language();

		// without filter
		ob_start();
		$wp_list_table->prepare_items();
		$wp_list_table->display();
		$list = ob_get_clean();

		$this->assertNotFalse( strpos( $list, 'test' ) );
		$this->assertNotFalse( strpos( $list, 'essai' ) );
		$this->assertNotFalse( strpos( $list, 'child' ) );
		$this->assertNotFalse( strpos( $list, 'enfant' ) );

		// the filter is active
		self::$polylang->pref_lang = self::$polylang->filter_lang = self::$polylang->model->get_language( 'en' );
		self::$polylang->set_current_language();

		ob_start();
		$wp_list_table->prepare_items();
		$wp_list_table->display();
		$list = ob_get_clean();

		$this->assertNotFalse( strpos( $list, 'test' ) );
		$this->assertFalse( strpos( $list, 'essai' ) );
		$this->assertNotFalse( strpos( $list, 'child' ) );
		$this->assertFalse( strpos( $list, 'enfant' ) );
	}

	function test_new_default_category() {
		$term_id = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'new-default' ) );
		update_option( 'default_category', $term_id );

		$this->assertEquals( $term_id, get_option( 'default_category' ) );
// FIXME test removed as the code doesn't force the default category to be in the default language
//		$this->assertEquals( self::$polylang->options['default_lang'], self::$polylang->model->term->get_language( $term_id )->slug );
		$translations = self::$polylang->model->term->get_translations( $term_id );
		$this->assertEqualSets( array( 'en', 'fr', 'de', 'es' ), array_keys( $translations ) );
	}

	// bug introduced by WP 4.3 and fixed in v1.8.2
	function test_default_category_in_list_table() {
		$id = $this->factory->term->create( array( 'taxonomy' => 'category' ) ); // a non default category
		$default = get_option( 'default_category' );
		$en = self::$polylang->model->term->get( $default, 'en' );
		$fr = self::$polylang->model->term->get( $default, 'fr' );

		$GLOBALS['taxnow'] = $_REQUEST['taxonomy'] = $_GET['taxonomy'] = 'category'; // WP_Screen tests $_REQUEST, Polylang tests $_GET
		$GLOBALS['hook_suffix'] = 'edit-tags.php';
		set_current_screen();
		$wp_list_table = _get_list_table( 'WP_Terms_List_Table' );

		ob_start();
		$wp_list_table->prepare_items();
		$wp_list_table->display();
		$list = ob_get_clean();

		// checkbox only for non default category
		$this->assertFalse( strpos( $list, '"cb-select-' . $en . '"' ) );
		$this->assertFalse( strpos( $list, '"cb-select-' . $fr . '"' ) );
		$this->assertNotFalse( strpos( $list, '"cb-select-' . $id . '"' ) );

		// delete link only for non default category
		$this->assertFalse( strpos( $list, 'edit-tags.php?action=delete&amp;taxonomy=category&amp;tag_ID=' . $en . '&amp;' ) );
		$this->assertFalse( strpos( $list, 'edit-tags.php?action=delete&amp;taxonomy=category&amp;tag_ID=' . $fr . '&amp;' ) );
		$this->assertNotFalse( strpos( $list, 'edit-tags.php?action=delete&amp;taxonomy=category&amp;tag_ID=' . $id . '&amp;' ) );
	}

	function test_post_categories_meta_box() {
		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'essai' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		$post = $this->factory->post->create_and_get();
		self::$polylang->model->post->set_language( $post->ID, 'fr' );

		$_GET['post'] = $post->ID;
		$GLOBALS['pagenow'] = 'post.php';
		self::$polylang->set_current_language();
		require_once ABSPATH . 'wp-admin/includes/meta-boxes.php';

		ob_start();
		post_categories_meta_box( $post, array() );
		$out = ob_get_clean();

		$this->assertFalse( strpos( $out, 'test' ) );
		$this->assertNotFalse( strpos( $out, 'essai' ) );
/*
 * FIXME it does not make sense to mak ajax tests here
		$_REQUEST['lang'] = $_POST['lang'] = 'en'; // prevails on the post language (ajax response to language change)
		self::$polylang->set_current_language();
		ob_start();
		post_categories_meta_box( $post, array() );
		$out = ob_get_clean();

		$this->assertNotFalse( strpos( $out, 'test' ) );
		$this->assertFalse( strpos( $out, 'essai' ) );
*/
		unset( $_POST );
	}

	function test_nav_menu_item_taxonomy_meta_box() {
		$fr = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'essai' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'category', 'name' => 'test' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
		$taxonomy['args'] = get_taxonomy( 'category' );
		self::$polylang->set_current_language();

		ob_start();
		wp_nav_menu_item_taxonomy_meta_box( null, $taxonomy );
		$out = ob_get_clean();

		$this->assertNotFalse( strpos( $out, 'test' ) );
		$this->assertNotFalse( strpos( $out, 'essai' ) );

		// the admin language filter is active
		self::$polylang->pref_lang = self::$polylang->filter_lang = self::$polylang->model->get_language( 'en' );
		self::$polylang->set_current_language();

		ob_start();
		wp_nav_menu_item_taxonomy_meta_box( null, $taxonomy );
		$out = ob_get_clean();

		$this->assertNotFalse( strpos( $out, 'test' ) );
		$this->assertFalse( strpos( $out, 'essai' ) );
	}

	function test_get_terms_language_filter() {
		$fr = $this->factory->term->create( array( 'taxonomy' => 'post_tag' ) );
		self::$polylang->model->term->set_language( $fr, 'fr' );

		$en = $this->factory->term->create( array( 'taxonomy' => 'post_tag' ) );
		self::$polylang->model->term->set_language( $en, 'en' );

		$es = $this->factory->term->create( array( 'taxonomy' => 'post_tag' ) );
		self::$polylang->model->term->set_language( $es, 'es' );

		$terms = get_terms( 'post_tag', array( 'fields' => 'ids', 'hide_empty' => false, 'lang' => 'en' ) );
		$this->assertEqualSets( array( $en ), $terms );

// FIXME currently breaks in PLL_Admin_Filters_Term::get_terms_args()
//		$terms = get_terms( 'post_tag', array( 'fields' => 'ids', 'hide_empty' => false, 'lang' => 'en,fr' ) );
//		$this->assertEqualSets( array( $en, $fr ), $terms );

		$terms = get_terms( 'post_tag', array( 'fields' => 'ids', 'hide_empty' => false, 'lang' => array( 'en', 'fr' ) ) );
		$this->assertEqualSets( array( $fr, $en ), $terms );

		$terms = get_terms( 'post_tag', array( 'fields' => 'ids', 'hide_empty' => false, 'lang' => 0 ) );
		$this->assertEqualSets( array( $en, $fr, $es ), $terms );
	}
}

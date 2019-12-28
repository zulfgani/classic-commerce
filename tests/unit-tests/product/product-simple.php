<?php

/**
 * Class Product_Simple.
 * @package ClassicCommerce\Tests\Product
 * @since WC-2.3
 */
class WC_Tests_Product_Simple extends WC_Unit_Test_Case {

	/**
	 * Test add_to_cart_text().
	 *
	 * @since WC-2.3
	 */
	public function test_add_to_cart_text() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEquals( 'Add to cart', $product->add_to_cart_text() );

		$product->set_stock_status( 'outofstock' );
		$product->save();

		$this->assertEquals( 'Read more', $product->add_to_cart_text() );
	}

	/**
	 * Test single_add_to_cart_text().
	 *
	 * @since WC-2.3
	 */
	public function test_single_add_to_cart_text() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEquals( 'Add to cart', $product->single_add_to_cart_text() );
	}

	/**
	 * Test get_title().
	 *
	 * @since WC-2.3
	 */
	public function test_get_title() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEquals( 'Dummy Product', $product->get_name() );
	}

	/**
	 * Test get_permalink().
	 *
	 * @since WC-2.3
	 */
	public function test_get_permalink() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEquals( get_permalink( $product->get_id() ), $product->get_permalink() );
	}

	/**
	 * Test get_sku().
	 *
	 * @since WC-2.3
	 */
	public function test_get_sku() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEquals( 'DUMMY SKU', $product->get_sku() );
	}

	/**
	 * Test get_stock_quantity().
	 *
	 * @since WC-2.3
	 */
	public function test_get_stock_quantity() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEmpty( $product->get_stock_quantity() );

		$product->manage_stock = 'yes';

		$this->assertEquals( 0, $product->get_stock_quantity() );
	}

	/**
	 * Test is_type().
	 *
	 * @since WC-2.3
	 */
	public function test_is_type() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertTrue( $product->is_type( 'simple' ) );
		$this->assertFalse( $product->is_type( 'grouped' ) );
		$this->assertFalse( $product->is_type( 'variable' ) );
		$this->assertFalse( $product->is_type( 'external' ) );
	}

	/**
	 * Test is_downloadable().
	 *
	 * @since WC-2.3
	 */
	public function test_is_downloadable() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEmpty( $product->is_downloadable() );

		$product->set_downloadable( 'yes' );
		$this->assertTrue( $product->is_downloadable() );

		$product->set_downloadable( 'no' );
		$this->assertFalse( $product->is_downloadable() );
	}

	/**
	 * Test is_virtual().
	 *
	 * @since WC-2.3
	 */
	public function test_is_virtual() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$this->assertEmpty( $product->is_virtual() );

		$product->set_virtual( 'yes' );
		$this->assertTrue( $product->is_virtual() );

		$product->set_virtual( 'no' );
		$this->assertFalse( $product->is_virtual() );
	}

	/**
	 * Test needs_shipping().
	 *
	 * @since WC-2.3
	 */
	public function test_needs_shipping() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$product->set_virtual( 'yes' );
		$this->assertFalse( $product->needs_shipping() );

		$product->set_virtual( 'no' );
		$this->assertTrue( $product->needs_shipping() );
	}

	/**
	 * Test is_sold_individually().
	 *
	 * @since WC-2.3
	 */
	public function test_is_sold_individually() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$product->set_sold_individually( 'yes' );
		$this->assertTrue( $product->is_sold_individually() );

		$product->set_sold_individually( 'no' );
		$this->assertFalse( $product->is_sold_individually() );
	}

	/**
	 * Test backorders_allowed().
	 *
	 * @since WC-2.3
	 */
	public function test_backorders_allowed() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$product->set_backorders( 'yes' );
		$this->assertTrue( $product->backorders_allowed() );

		$product->set_backorders( 'notify' );
		$this->assertTrue( $product->backorders_allowed() );

		$product->set_backorders( 'no' );
		$this->assertFalse( $product->backorders_allowed() );
	}

	/**
	 * Test backorders_require_notification().
	 *
	 * @since WC-2.3
	 */
	public function test_backorders_require_notification() {
		// Create product
		$product = WC_Helper_Product::create_simple_product();

		$product->set_backorders( 'notify' );
		$product->set_manage_stock( 'yes' );
		$this->assertTrue( $product->backorders_require_notification() );

		$product->set_backorders( 'yes' );
		$this->assertFalse( $product->backorders_require_notification() );

		$product->set_backorders( 'no' );
		$this->assertFalse( $product->backorders_require_notification() );

		$product->set_backorders( 'yes' );
		$product->set_manage_stock( 'no' );
		$this->assertFalse( $product->backorders_require_notification() );
	}
}

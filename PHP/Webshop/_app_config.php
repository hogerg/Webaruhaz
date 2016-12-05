<?php
/**
 * @package WEBSHOP
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Home.Home'),
		
	'GET:about' => array('route' => 'Home.About'),
	'GET:contact' => array('route' => 'Home.Contact'),
		
	'GET:login' => array('route' => 'Account.Login'),
	'POST:login' => array('route' => 'Account.LoginRequested'),
	'GET:logout' => array('route' => 'Account.Logout'),
	'GET:register' => array('route' => 'Account.Register'),
	'POST:register' => array('route' => 'Account.RegisterSave'),
		
	'GET:productlist' => array('route' => 'Store.ProductList'),
	'POST:productlist' => array('route' => 'Store.ProductList'),
	'GET:details' => array('route' => 'Store.Details'),
	'GET:shoppingcart' => array('route' => 'Store.ShoppingCart'),
	'GET:additem' => array('route' => 'Store.ShoppingCartAdd'),
	'GET:removeitem' => array('route' => 'Store.ShoppingCartRemove'),
	'GET:dropcart' => array('route' => 'Store.ShoppingCartDrop'),
	'GET:customerdetails' => array('route' => 'Store.CustomerForm'),
	'POST:customerdetails' => array('route' => 'Store.SaveOrder'),
	
	'GET:manageproducts' => array('route' => 'Manager.ProductList'),
	'GET:newproduct' => array('route' => 'Manager.ProductForm'),
	'POST:newproduct' => array('route' => 'Manager.ProductSave'),
	'GET:deleteproduct' => array('route' => 'Manager.ProductDelete'),
	'GET:managecategories' => array('route' => 'Manager.CategoryList'),
	'GET:newcategory' => array('route' => 'Manager.CategoryForm'),
	'POST:newcategory' => array('route' => 'Manager.CategorySave'),
	'GET:deletecategory' => array('route' => 'Manager.CategoryDelete'),
	
	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("OrderDetails","ORDER_DETAIL_ORD_FK",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("OrderDetails","ORDER_DETAIL_PROD_FK",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Product","fk_product_category",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>
<?php
/** @package    WEBSHOP::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Product.php");

class HomeController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code

		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}
	
	public function Home()
	{
		$this->Render('Index'); 
	}

	public function About()
	{
		$this->Render('About');
	}

	public function Contact()
	{
		$this->Render('Contact');
	}

}

?>

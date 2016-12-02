<?php
/** @package    WEBSHOP::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Product.php");
require_once("Model/Category.php");

class ManagerController extends AppBaseController
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

	public function ProductList()
	{
		$products = $this->Phreezer->Query('Product');
		$categories = $this->Phreezer->Query('Category');
		
		$indexedCategories = array();
		foreach($categories as $c)
		{
			$indexedCategories += array($c->Id => $c);
		}

		$this->Assign('products', $products);
		$this->Assign('indexedCategories', $indexedCategories);
		
		$this->Render('ManageProductList');
	}
	
	public function ProductForm()
	{
		$id = intval(RequestUtil::Get('id'));
		
		$inputData = array('name' => '', 'price' => 0, 'categoryId' => 0);
		
		$categories = $this->Phreezer->Query('Category');
		
		if(!Empty($id))
		{
			$product = $this->Phreezer->Get('Product', $id);
			$inputData['name'] = $product->Name;
			$inputData['price'] = $product->Price;
			$inputData['categoryId'] = $product->CategoryId;
		}
		
		$this->Assign('inputData', $inputData);
		$this->Assign('categories', $categories);
		$this->Assign('errors', array());
		
		$this->Render('NewProduct');
	}
	
	public function ProductSave()
	{
		try
		{
			$name = RequestUtil::Get('name');
			$price = intval(RequestUtil::Get('price'));
			$categoryId = intval(RequestUtil::Get('categoryId'));
			
			$product = new Product($this->Phreezer);
			$product->Name = $name;
			$product->Price = $price;
			$product->CategoryId = $categoryId;
			
			$errors = array();
			
			if($name == '')
			{
				$errors += array('name' => 'Név kötelező!');
			}
			if(Empty($price))
			{
				$errors += array('price' => 'Ár kötelező!');
			}
			if(Empty($categoryId))
			{
				$errors += array('categoryId' => 'Kategória kötelező!');
			}
			
			if(count($errors) > 0)
			{
				$this->Assign('errors', $errors);
				$this->Assign('inputData', array('name' => $name, 'price' => $price, 'categoryId' => $categoryId));
				$this->Render('NewProduct');
			}
			else
			{
				$product->Save();
				
				$products = $this->Phreezer->Query('Product');
				$categories = $this->Phreezer->Query('Category');
				
				$indexedCategories = array();
				foreach($categories as $c)
				{
					$indexedCategories += array($c->Id => $c);
				}
				
				$this->Assign('products', $products);
				$this->Assign('indexedCategories', $indexedCategories);
				
				$this->Render('ManageProductList');
			}
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
	public function ProductDelete()
	{
		try
		{
			$id = RequestUtil::Get('id');
			
			if(Empty($id))
			{
				$products = $this->Phreezer->Query('Product');
				$this->Assign('products', $products);
				$this->Render('ManageProductList');
			}
			else
			{
				$product = $this->Phreezer->Get('Product', $id);
				$product->Delete();
				
				$products = $this->Phreezer->Query('Product');
				$categories = $this->Phreezer->Query('Category');
				
				$indexedCategories = array();
				foreach($categories as $c)
				{
					$indexedCategories += array($c->Id => $c);
				}
				
				$this->Assign('products', $products);
				$this->Assign('indexedCategories', $indexedCategories);
				
				$this->Render('ManageProductList');
			}
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	public function CategoryList()
	{
		$categories = $this->Phreezer->Query('Category');
		
		$this->Assign('categories', $categories);

		$this->Render('ManageCategoryList');
	}

	public function CategoryForm()
	{
		$this->Assign('inputData', array('name' => ''));
		$this->Assign('errors', array());
		
		$this->Render('NewCategory');
	}
	
	public function CategorySave()
	{
		try
		{
			$name = RequestUtil::Get('name');
			
			$category = new Category($this->Phreezer);
			$category->Name = $name;
			$category->PicName = 'mock_tetris';
			
			$errors = array();
			
			if(Empty($name))
			{
				$errors += array('name', 'Név kötelező!');
				$this->Assign('errors', $errors);
				$this->Render('NewCategory');
			}
			else
			{
				$category->Save();
				$categories = $this->Phreezer->Query('Category');
					
				$this->Assign('categories', $categories);
					
				$this->Render('ManageCategoryList');
			}
			
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
	
	public function CategoryDelete()
	{
		try 
		{
			$id = RequestUtil::Get('id');
			
			if(!Empty($id))
			{
				$category = $this->Phreezer->Get('Category', $id);
				$category->Delete();

			}

			$categories = $this->Phreezer->Query('Category');
			$this->Assign('categories', $categories);
			$this->Render('ManageCategoryList');
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

}

?>

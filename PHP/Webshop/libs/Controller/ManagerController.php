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
	
	public function AuthenticateManagerRole()
	{
		if(!isset($_SESSION['authUser']) || $_SESSION['authUser'][1] != 'MANAGER')
		{
			header('location: ./403');
			exit();
		}
	}

	public function ProductList()
	{
		$this->AuthenticateManagerRole();
		
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
		$this->AuthenticateManagerRole();
		
		$id = intval(RequestUtil::Get('id'));
		
		$inputData = array('id' => -1,'name' => '', 'price' => 0, 'categoryId' => 0);
		
		$categories = $this->Phreezer->Query('Category');
		
		if(!Empty($id))
		{
			$product = $this->Phreezer->Get('Product', $id);
			$inputData['id'] = $id;
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
		$this->AuthenticateManagerRole();
		
		try
		{
			$id = intval(RequestUtil::Get('id'));
			$name = RequestUtil::Get('name');
			$price = intval(RequestUtil::Get('price'));
			$categoryId = intval(RequestUtil::Get('categoryId'));
			
			$product = new Product($this->Phreezer);
			
			if($id >= 0)
			{
				$product = $this->Phreezer->Get('Product', $id);
			}

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
				$this->Assign('inputData', array('id' => $id, 'name' => $name, 'price' => $price, 'categoryId' => $categoryId));
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
		$this->AuthenticateManagerRole();
		
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
		$this->AuthenticateManagerRole();
		
		$categories = $this->Phreezer->Query('Category');
		
		$this->Assign('categories', $categories);

		$this->Render('ManageCategoryList');
	}

	public function CategoryForm()
	{
		$this->AuthenticateManagerRole();
		
		$this->Assign('inputData', array('name' => ''));
		$this->Assign('errors', array());
		
		$this->Render('NewCategory');
	}
	
	public function CategorySave()
	{
		$this->AuthenticateManagerRole();
		
		try
		{
			$name = RequestUtil::Get('name');
			
			require_once('Model/CategoryCriteria.php');
			$criteria = new CategoryCriteria();
			$criteria->Name_Equals = $name;
			
			$category = new Category($this->Phreezer);
			$category->Name = $name;
			
			$errors = array();
			
			if(Empty($name))
			{
				$errors += array('name' => 'Név kötelező!');
				$this->Assign('errors', $errors);
				$this->Render('NewCategory');
			}
			else if(count($this->Phreezer->Query('Category', $criteria)->ToObjectArray()) > 0)
			{
				$errors += array('name' => 'Már létező kategória!');
				$this->Assign('errors', $errors);
				$this->Render('NewCategory');
			}
			else
			{
				
				$picName = $this->gen_uuid();
				$errors = $this->UploadPicture($picName);
				
				if(count($errors) == 0)
				{
					$category->PicName = $picName;
					$category->Save();
					
					$categories = $this->Phreezer->Query('Category');
					
					$this->Assign('categories', $categories);
						
					$this->Render('ManageCategoryList');
				}
				else
				{
					$this->Assign('errors', array('picture' => $errors));
					$this->Render('NewCategory');
				}	
			}
			
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
	
	public function CategoryDelete()
	{
		$this->AuthenticateManagerRole();
		
		try 
		{
			$id = RequestUtil::Get('id');
			
			if(!Empty($id))
			{
				$category = $this->Phreezer->Get('Category', $id);
				
				require_once('Model/ProductCriteria.php');
				$criteria = new ProductCriteria();
				$criteria->CategoryId_Equals = $id;
				$products = $this->Phreezer->Query('Product', $criteria);

				foreach($products as $p)
				{
					$p->CategoryDeleted();
				}
				
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
	
	public function UploadPicture($filename)
	{
		if(Empty($_FILES['fileToUpload']['name']))
		{
			return array('Nem választott ki képet!');
		}
		$errors = array();
		$target_dir = './images/categories/' ;
		$file = explode(".", $_FILES["fileToUpload"]["name"]);
		$extension = end($file);
		$target_file = $target_dir . $filename . '.jpg';

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			array_push($errors, 'A kiválasztott fájl nem kép!');
			$uploadOk = 0;
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			array_push($errors, 'A kiválasztott fájl már létezik!');
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 2000000) {
			array_push($errors, 'A fájlméret túl nagy (maximum 2MB)!');
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			array_push($errors, 'A támogatott fájltípusok: JPG, JPEG, PNG, GIF!');
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 1) 
		{
			$this->ResizeImage($target_file);
			/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				array_push($errors, 'Hiba történt feltöltés közben!');
			}*/
		}
		
		return $errors;
	}
	
	private function ResizeImage($image)
	{
		$blank = imagecreatefromjpeg('./images/categories/blank.jpg');
		$maxDim = 600;
		
		list($width, $height, $type, $attr) = getimagesize( $_FILES['fileToUpload']['tmp_name'] );
		$fn = $_FILES['fileToUpload']['tmp_name'];
		$size = getimagesize( $fn );
		$ratio = $size[0]/$size[1]; // width/height
		if ( $width > $maxDim || $height > $maxDim ) {
			//$target_filename = $_FILES['fileToUpload']['tmp_name'];
			if( $ratio > 1) {
				$width = $maxDim;
				$height = $maxDim/$ratio;
			} else {
				$width = $maxDim*$ratio;
				$height = $maxDim;
			}
		}
		
		$src = imagecreatefromstring( file_get_contents( $fn ) );
		$dst = imagecreatetruecolor( $width, $height );
		imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
		imagedestroy( $src );
		
		$hoffset = (600 - $width)/2;
		$voffset = (600 - $height)/2;
		imagecopymerge($blank, $dst, $hoffset, $voffset, 0, 0, $width, $height, 100);
		
		imagejpeg( $blank, $image );
		imagedestroy( $dst );
		imagedestroy( $blank );
	}
	
	private function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				// 32 bits for "time_low"
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	
				// 16 bits for "time_mid"
				mt_rand( 0, 0xffff ),
	
				// 16 bits for "time_hi_and_version",
				// four most significant bits holds version number 4
				mt_rand( 0, 0x0fff ) | 0x4000,
	
				// 16 bits, 8 bits for "clk_seq_hi_res",
				// 8 bits for "clk_seq_low",
				// two most significant bits holds zero and one for variant DCE1.1
				mt_rand( 0, 0x3fff ) | 0x8000,
	
				// 48 bits for "node"
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
				);
	}

}

?>

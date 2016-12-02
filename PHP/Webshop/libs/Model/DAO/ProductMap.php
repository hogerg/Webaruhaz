<?php
/** @package    Webshop::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ProductMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ProductDAO to the product datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Webshop::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ProductMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","product","id",true,FM_TYPE_INT,10,null,true);
			self::$FM["Name"] = new FieldMap("Name","product","name",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Price"] = new FieldMap("Price","product","price",false,FM_TYPE_DECIMAL,7.0,null,false);
			self::$FM["CategoryId"] = new FieldMap("CategoryId","product","category_id",false,FM_TYPE_INT,10,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["ORDER_DETAIL_PROD_FK"] = new KeyMap("ORDER_DETAIL_PROD_FK", "Id", "OrderDetails", "ProductId", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_product_category"] = new KeyMap("fk_product_category", "CategoryId", "Category", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>
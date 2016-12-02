<?php
/** @package    Webshop::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * OrderDetailsMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the OrderDetailsDAO to the order_details datastore.
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
class OrderDetailsMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","order_details","id",true,FM_TYPE_VARCHAR,128,null,false);
			self::$FM["Amount"] = new FieldMap("Amount","order_details","amount",false,FM_TYPE_UNKNOWN,null,null,false);
			self::$FM["Price"] = new FieldMap("Price","order_details","price",false,FM_TYPE_UNKNOWN,null,null,false);
			self::$FM["Quantity"] = new FieldMap("Quantity","order_details","quantity",false,FM_TYPE_INT,11,null,false);
			self::$FM["OrderId"] = new FieldMap("OrderId","order_details","order_id",false,FM_TYPE_VARCHAR,128,null,false);
			self::$FM["ProductId"] = new FieldMap("ProductId","order_details","product_id",false,FM_TYPE_INT,10,null,false);
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
			self::$KM["ORDER_DETAIL_ORD_FK"] = new KeyMap("ORDER_DETAIL_ORD_FK", "OrderId", "Order", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["ORDER_DETAIL_PROD_FK"] = new KeyMap("ORDER_DETAIL_PROD_FK", "ProductId", "Product", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>
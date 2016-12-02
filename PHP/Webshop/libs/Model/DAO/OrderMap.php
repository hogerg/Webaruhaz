<?php
/** @package    Webshop::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * OrderMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the OrderDAO to the order datastore.
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
class OrderMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","order","id",true,FM_TYPE_VARCHAR,128,null,false);
			self::$FM["Amount"] = new FieldMap("Amount","order","amount",false,FM_TYPE_UNKNOWN,null,null,false);
			self::$FM["OrderDate"] = new FieldMap("OrderDate","order","order_date",false,FM_TYPE_DATETIME,null,"CURRENT_TIMESTAMP",false);
			self::$FM["OrderNum"] = new FieldMap("OrderNum","order","order_num",false,FM_TYPE_INT,10,null,false);
			self::$FM["CustomerAddress"] = new FieldMap("CustomerAddress","order","customer_address",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["CustomerEmail"] = new FieldMap("CustomerEmail","order","customer_email",false,FM_TYPE_VARCHAR,128,null,false);
			self::$FM["CustomerName"] = new FieldMap("CustomerName","order","customer_name",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["CustomerPhone"] = new FieldMap("CustomerPhone","order","customer_phone",false,FM_TYPE_VARCHAR,128,null,false);
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
			self::$KM["ORDER_DETAIL_ORD_FK"] = new KeyMap("ORDER_DETAIL_ORD_FK", "Id", "OrderDetails", "OrderId", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>
<?php
/** @package Webshop::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("OrderMap.php");

/**
 * OrderDAO provides object-oriented access to the order table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Webshop::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class OrderDAO extends Phreezable
{
	/** @var string */
	public $Id;

	/** @var double */
	public $Amount;

	/** @var date */
	public $OrderDate;

	/** @var int */
	public $OrderNum;

	/** @var string */
	public $CustomerAddress;

	/** @var string */
	public $CustomerEmail;

	/** @var string */
	public $CustomerName;

	/** @var string */
	public $CustomerPhone;


	/**
	 * Returns a dataset of OrderDetails objects with matching OrderId
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetOrderDetailss($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "ORDER_DETAIL_ORD_FK", $criteria);
	}


}
?>
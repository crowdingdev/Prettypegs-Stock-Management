<?php

class DBQueryHelper extends ObjectModel
{

	/**
	* @author Linus Karlsson
	*/
	public static function insertProductStock($id_product_attribute, quantity)
	{
		$sql = 'INSERT INTO '.
		_DB_PREFIX_.'prettypegs_stock_management '.
		' (`id_product_attribute`,`quantity`)
		VALUES (' .
		(int)$id_product_attribute.', '.
		(int)$quantity.
		')';

		$result = Db::getInstance()->Execute($sql);
		if($result){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	* @author Linus Karlsson
	*/
	public static function getAllProductsStocks()
	{
		$result = Db::getInstance()->ExecuteS('
			SELECT * FROM '._DB_PREFIX_.'prettypegs_stock_management '
			);
		return $result;
	}

	/**
	* @author Linus Karlsson
	*/
	public static function getQuantityForProductAttributeId($productAttributeId)
	{
		$result = Db::getInstance()->ExecuteS('
			SELECT psm.quantity FROM '._DB_PREFIX_.'prettypegs_stock_management psm'.
			' WHERE psm.id_product_attribute = '.(int)$productAttributeId
			);
		return $result;
	}

	/**
	* update quantity for product
	* @author Linus Karlsson
	*/
	public static function updateProductStock($id, $quantity)
	{
		$result = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'prettypegs_stock_management` SET
			quantity = ' . (int)$quantity .
			' WHERE id_prettypegs_stock_management = '.(int)$id
			);
		return $result;
	}

}

?>



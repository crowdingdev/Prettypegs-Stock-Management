<?php

/** Module presta2csvorders compatible PS > 1.5 and 1.6
  *Orders Export tab for admin panel, AdminOrdersExport.php
  * @author Vinum Master
  * @copyright Vinum Master
  * @version 1.40
  *
  */


require_once(__DIR__.'/../../classes/StockManagementModel.php');
class PrettypegsAdminStockManagementController extends ModuleAdminController
{
	public function __construct()
	{
		$this->lang = (!isset($this->context->cookie) || !is_object($this->context->cookie)) ? intval(Configuration::get('PS_LANG_DEFAULT')) : intval($this->context->cookie->id_lang);
		parent::__construct();
	}

	public function display()
	{
		parent::display();
	}

	public function renderList()
	{

		//$supplierArray = $this->getSuppliers();
		error_log(function_exists ('getAllProductsStocks') ? 'yes' : 'no');

		//$productStocks = StockManagementModel::getAllProductsStocks();

		$admin_tpl_path = _PS_MODULE_DIR_.'prettypegsstockmanagement'.'/views/templates/admin/';
			$this->context->smarty->assign('admin_tpl_path',$admin_tpl_path);

		$productStocks = Db::getInstance()->ExecuteS('
			SELECT * FROM '._DB_PREFIX_.'prettypegs_stock_management '
		);

  	$this->context->smarty->assign( 'htmlItems', array('productStocks' => $productStocks) );

		//$this->context->smarty->assign( 'items', "dododo" );
		//$this->context->smarty->assign('my_var', $this->my_var);
		//$this->context->controller->addCSS(__DIR__.'/../../css/imagecloudgallery.css');
  	//$this->setTemplate( 'display.tpl' );

  	//$this->base_tpl_view = 'display.tpl';



		//$id_shop = (int)$this->context->shop->id;
  	// $this->context->smarty->assign('htmlItems', array('items' => $items,
			// 'postAction' => 
			// 'index.php?tab=AdminModules&configure='.$this->name
			// .'&token='.Tools::getAdminTokenLite('AdminModules')
			// .'&tab_module=other&module_name='.$this->name.'',
			// 'id_shop' => $id_shop
			// ));

		return $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/display.tpl');

	}

	public function postProcess()
	{

		$id_lang = intval(Configuration::get('PS_LANG_DEFAULT'));

		if (Tools::isSubmit('addStock'))
		{

		}

		else{
			parent::postProcess();
		}

	}

	private function getSuppliers() {

		//return Supplier::getSuppliers();

	}

}

?>
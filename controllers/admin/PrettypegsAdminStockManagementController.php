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

		$this->bootstrap = true;

		parent::__construct();
	}

	public function display()
	{
		parent::display();
	}

	public function renderList()
	{

		//$supplierArray = $this->getSuppliers();
		//error_log(function_exists ('getAllProductsStocks') ? 'yes' : 'no');

		//$productStocks = StockManagementModel::getAllProductsStocks();

		$admin_tpl_path = _PS_MODULE_DIR_.'prettypegsstockmanagement'.'/views/templates/admin/';
		$this->context->smarty->assign('admin_tpl_path',$admin_tpl_path);

		$id_shop = (int)$this->context->shop->id;


		$this->context->controller->addCSS($admin_tpl_path.'css/prettypegsstockmanagement.css', 'all');
		$this->context->controller->addJquery();
		$this->context->controller->addJS($admin_tpl_path.'js/admin.js', 'all');


		$productStocks = Db::getInstance()->ExecuteS(

			' SELECT psm.*, pl.name as name FROM '._DB_PREFIX_.'prettypegs_stock_management psm' .
			' INNER JOIN '._DB_PREFIX_.'product_lang pl ON psm.id_product = pl.id_product and pl.id_lang = 1 where 1 = 1'
			//SELECT * FROM '._DB_PREFIX_.'prettypegs_stock_management where 1 = 1 '
		);

  	$this->context->smarty->assign( 'htmlItems', array('productStocks' => $productStocks,
		'postAction' => 'index.php?tab=AdminModules&configure='.'prettypegsstockmanagement'
			.'&token='.Tools::getAdminTokenLite('AdminModules')
			.'&tab_module=other&module_name='.'prettypegsstockmanagement'.'',
			'id_shop' => $id_shop
  	));

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

	public function setMedia()
  {
    parent::setMedia();

		// $admin_tpl_path = _PS_MODULE_DIR_.'prettypegsstockmanagement'.'/views/templates/admin/';

  	//       $this->addJS(array(		$admin_tpl_path . '/css/prettypegsstockmanagement.css',
  	//                          		$admin_tpl_path . '/js/admin.js'));

		//$this->addJqueryUi(array('ui.core','ui.widget','ui.datepicker'));
		//$this->addjQueryPlugin(array('tagify','autocomplete'));


		// $this->context->controller->addCSS($admin_tpl_path.'css/prettypegsstockmanagement.css' , 'all');
		// $this->context->controller->addJquery();
		// $this->context->controller->addJS($admin_tpl_path.'js/admin.js', 'all');
  }

	public function postProcess()
	{

		$id_lang = intval(Configuration::get('PS_LANG_DEFAULT'));

		if (Tools::isSubmit('updateItem'))
		{
			error_log("updates <>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
			//$this->updateItem();
		}


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
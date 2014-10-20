<?php

/** Module presta2csvorders compatible PS > 1.5 and 1.6
  *Orders Export tab for admin panel, AdminOrdersExport.php
  * @author Vinum Master
  * @copyright Vinum Master
  * @version 1.40
  *
  */


class PrettypegsAdminStockManagementController extends ModuleAdminController
{
	public function __construct()
	{

		$this->lang = (!isset($this->context->cookie) || !is_object($this->context->cookie)) ? intval(Configuration::get('PS_LANG_DEFAULT')) : intval($this->context->cookie->id_lang);

		parent::__construct();

	}

	public function display(){

		parent::display();

	}

	public function renderList() {

		//$supplierArray = $this->getSuppliers();

		$products = Db::getInstance()->ExecuteS('SELECT * FROM `ps_cloud_gallery_image_lang` WHERE `active`= 1 ORDER BY item_order ASC, created_at ASC');

  	$this->context->smarty->assign( array( 'products' => $products ) );
		//$this->context->controller->addCSS(__DIR__.'/../../css/imagecloudgallery.css');
    //$this->setTemplate( 'display.tpl' );

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
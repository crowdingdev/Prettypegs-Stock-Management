<?php
/** Module prettypegs orders export
  * file presta2csvorders.php
  * @author Vinum Master, Linus Karlsson
  * @copyright Vinum Master
  * @version 1.0
  *
  */

//$customerReminderObj->sendMails(Tools::getValue('belvg_abandoned_customerBox'));

class PrettypegsStockManagement extends Module
{
	private $_postErrors = array();


	function __construct()
	{
		if (version_compare(_PS_VERSION_, '1.6', '>='))
			$this->bootstrap = true;

		$this->name = 'prettypegsstockmanagement';
		$this->tab = 'export';
		$this->version = '1.0';
		$this->author = 'Linus Karlsson';
		$this->module_key = '706eaa94138178f175c1fab2b2f550c1';

		/* The parent construct is required for translations */
		parent::__construct();

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Prettypegs Stock Management');
		$this->description = $this->l('Prettypegs special order export system.');

		$this->module_path = _PS_MODULE_DIR_.$this->name.'/';
		$this->uploads_path = _PS_MODULE_DIR_.$this->name.'/img/';
		$this->admin_tpl_path = _PS_MODULE_DIR_.$this->name.'/views/templates/admin/';
		$this->hooks_tpl_path = _PS_MODULE_DIR_.$this->name.'/views/templates/hooks/';

	}


	function install()
	{
		if (!parent::install())
			return false;

		$id_lang = intval(Configuration::get('PS_LANG_DEFAULT'));

		$tab=new tab();
		$tab->name[$id_lang]= 'Prettypegs Stock Management';
		$tab->class_name= 'PrettypegsAdminStockManagement';
		$tab->id_parent=Tab::getIdFromClassName('AdminCatalog');
		$tab->module = $this->name;
		$tab->add();

		$this->registerHook('ActionUpdateQuantity');
		$this->registerHook('DisplayPaymentReturn');
		$this->registerHook('DisplayBackOfficeHeader');
		$this->registerHook('actionOrderStatusUpdate');
		$this->installDB();

		return true;
	}

	function uninstall()
	{
		if (!parent::uninstall())
			return false;
		$idtab=tab::getIdFromClassName('PrettypegsAdminStockManagement');
		$tab=new tab($idtab);
		$tab->delete();
		return true;
	}


	public function hookDisplayPaymentReturn($params){

		// $params['total_to_pay'] = $order->getOrdersTotalPaid();
		// 			$params['currency'] = $currency->sign;
		// 			$params['objOrder'] = $order;
		// 			$params['currencyObj'] = $currency;


	Db::getInstance()->ExecuteS('	INSERT INTO ps_prettypegs_stock_management
		(`product_attribute_reference`,
		`quantity`,
		`id_product`)
		VALUES
		("one new order", 3, 3)'
		);


		echo "dododoododod<pre>";

		print_r($params);

		echo '</pre>';

	}



	public function hookDisplayBackOfficeHeader($params){

       // if(!(Tools::getValue('controller') == 'AdminModules' && Tools::getValue('configure') == 'imagebanner')){
       //    return;
       // }

      $this->context->controller->addCSS($this->module_path .'css/prettypegsstockmanagement.css', 'all');
      $this->context->controller->addJquery();
			$this->context->controller->addJS($this->module_path.'js/admin.js', 'all');
    }

	/**
	* This listens to when a product has been purchased and should be decremented in stock.
	* @author Linus Karlsson
	*/
	public function actionUpdateQuantity($params)
	{
		//error_log("hookActionUpdateQuantity");
		// error_log(print_r($params));
		// error_log("endhookActionUpdateQuantity");

 		echo "sdfhjsdhfkfj hjkdshf skdjfhsdjfkh sdjkdsh jksdhsdkj hfsdkfh<br><br><br><br><br><br><br><br><br>";

 		Db::getInstance()->ExecuteS('	INSERT INTO ps_prettypegs_stock_management
		(`product_attribute_reference`,
		`quantity`,
		`id_product`)
		VALUES
		("one new order", 3, 3)'
		);

		return $params;
	}

	/**
	* Creates the tables in database for this module.
	* @author Linus Lundevall <developer@prettypegs.com>
	*/
	private function installDB()
	{
		return(
			Db::getInstance()->Execute("
			CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."prettypegs_stock_management` (
			  `id_prettypegs_stock_management` int(255) unsigned NOT NULL AUTO_INCREMENT,
			  `product_attribute` varchar(255) NOT NULL,
			  `quantity` int(11) NOT NULL,
			  PRIMARY KEY (`id_prettypegs_stock_management`)
			) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;")
			&&
			Db::getInstance()->Execute("
			CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."prettypegs_stock_management_quantity_history` (
			  `id_prettypegs_stock_management_quantity_history` int(255) unsigned NOT NULL AUTO_INCREMENT,
			  `quantity` int(11) NOT NULL,
			  `created_at` datetime,
			  PRIMARY KEY (`id_prettypegs_stock_management_quantity_history`)
			) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;")
			);

	}




}
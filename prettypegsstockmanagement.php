<?php
/** Module prettypegs orders export
  * file presta2csvorders.php
  * @author Vinum Master, Linus Karlsson
  * @copyright Vinum Master
  * @version 1.0
  *
  */
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
		$this->module_key= '706eaa94138178f175c1fab2b2f550c1';

		/* The parent construct is required for translations */
		parent::__construct();

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Prettypegs Stock Management');
		$this->description = $this->l('Prettypegs special order export system.');


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


	/**
	* This listens to when a product has been purchased and should be decremented in stock.
	* @author Linus Karlsson
	*/

	public function hookActionUpdateQuantity()
	{
		if (Tools::getValue('configure') != $this->name)
			return;
	}




}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Migration Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2019, XDN Team
 * @link		 xdn.com
 */
class Migration_Create_dltmanagement extends CI_Migration {

	private $_table = 'dltmanagement';

	private $_permissions = array(
		array('Dltmanagement Link', 'dltmanagement.dltmanagement.link'),
		array('Dltmanagement List', 'dltmanagement.dltmanagement.list'),
		array('View Dlt', 'dltmanagement.dltmanagement.view'),
		array('Add Dlt', 'dltmanagement.dltmanagement.add'),
		array('Edit Dlt', 'dltmanagement.dltmanagement.edit'),
		array('Delete Dlt', 'dltmanagement.dltmanagement.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'dltmanagement',
			'menu_text' 		=> 'Dltmanagement',    
			'menu_link' 		=> 'dltmanagement/dltmanagement', 
			'menu_perm' 		=> 'dltmanagement.dltmanagement.link', 
			'menu_icon' 		=> 'fa fa-bar-chart', 
			'menu_order' 		=> 4, 
			'menu_active' 		=> 1
		),
	);

	function __construct()
	{
		parent::__construct();

		$this->load->model('core/migrations_model');
	}
	
	public function up()
	{
		// create the table
		

		// add the module permissions
		$this->migrations_model->add_permissions($this->_permissions);

		// add the module menu
		$this->migrations_model->add_menus($this->_menus);
	}

	public function down()
	{
		// drop the table
		

		// delete the permissions
		$this->migrations_model->delete_permissions($this->_permissions);

		// delete the menu
		$this->migrations_model->delete_menus($this->_menus);
	}
}
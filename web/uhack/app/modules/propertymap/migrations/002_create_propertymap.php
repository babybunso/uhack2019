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
class Migration_Create_propertymap extends CI_Migration {

	private $_table = 'propertymap';

	private $_permissions = array(
		array('Propertymap Link', 'propertymap.propertymap.link'),
		array('Propertymap List', 'propertymap.propertymap.list'),
		array('View Propertymap', 'propertymap.propertymap.view'),
		array('Add Propertymap', 'propertymap.propertymap.add'),
		array('Edit Propertymap', 'propertymap.propertymap.edit'),
		array('Delete Propertymap', 'propertymap.propertymap.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'propertymap',
			'menu_text' 		=> 'Propertymap',    
			'menu_link' 		=> 'propertymap/propertymap', 
			'menu_perm' 		=> 'propertymap.propertymap.link', 
			'menu_icon' 		=> 'fa fa-leaf', 
			'menu_order' 		=> 2, 
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
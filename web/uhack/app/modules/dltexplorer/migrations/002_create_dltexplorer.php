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
class Migration_Create_dltexplorer extends CI_Migration {

	private $_table = 'dltexplorer';

	private $_permissions = array(
		array('Dltexplorer Link', 'dltexplorer.dltexplorer.link'),
		array('Dltexplorer List', 'dltexplorer.dltexplorer.list'),
		array('View Explorer', 'dltexplorer.dltexplorer.view'),
		array('Add Explorer', 'dltexplorer.dltexplorer.add'),
		array('Edit Explorer', 'dltexplorer.dltexplorer.edit'),
		array('Delete Explorer', 'dltexplorer.dltexplorer.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'dltexplorer',
			'menu_text' 		=> 'Dltexplorer',    
			'menu_link' 		=> 'dltexplorer/dltexplorer', 
			'menu_perm' 		=> 'dltexplorer.dltexplorer.link', 
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Migration Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		XDN Team <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2019, XDN Team
 * @link		xdn.com
 */
class Migration_Create_typesservice extends CI_Migration {

	private $_table = 'typesservice';

	private $_permissions = array(
		array('Typesservice Link', 'typesservice.typesservice.link'),
		array('Typesservice List', 'typesservice.typesservice.list'),
		array('View Typeservice', 'typesservice.typesservice.view'),
		array('Add Typeservice', 'typesservice.typesservice.add'),
		array('Edit Typeservice', 'typesservice.typesservice.edit'),
		array('Delete Typeservice', 'typesservice.typesservice.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'typesservice',
			'menu_text' 		=> 'Typesservice',    
			'menu_link' 		=> 'typesservice/typesservice', 
			'menu_perm' 		=> 'typesservice.typesservice.link', 
			'menu_icon' 		=> 'fa fa-gear', 
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
		$fields = array(
			'typeservice_id'		=> array('type' => 'INT', 'constraint' => 10, 'auto_increment' => TRUE, 'unsigned' => TRUE, 'null' => FALSE),
			'typeservice_service'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE),
			'typeservice_status'		=> array('type' => 'SET("Active","Disabled")', 'null' => FALSE),

			'typeservice_created_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'typeservice_created_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'typeservice_modified_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'typeservice_modified_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'typeservice_deleted' 		=> array('type' => 'TINYINT', 'constraint' => 1, 'unsigned' => TRUE, 'null' => FALSE, 'default' => 0),
			'typeservice_deleted_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('typeservice_id', TRUE);
		$this->dbforge->add_key('typeservice_service');
		$this->dbforge->add_key('typeservice_status');

		$this->dbforge->add_key('typeservice_deleted');
		$this->dbforge->create_table($this->_table, TRUE);

		// add the module permissions
		$this->migrations_model->add_permissions($this->_permissions);

		// add the module menu
		$this->migrations_model->add_menus($this->_menus);
	}

	public function down()
	{
		// drop the table
		$this->dbforge->drop_table($this->_table, TRUE);

		// delete the permissions
		$this->migrations_model->delete_permissions($this->_permissions);

		// delete the menu
		$this->migrations_model->delete_menus($this->_menus);
	}
}
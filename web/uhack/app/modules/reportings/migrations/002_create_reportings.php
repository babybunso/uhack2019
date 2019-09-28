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
class Migration_Create_reportings extends CI_Migration {

	private $_table = 'reportings';

	private $_permissions = array(
		array('Reportings Link', 'reportings.reportings.link'),
		array('Reportings List', 'reportings.reportings.list'),
		array('View Reporting', 'reportings.reportings.view'),
		array('Add Reporting', 'reportings.reportings.add'),
		array('Edit Reporting', 'reportings.reportings.edit'),
		array('Delete Reporting', 'reportings.reportings.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'reportings',
			'menu_text' 		=> 'Reportings',    
			'menu_link' 		=> 'reportings/reportings', 
			'menu_perm' 		=> 'reportings.reportings.link', 
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
		$fields = array(
			'reporting_id'		=> array('type' => 'INT', 'constraint' => 10, 'auto_increment' => TRUE, 'unsigned' => TRUE, 'null' => FALSE),
			'reporting_name'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE),
			'reporting_type'		=> array('type' => 'SET("Condominium","Townhouse")', 'null' => FALSE),
			'reporting_reporter_id'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE),
			'reporting_report_type'		=> array('type' => 'SET("common","personal")', 'null' => FALSE),
			'reporting_report'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE),
			'reporting_base_location'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
			'reporting_unit_location'		=> array('type' => 'VARCHAR', 'constraint' => 40, 'null' => TRUE),
			'reporting_status'		=> array('type' => 'SET("Active","Disabled")', 'null' => FALSE),
			'reporting_bldg_engr'		=> array('type' => 'SET("Approved","Denied","Pending")', 'null' => FALSE),
			'reporting_bldg_mngr'		=> array('type' => 'SET("Approved","Denied","Pending")', 'null' => FALSE),
			'reporting_opt_mngr'		=> array('type' => 'SET("Approved","Denied","Pending")', 'null' => FALSE),

			'reporting_created_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'reporting_created_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'reporting_modified_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'reporting_modified_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'reporting_deleted' 		=> array('type' => 'TINYINT', 'constraint' => 1, 'unsigned' => TRUE, 'null' => FALSE, 'default' => 0),
			'reporting_deleted_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('reporting_id', TRUE);
		$this->dbforge->add_key('reporting_name');
		$this->dbforge->add_key('reporting_type');
		$this->dbforge->add_key('reporting_reporter_id');
		$this->dbforge->add_key('reporting_report_type');
		$this->dbforge->add_key('reporting_base_location');
		$this->dbforge->add_key('reporting_status');
		$this->dbforge->add_key('reporting_bldg_engr');
		$this->dbforge->add_key('reporting_bldg_mngr');
		$this->dbforge->add_key('reporting_opt_mngr');

		$this->dbforge->add_key('reporting_deleted');
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
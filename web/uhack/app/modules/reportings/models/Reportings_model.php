<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Reportings_model Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2019, XDN Team
 * @link		 xdn.com
 */
class Reportings_model extends BF_Model {

	protected $table_name			= 'reportings';
	protected $key					= 'reporting_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'reporting_created_on';
	protected $created_by_field		= 'reporting_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'reporting_modified_on';
	protected $modified_by_field	= 'reporting_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'reporting_deleted';
	protected $deleted_by_field		= 'reporting_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	public function get_datatables()
	{
		$this->load->model('users/users_groups_model');
		$user = $this->users_groups_model->find_by('user_id', $this->session->userdata('user_id'));
		
	
		$fields = array(
			'reporting_id',
			'reporting_name',
			'reporting_type',
			'reporting_reporter_id',
			'reporting_report_type',
			'reporting_report',
			'reporting_base_location',
			'reporting_unit_location',
			'reporting_status',
			'reporting_bldg_engr',
			'reporting_bldg_mngr',
			'reporting_opt_mngr',

			'reporting_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'reporting_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		return $this->join('users as creator', 'creator.id = reporting_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = reporting_modified_by', 'LEFT')
					->datatables($fields);

		/* if ($user->group_id == 1)
			return $this->join('users as creator', 'creator.id = reporting_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = reporting_modified_by', 'LEFT')
					->datatables($fields);
		else if ($user->group_id == 2) {
			return $this
					->where('reporting_bldg_engr', 'Pending')
					->join('users as creator', 'creator.id = reporting_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = reporting_modified_by', 'LEFT')
					->datatables($fields);
		}
		else if ($user->group_id == 3) {
			return $this
					->where('reporting_bldg_engr', 'Approved')
					->where('reporting_bldg_mngr', 'Pending')
					->join('users as creator', 'creator.id = reporting_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = reporting_modified_by', 'LEFT')
					->datatables($fields);
		}
		else if ($user->group_id == 4) {
			return $this
					->where('reporting_bldg_engr', 'Pending')
					->join('users as creator', 'creator.id = reporting_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = reporting_modified_by', 'LEFT')
					->datatables($fields);
		} */
	}
}
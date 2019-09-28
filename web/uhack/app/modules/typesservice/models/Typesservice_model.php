<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Typesservice_model Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		XDN Team <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2019, XDN Team
 * @link		xdn.com
 */
class Typesservice_model extends BF_Model {

	protected $table_name			= 'typesservice';
	protected $key					= 'typeservice_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'typeservice_created_on';
	protected $created_by_field		= 'typeservice_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'typeservice_modified_on';
	protected $modified_by_field	= 'typeservice_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'typeservice_deleted';
	protected $deleted_by_field		= 'typeservice_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	XDN Team <densetsu.ghem@gmail.com>
	 */
	public function get_datatables()
	{
		$fields = array(
			'typeservice_id',
			'typeservice_service',
			'typeservice_status',

			'typeservice_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'typeservice_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		return $this->join('users as creator', 'creator.id = typeservice_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = typeservice_modified_by', 'LEFT')
					->datatables($fields);
	}
}
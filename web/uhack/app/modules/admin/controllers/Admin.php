<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Admin Class
 *
 * @package		 
 * @version		1.0
 * @author 		 
 * @copyright 	 Copyright (c) 2018
 * @link		 
 */
class Admin extends MX_Controller 
{
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	      
	 */
	public function index()
	{
		// redirect to the list of modules
		redirect('admin/module/action/list', 'refresh');
	}
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */
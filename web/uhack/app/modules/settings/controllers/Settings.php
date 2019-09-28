<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Settings Class
 *
 * @package		 
 * @version		1.0
 * @author 		Robert Christian Obias <robert.obias@digify.com.ph>
 * @copyright 	Copyright (c) 2015,  
 * @link		 
 */
class Settings extends CI_Controller 
{
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('users/acl');
	}
	
	// --------------------------------------------------------------------
	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	Robert Christian Obias <robert.obias@digify.com.ph>
	 */
	public function index() 
	{
		// this class was created just for the navigation menu
	}
}

/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */
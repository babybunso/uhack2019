<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dltmanagement Class
 *
 * @package	 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2019, XDN Team
 * @link		 xdn.com
 */
class Dltmanagement extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->library('users/acl');
		$this->load->language('dltmanagement');
	}
	
	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	public function index()
	{
		$this->acl->restrict('dltmanagement.dltmanagement.list');
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('dltmanagement'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());
		
		
		
		// add plugins
		$this->template->add_css('mods/datatables.net-bs4/css/dataTables.bootstrap4.css');
		$this->template->add_css('mods/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
		$this->template->add_js('mods/datatables.net/js/jquery.dataTables.js');
		$this->template->add_js('mods/datatables.net-bs4/js/dataTables.bootstrap4.js');
		$this->template->add_js('mods/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->add_js('mods/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');

		// render the page
		$this->template->add_css(module_css('dltmanagement', 'dltmanagement_index'), 'embed');
		$this->template->add_js(module_js('dltmanagement', 'dltmanagement_index'), 'embed');
		$this->template->write_view('content', 'dltmanagement_index', $data);
		$this->template->render();
	}	
}

/* End of file Dltmanagement.php */
/* Location: ./application/modules/dltmanagement/controllers/Dltmanagement.php */
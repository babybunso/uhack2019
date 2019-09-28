<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Reportings Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2019, XDN Team
 * @link		 xdn.com
 */
class Reportings extends MX_Controller {
	
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
		$this->load->model('reportings_model');
		$this->load->model('users/users_groups_model');
		$this->load->language('reportings');
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
		$this->acl->restrict('reportings.reportings.list');
		
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('reportings'));
		
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
		$this->template->add_css(module_css('reportings', 'reportings_index'), 'embed');
		$this->template->add_js(module_js('reportings', 'reportings_index'), 'embed');
		$this->template->write_view('content', 'reportings_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * datatables
	 *
	 * @access	public
	 * @param	mixed datatables parameters (datatables.net)
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	public function datatables()
	{
		$this->acl->restrict('reportings.reportings.list');

		echo $this->reportings_model->get_datatables();
	}

	// --------------------------------------------------------------------

	/**
	 * form
	 *
	 * @access	public
	 * @param	$action string
	 * @param   $id integer
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	function form($action = 'add', $id = FALSE)
	{
		$this->acl->restrict('reportings.reportings.' . $action, 'modal');
		$users = $this->users_groups_model->find_by('user_id', $this->session->userdata('user_id'));
		$data['my_group'] = $users->group_id;

		$data['page_heading'] = lang($action . '_heading');
		$data['action'] = $action;

		if ($this->input->post())
		{
			if ($this->_save($action, $id))
			{
				echo json_encode(array('success' => true, 'message' => lang($action . '_success'))); exit;
			}
			else
			{	
				$response['success'] = FALSE;
				$response['message'] = lang('validation_error');
				$response['errors'] = array(					
					'reporting_name'		=> form_error('reporting_name'),
					'reporting_type'		=> form_error('reporting_type'),
					'reporting_reporter_id'		=> form_error('reporting_reporter_id'),
					'reporting_report_type'		=> form_error('reporting_report_type'),
					'reporting_report'		=> form_error('reporting_report'),
					'reporting_base_location'		=> form_error('reporting_base_location'),
					'reporting_unit_location'		=> form_error('reporting_unit_location'),
					'reporting_status'		=> form_error('reporting_status'),
					'reporting_bldg_engr'		=> form_error('reporting_bldg_engr'),
					'reporting_bldg_mngr'		=> form_error('reporting_bldg_mngr'),
					'reporting_opt_mngr'		=> form_error('reporting_opt_mngr'),
				);
				echo json_encode($response);
				exit;
			}
		}

		if ($action != 'add') $data['record'] = $this->reportings_model->find($id);


		

		// render the page
		$this->template->set_template('modal');
		$this->template->add_css(module_css('reportings', 'reportings_form'), 'embed');
		$this->template->add_js(module_js('reportings', 'reportings_form'), 'embed');
		$this->template->write_view('content', 'reportings_form', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * delete
	 *
	 * @access	public
	 * @param	integer $id
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	function delete($id)
	{
		$this->acl->restrict('reportings.reportings.delete', 'modal');

		$data['page_heading'] = lang('delete_heading');
		$data['page_confirm'] = lang('delete_confirm');
		$data['page_button'] = lang('button_delete');
		$data['datatables_id'] = '#datatables';

		if ($this->input->post())
		{
			$this->reportings_model->delete($id);

			echo json_encode(array('success' => true, 'message' => lang('delete_success'))); exit;
		}

		$this->load->view('../../modules/core/views/confirm', $data);
	}


	// --------------------------------------------------------------------

	/**
	 * _save
	 *
	 * @access	private
	 * @param	string $action
	 * @param 	integer $id
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	private function _save($action = 'add', $id = 0)
	{
		// validate inputs
		$this->form_validation->set_rules('reporting_name', lang('reporting_name'), 'required');
		$this->form_validation->set_rules('reporting_type', lang('reporting_type'), 'required');
		$this->form_validation->set_rules('reporting_reporter_id', lang('reporting_reporter_id'), 'required');
		$this->form_validation->set_rules('reporting_report_type', lang('reporting_report_type'), 'required');
		$this->form_validation->set_rules('reporting_report', lang('reporting_report'), 'required');
		//$this->form_validation->set_rules('reporting_base_location', lang('reporting_base_location'), 'required');
		//$this->form_validation->set_rules('reporting_unit_location', lang('reporting_unit_location'), 'required');
		$this->form_validation->set_rules('reporting_status', lang('reporting_status'), 'required');
		$this->form_validation->set_rules('reporting_bldg_engr', lang('reporting_bldg_engr'), 'required');
		$this->form_validation->set_rules('reporting_bldg_mngr', lang('reporting_bldg_mngr'), 'required');
		$this->form_validation->set_rules('reporting_opt_mngr', lang('reporting_opt_mngr'), 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		
		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'reporting_name'		=> $this->input->post('reporting_name'),
			'reporting_type'		=> $this->input->post('reporting_type'),
			'reporting_reporter_id'		=> $this->input->post('reporting_reporter_id'),
			'reporting_report_type'		=> $this->input->post('reporting_report_type'),
			'reporting_report'		=> $this->input->post('reporting_report'),
			'reporting_base_location'		=> $this->input->post('reporting_base_location'),
			'reporting_unit_location'		=> $this->input->post('reporting_unit_location'),
			'reporting_status'		=> $this->input->post('reporting_status'),
			'reporting_bldg_engr'		=> $this->input->post('reporting_bldg_engr'),
			'reporting_bldg_mngr'		=> $this->input->post('reporting_bldg_mngr'),
			'reporting_opt_mngr'		=> $this->input->post('reporting_opt_mngr'),
		);
		

		if ($action == 'add')
		{
			$insert_id = $this->reportings_model->insert($data);
			$return = (is_numeric($insert_id)) ? $insert_id : FALSE;
		}
		else if ($action == 'edit')
		{	
			//check if all approved
			if ($this->input->post('reporting_bldg_engr') == 'Approved' && 
				$this->input->post('reporting_bldg_mngr')== 'Approved' &&
				$this->input->post('reporting_opt_mngr') == 'Approved') {
					
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_PORT => "7338",
						CURLOPT_URL => "http://18.140.54.91:7338",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => "{\"method\":\"sendassetfrom\",\"params\":[\"1UppndQL8gKuTRSiwAiTLkvRWMGTt3rWdmiuXB\",\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\",\"xdncoin\",0,0,\"{\\\"payment info\\\":\\\"from admin to gaile\\\"}\"],\"id\":\"63219905-1563605760\",\"chain_name\":\"dlt_xdn\"}",
						CURLOPT_HTTPHEADER => array(
							"Accept: *\/*",
							"Authorization: Basic bXVsdGljaGFpbnJwYzpGQzhCQnI3dUJtamk0OVRoZVE5TkU3cmRGYVZtYXVaaEdRelNqeWpVRWhpWQ==",
							"Content-Type: application/json",
							"Host: 18.140.54.91:7338",
								"cache-control: no-cache",
							),
					));
				
					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					/* if ($err) {
						echo "cURL Error #:" . $err;
					} else {
						$data['transactions'] =  json_decode($response);
						
					} */

			}

			$return = $this->reportings_model->update($id, $data);
		}

		return $return;

	}
}

/* End of file Reportings.php */
/* Location: ./application/modules/reportings/controllers/Reportings.php */
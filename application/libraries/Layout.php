<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout {
	
	protected $CI;
	
	protected $layout;
	protected $current_section;
	protected $sections = array();

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function view($view, $vars = array())
	{
		$this->CI->load->view($view, $vars);
		$this->CI->load->view($this->layout);
	}

	public function extend($layout)
	{
		$this->layout = $layout;
	}

	public function section($name)
	{
		$this->current_section = $name;

		ob_start();
	}

	public function end_section()
	{
		$content = ob_get_clean();

		$this->sections[$this->current_section] = $content;
	}

	public function render_section($section_name)
	{
		if (isset($this->sections[$section_name]) === FALSE)
		{
			echo '';
		}
		else
		{
			echo $this->sections[$section_name];
		}
	}

	public function include($view)
	{
		$this->CI->load->view($view);
	}
}

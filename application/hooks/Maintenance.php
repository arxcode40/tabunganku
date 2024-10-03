<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance {
	
	public function run()
	{
		if (ENVIRONMENT === 'maintenance')
		{
			show_error('Service Unavailable', 503);
		}
	}
}

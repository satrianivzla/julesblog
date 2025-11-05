<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		/* This Application Must Be Used With BootStrap 5 *  */
		$config['full_tag_open'] 	= '<div class="pagging text-center"><nav aria-label="Page navigation example"><ul class="pagination">'.PHP_EOL;  
		$config['full_tag_close'] 	= '</ul></nav></div>'.PHP_EOL;  
		$config['num_tag_open'] 	= '<li class="page-item">'.PHP_EOL;  
		$config['num_tag_close'] 	= '</li>'.PHP_EOL;  
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">'.PHP_EOL;  
		$config['cur_tag_close'] 	= '</span></li>'.PHP_EOL;  
		$config['next_tag_open'] 	= '<li class="page-item">'.PHP_EOL;  
		$config['next_tagl_close'] 	= '<span aria-hidden="true">Next &raquo;</span></li>'.PHP_EOL;  
		$config['prev_tag_open'] 	= '<li class="page-item">'.PHP_EOL;  
		$config['prev_tagl_close'] 	= '<span aria-hidden="true">Previous &raquo;</span></li>'.PHP_EOL;  
		$config['first_tag_open'] 	= '<li class="page-item">'.PHP_EOL;  
		$config['first_tagl_close'] = '</li>'.PHP_EOL;  
		$config['last_tag_open'] 	= '<li class="page-item">'.PHP_EOL;  
		$config['last_tagl_close'] 	= '</li>'.PHP_EOL;  

		$config['attributes'] = array('class' => 'page-link');

		// end of file Pagination.php 
		// Location config/pagination.php 
		?>
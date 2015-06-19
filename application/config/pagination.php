<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani,S.SI
     * @web : http://www.risetkomputer.com
     * @keterangan : Config pagination 
     **/
    
	// for paging style purpose
    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div>';
    $config['first_link'] = '&laquo; Pertama';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Terakhir &raquo;';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = 'Selanjutnya &rarr;';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&larr; Sebelumnya';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';

/* End of file routes.php */
/* Location: ./application/config/pagination.php */
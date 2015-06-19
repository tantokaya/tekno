<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kalender extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman WP
     **/

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');


            $d['judul']         ="kalender";
            $d['judul_halaman'] = "Daftar Kalender Agenda";


            $d['content']= $this->load->view('kalender/view',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }


}

/* End of file stkk.php */
/* Location: ./application/controllers/stkk.php */
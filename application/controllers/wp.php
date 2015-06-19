<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wp extends CI_Controller {

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


            $d['judul']         ="list_wp";
            $d['judul_halaman'] = "Daftar WP";

            $d['all_wp']	    = $this->app_model->get_all_wp();

            $d['content']= $this->load->view('wp/view',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }

    public function tambah(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']           = $this->config->item('prg');
            $d['web_prg']       = $this->config->item('web_prg');

            $d['nama_program']  = $this->config->item('nama_program');
            $d['instansi']      = $this->config->item('instansi');
            $d['usaha']         = $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');

            $d['judul']='add_wp';
            $d['judul_halaman']='Tambah WP';

            $d['code']      = '';
            $d['name']      = '';
            $d['desc']      = '';
            $d['lead']    = '';

            $text = "SELECT tbl_wbs.wbs_code,tbl_wbs.wbs_name,tbl_wbs.wbs_desc FROM tbl_wbs";
            $d['l_wbs'] = $this->app_model->manualQuery($text);
			
			$text_lead = "SELECT * FROM tbl_admin";
			$d['l_lead'] = $this->app_model->manualQuery($text_lead);

            $d['content']= $this->load->view('wp/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function simpan (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $up['wp_code']  = $this->input->post('code');
            $up['wp_name']	= $this->input->post('name');
            $up['wp_desc']	= $this->input->post('desc');
            $up['wbs_code'] = $this->input->post('wbs');
            $up['username']= $this->input->post('lead');

            $id['wp_code']	= $this->input->post('code');

            $data = $this->app_model->getSelectedData("tbl_wp",$id);

            if($data->num_rows()>0){
                $this->app_model->updateData("tbl_wp",$up,$id);

            }else{
                $this->app_model->insertData("tbl_wp",$up);
            }
        }else{
            header('location:'.base_url());
        }
    }

    public function edit(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');

            $d['judul']='edit_wp';
            $d['judul_halaman']='Edit WP';

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_wp WHERE wp_code='$id'";
            $data = $this->app_model->manualQuery($text);

            if($data->num_rows() > 0){
                foreach($data->result() as $db){
                    $d['code']		= $id;
                    $d['name']		= $db->wp_name;
                    $d['desc']      = $db->wp_desc;
                    $d['wbs']       = $db->wbs_code;
                    $d['lead']    = $db->username;
                }
            }else{

                $d['code']		    = $id;
                $d['name']		    = '';
                $d['desc']          = '';
                $d['wbs']           = '';
                $d['lead']           = '';
            }

            $text = "SELECT tbl_wbs.wbs_code,tbl_wbs.wbs_name,tbl_wbs.wbs_desc FROM tbl_wbs";
            $d['l_wbs'] = $this->app_model->manualQuery($text);
			
			$text_lead = "SELECT * FROM tbl_admin";
			$d['l_lead'] = $this->app_model->manualQuery($text_lead);


            $d['content']= $this->load->view('wp/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function hapus()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_wp WHERE wp_code='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/wp'>";
        }else{
            header('location:'.base_url());
        }
    }
}

/* End of file wp.php */
/* Location: ./application/controllers/wp.php */
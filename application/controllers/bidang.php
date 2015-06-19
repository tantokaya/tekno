<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidang extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman WBS
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


            $d['judul']         ="list_wbs";
            $d['judul_halaman'] = "Daftar Bidang";

            $d['all_wbs']	    = $this->app_model->get_all_wbs();

            $d['content']= $this->load->view('bidang/view',$d,true);
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

            $d['judul']='add_wbs';
            $d['judul_halaman']='Tambah Bidang';

            $d['code']      = '';
            $d['name']      = '';
            $d['desc']      = '';
            //$d['leader']    = '';
			$d['gl']		= '';
            $d['stkk']    	= '';

            $text = "SELECT * FROM tbl_stkk";
            $d['l_stkk'] = $this->app_model->manualQuery($text);
			
			$text_gl = "SELECT * FROM tbl_admin";
			$d['l_gl'] = $this->app_model->manualQuery($text_gl);

            $d['content']= $this->load->view('bidang/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function simpan (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $up['wbs_code'] = $this->input->post('code');
            $up['wbs_name']	= $this->input->post('name');
            $up['wbs_desc']	= $this->input->post('desc');
            $up['username'] = $this->input->post('gl');
            $up['stkk_code']= $this->input->post('stkk');

            $id['wbs_code']	= $this->input->post('code');

            $data = $this->app_model->getSelectedData("tbl_wbs",$id);
			print_r($data);

            if($data->num_rows()>0){
                $this->app_model->updateData("tbl_wbs",$up,$id);

            }else{
                $this->app_model->insertData("tbl_wbs",$up);
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

            $d['judul']='edit_wbs';
            $d['judul_halaman']='Edit Bidang';

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_wbs WHERE wbs_id='$id'";
            $data = $this->app_model->manualQuery($text);

            if($data->num_rows() > 0){
                foreach($data->result() as $db){
                    $d['id']		    =$id;
					$d['code']		    =$db->wbs_code;
                    $d['name']		    =$db->wbs_name;
                    $d['desc']		    =$db->wbs_desc;
                    $d['gl']	    	=$db->username;
                    $d['stkk']	        =$db->stkk_code;
                }
            }else{
				$d['id']		    =$id;
                $d['code']		    = '';
                $d['name']		    = '';
                $d['desc']		    = '';
                $d['gl']	   		= '';
                $d['stkk']	    	= '';
            }

            $text = "SELECT * FROM tbl_stkk";
            $d['l_stkk'] = $this->app_model->manualQuery($text);
			
			$text_gl = "SELECT * FROM tbl_admin";
            $d['l_gl'] = $this->app_model->manualQuery($text_gl);

            $d['content']= $this->load->view('bidang/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function hapus()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_wbs WHERE wbs_id='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/bidang'>";
        }else{
            header('location:'.base_url());
        }
    }
}

/* End of file bidang.php */
/* Location: ./application/controllers/bidang.php */
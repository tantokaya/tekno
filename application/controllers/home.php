<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman awal ketika aplikasi diakses
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


            $d['judul']="dashboard";
            $d['judul_halaman']="Dashboard";

            $kode	= $this->app_model->MaxKodeTugas();

            $d['code_t']      = $kode;
            $d['name_t']      = '';
            $d['icon']      = '';

            $text = "SELECT * FROM tbl_icon";
            $d['l_icon'] = $this->app_model->manualQuery($text);

	    $d['jml_topik_perkenalan'] = $this->app_model->JmlTopikPerkenalan();
            $d['jml_topik_pengumuman'] = $this->app_model->JmlTopikPengumuman();
            $d['jml_topik_saran'] = $this->app_model->JmlTopikSaran();
            $d['jml_topik_pojok'] = $this->app_model->JmlTopikPojok();

            $d['all_tugas']	    = $this->app_model->get_all_tugas();

            $d['content']= $this->load->view('dashboard',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }

    public function simpan_tugas (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
  	    $nama = $this->session->userdata('username');
            $up['username']     = $nama;
            $up['tugas_code']	= $this->input->post('code_t');
            $up['tugas_name']   = $this->input->post('name_t');
            $up['icon_id']	    = $this->input->post('icon');

            $id['tugas_code']	= $this->input->post('code_t');

            $data = $this->app_model->getSelectedData("tbl_tugas",$id);

            if($data->num_rows()>0){
                $this->app_model->updateData("tbl_tugas",$up,$id);

            }else{
                $this->app_model->insertData("tbl_tugas",$up);
            }
        }else{
            header('location:'.base_url());
        }
    }

    public function hapus_tugas()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_tugas WHERE tugas_code='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/home'>";
        }else{
            header('location:'.base_url());
        }
    }

/*----------------------- Simpan Chat --------------------------------------*/
    public function simpan_chat (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $up['tugas_code']	= $this->input->post('code_t');
            $up['tugas_name']   = $this->input->post('name_t');
            $up['icon_id']	    = $this->input->post('icon');

            $id['tugas_code']	= $this->input->post('code_t');

            $data = $this->app_model->getSelectedData("tbl_tugas",$id);

            if($data->num_rows()>0){
                $this->app_model->updateData("tbl_tugas",$up,$id);

            }else{
                $this->app_model->insertData("tbl_tugas",$up);
            }
        }else{
            header('location:'.base_url());
        }
    }

    public function kirim (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $nama = $this->app_model->CariUserPengguna();
            $time = gmdate("Y-m-d H:i:s", time()+60*60*7);

            $up['user']	    = $nama;
            $up['pesan']	= $this->input->post('pesan');
            $up['waktu']    = $time;

            $this->app_model->insertData("tbl_chat",$up);

        }else{
            header('location:'.base_url());
        }
    }

    public function DataDetail()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
           $tampil=mysql_query("SELECT tbl_chat.id_chat,tbl_chat.`user`,tbl_chat.waktu,tbl_chat.pesan,tbl_admin.foto,tbl_admin.nama_lengkap
                FROM tbl_chat INNER JOIN tbl_admin ON tbl_chat.`user` = tbl_admin.username ORDER BY tbl_chat.waktu ASC");
            while($r=mysql_fetch_array($tampil)){
                echo "<li><b> $r[nama_lengkap] </b> : (<i>$r[waktu]</i>)  <p> $r[pesan] </p>
                </li><br>";
            }

//          $this->load->view('chat_detail');
        }else{
            header('location:'.base_url());
        }
    }

    public function logout(){
        $cek = $this->session->userdata('logged_in');
        if(empty($cek))
        {
            header('location:'.base_url().'index.php/login');
        }else{
            $this->session->sess_destroy();
            header('location:'.base_url().'index.php/login');
        }
    }
	
	// handling event calendar
	public function generate_event()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
			$data = $this->app_model->get_all_event();
			print_r(json_encode($data));		
		}
	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
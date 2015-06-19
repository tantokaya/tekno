<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman pengguna
     **/

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $cari = $this->input->post('txt_cari');

            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');


            $d['judul']="list_pengguna";
            $d['judul_halaman']="Daftar Tabel Pengguna";

            $text = "SELECT * FROM tbl_admin ORDER BY username ASC ";
            $d['data'] = $this->app_model->manualQuery($text);


            $d['content'] = $this->load->view('pengguna/view', $d, true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function tambah()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');

            $d['judul']="add_pengguna";
            $d['judul_halaman'] = "Tambah Pengguna";

            $d['username']		= '';
            $d['nama_lengkap']	= '';
            $d['pwd']			= '';
            $d['level']			= '';
            $d['nip']           = '';

            $d['hp']            = '';
            $d['email']         = '';
            $d['foto']          = '';

            $text = "SELECT tbl_level.id_level,tbl_level.`level` FROM tbl_level";
            $d['l_level'] = $this->app_model->manualQuery($text);

            $wbs = $this->app_model->get_all_wbs();

            $output = '<ul>';
			/*
            $output .= '<li id="KP">Kepala Program</li>';
            $output .= '<li id="CE">Chief Engineer</li>';
            $output .= '<li id="PM">Manajer Program</li>';
			*/
			
            foreach($wbs as $rs){
                $cek_wp = $this->app_model->get_wp_by_wbs_code($rs['wbs_code']);
                if($cek_wp){
                    $output .= '<li id="'.$rs['wbs_code'].'" class="folder">'.$rs['wbs_code'].' - '.$rs['wbs_name'];
                    $output .= '<ul>';
                    foreach($cek_wp as $wp){
                        $output .= '<li id="'.$wp['wp_code'].'">'.$wp['wp_code'].' - '.$wp['wp_name'].'</li>';
                    }
                    $output .= '</ul></li>';
                } else {
                    $output .= '<li id="'.$rs['wbs_code'].'">'.$rs['wbs_code'].' - '.$rs['wbs_name'].'</li>';
                }
            }
            $output .= '</ul>';

            #echo $output; exit;
            $d['l_jabatan'] = $output;

            $text = "SELECT tbl_wp.wp_code,tbl_wp.wp_name,tbl_wp.wp_desc,tbl_wp.wbs_code FROM tbl_wp";
            $d['l_wp'] = $this->app_model->manualQuery($text);

            $d['content'] = $this->load->view('pengguna/form', $d, true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function edit()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');

            $d['judul'] = "edit_pengguna";
            $d['judul_halaman']="Edit Pengguna";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_admin WHERE username='$id'";
            $data = $this->app_model->manualQuery($text);
            if($data->num_rows() > 0){
                foreach($data->result() as $db){
                    $d['username']		=$id;
                    $d['nama_lengkap']	=$db->nama_lengkap;
                    $d['pwd']	        ='';
                    $d['level']			=$db->id_level;
                    $d['nip']           = $db->nip;

                    $d['hp']        = $db->hp;
                    $d['email']     = $db->email;
                    $d['foto']     = $db->foto;
                    $d['jabatan']   = $db->jabatan;
                }
            }else{
                $d['username']		= $id;
                $d['nama_lengkap']	= '';
                $d['pwd']	        = '';
                $d['level']			= '';
                $d['nip']           = '';

                $d['hp']            = '';
                $d['email']         = '';
                $d['foto']         = '';
                $d['jabatan']       ='';
            }

            $text = "SELECT tbl_level.id_level,tbl_level.`level` FROM tbl_level";
            $d['l_level'] = $this->app_model->manualQuery($text);

            $text = "SELECT tbl_wp.wp_code,tbl_wp.wp_name,tbl_wp.wp_desc,tbl_wp.wbs_code FROM tbl_wp";
            $d['l_wp'] = $this->app_model->manualQuery($text);


            $wbs = $this->app_model->get_all_wbs();

            $curr_jabatan = explode(',', $d['jabatan']);
            $output = '<ul>';
            // cek troika
			/*
            $troika_array = array("KP", "CE", "PM");
            $troika_label = array("Kepala Program", "Chief Engineer", "Manager Program");
            for($i = 0; $i < count($troika_array); $i++)
            {
                if(in_array($troika_array[$i], $curr_jabatan))
                    $output .= '<li id="'.$troika_array[$i].'" class="selected">'.$troika_label[$i].'</li>';
                else
                    $output .= '<li id="'.$troika_array[$i].'">'.$troika_label[$i].'</li>';

            }
			*/
			
            foreach($wbs as $rs){
                $cek_wp = $this->app_model->get_wp_by_wbs_code($rs['wbs_code']);
                if($cek_wp){
                    if(in_array($rs['wbs_code'],$curr_jabatan))
                        $output .= '<li id="'.$rs['wbs_code'].'" class="folder selected">'.$rs['wbs_code'].' - '.$rs['wbs_name'];
                    else
                        $output .= '<li id="'.$rs['wbs_code'].'" class="folder">'.$rs['wbs_code'].' - '.$rs['wbs_name'];
                            $output .= '<ul>';
                                foreach($cek_wp as $wp){
                                    if(in_array($wp['wp_code'], $curr_jabatan))
                                        $output .= '<li id="'.$wp['wp_code'].'" class="selected">'.$wp['wp_code'].' - '.$wp['wp_name'].'</li>';
                                    else
                                        $output .= '<li id="'.$wp['wp_code'].'">'.$wp['wp_code'].' - '.$wp['wp_name'].'</li>';
                                }
                                        $output .= '</ul></li>';
                } else {
                    if(in_array($rs['wbs_code'],$curr_jabatan))
                        $output .= '<li id="'.$rs['wbs_code'].'" class="selected">'.$rs['wbs_code'].' - '.$rs['wbs_name'].'</li>';
                    else
                        $output .= '<li id="'.$rs['wbs_code'].'">'.$rs['wbs_code'].' - '.$rs['wbs_name'].'</li>';
                }
            }
            $output .= '</ul>';

            #echo $output; exit;
            $d['l_jabatan'] = $output;
            $d['content'] = $this->load->view('pengguna/form', $d, true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }

    }

    public function simpan()
    {

        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $pwd 	= $this->input->post('pwd');
            $nama 	= $this->input->post('nama_lengkap');
            $level	= $this->input->post('level');
            $user	= mysql_real_escape_string($this->input->post('username'));

            $up['username']		= $user;
            $up['nama_lengkap']	= $nama;
            $up['password']		= md5($pwd);
            $up['id_level']	= $level;
            $up['nip']      = $this->input->post('nip');

            $up['hp']       = $this->input->post('hp');
            $up['email']    = $this->input->post('email');
            $up['jabatan'] = $this->input->post('jabatan');


            $id['username']=$this->input->post('username');

            #echo '<pre>'; print_r($up); exit;

            // cek jika ada file yg diupload
            if (!empty($_FILES['userfile']['name'])) {
                // upload
                $config['upload_path'] = './uploads/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size']	= '1024';
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';

                $this->load->library('upload');
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); exit();
                }
                else
                {
                    $pp = array('upload_data' => $this->upload->data());
                }

                $up['foto'] = $pp['upload_data']['file_name'];

            }

            //print_r($up); exit();


            $data = $this->app_model->getSelectedData("tbl_admin",$id);
            if($data->num_rows()>0){
                if(empty($pwd)){

                    if(!empty($up['foto'])){
                        $this->app_model->manualQuery("UPDATE tbl_admin SET nama_lengkap='$nama', id_level='$level', jabatan='$up[jabatan]', foto='$up[foto]' WHERE username='$user'");
                        $result = $data->row_array();
                        // print_r($result); exit();
                        // hapus image lama
                        $old_dir = './uploads/profile/';
                        if(file_exists($old_dir . $result['foto'])){

                            unlink($old_dir . $result['foto']);
                        }
                    } else {
                        $this->app_model->manualQuery("UPDATE tbl_admin SET nama_lengkap='$nama', id_level='$level', jabatan='$up[jabatan]' WHERE username='$user'");
                    }
                }else{
                    $this->app_model->updateData("tbl_admin",$up,$id);
                }

            }else{
                $this->app_model->insertData("tbl_admin",$up);

            }
            redirect('pengguna');

        }else{
            header('location:'.base_url());
        }

    }

  public function hapus()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);

            //cek file upload
            $data = $this->app_model->getSelectedData('tbl_admin', array('username' => $id));
            if($data->num_rows() > 0 )
            {
                $result = $data->row_array();
                // hapus image lama
                $old_dir = './uploads/profile/';
                if(file_exists($old_dir . $result['foto'])){
                    unlink($old_dir . $result['foto']);
                }
            }
            $this->app_model->manualQuery("DELETE FROM tbl_admin WHERE username='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/pengguna'>";
        }else{
            header('location:'.base_url());
        }
    }
}

/* End of file pengguna.php */
/* Location: ./application/controllers/pengguna.php */
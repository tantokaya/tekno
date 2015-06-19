<?

class Captcha extends Controller {

	function Captcha()
	{
		parent::Controller();
		$this->load->model(array('Mediatutorialcaptcha'));
                $this->load->helper(array('form','url'));
                $this->load->database();
	}
	
	function index(){
		$data['title'] = 'Percobaan Captcha MediaTutorial';
		$data['cap_img'] = $this ->Mediatutorialcaptcha->make_captcha();
		if($this->input->post('submit')) {
			if($this->Mediatutorialcaptcha->check_captcha()==TRUE)
				echo "<span style=\"color:blue;\">Captcha cocok</span>";
			else
				echo "<span style=\"color:red;\"> MAAP, CAPTCHA SALAH</span>";
		}
		$this->load->view('_view_captcha', $data);
	}
}
?>
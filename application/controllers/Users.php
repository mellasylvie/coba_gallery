<?php

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        $data['title'] = "Users";
        $this->load->view('layout/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function register()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|max_length[100]|is_unique[user.username]'
        );
        $this->form_validation->set_rules(
            'nama_lengkap',
            'Nama Lengkap',
            'required|max_length[100]'
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|max_length[100]'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|max_length[100]'
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|max_length[100]'
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = "Users - Register";
            $this->session->set_flashdata('err_message', validation_errors());
            $this->load->view('layout/header', $data);
            $this->load->view('users/register', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap'));
            $email = htmlspecialchars($this->input->post('email'));
            $password = htmlspecialchars($this->input->post('password'));
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $alamat = htmlspecialchars($this->input->post('alamat'));

            $data = [
                'username' => $username,
                'nama_lengkap' => $nama_lengkap,
                'email' => $email,
                'password' => $hashPassword,
                'alamat' => $alamat,
            ];
            $registerModel = $this->doRegister($data);
            if ($registerModel == 0) {
                $this->session->set_flashdata('message', "data berhasil ditambahkan");
                redirect('users/register');
            } else {
                $this->session->set_flashdata('err_message', "data gagal ditambahkan");
                redirect('users/register');
            }
        }
    }

    private function doRegister($data)
    {
        $err_code = 0;

        $doRegister = $this->Users_model->register($data);
        if ($doRegister) {
            $err_code = 0;
            return $err_code;
        } else {
            $err_code++;
            return $err_code;
        }
    }

    public function login()
    {

        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|max_length[100]'
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|max_length[100]'
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = "Users - Login";
            $this->load->view('layout/header', $data);
            $this->load->view('users/login', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));

            $data = [
                'username' => $username,
                'password' => $password,
            ];
            $loginModel = $this->doLogin($data);

            if ($loginModel['err_code'] == 0) {
                $this->session->set_flashdata('message', "Berhasil login");
                redirect('users/login');
            } else {
                $this->session->set_flashdata('err_message', $loginModel['message']);
                redirect('users/login');
            }
        }
    }

    private function doLogin($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $err_code = 0;
        $message = '';

        $account = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($account) {
            if (password_verify($password, $account['password'])) {
                unset($password);
                $data_session = [
                    'user_id' => $account['user_id'],
                    'username' => $account['username'],
                    'email' => $account['email'],
                    'nama_lengkap' => $account['nama_lengkap'],
                    'alamat' => $account['alamat'],
                ];
                $this->session->set_userdata($data_session);
            } else {
                $err_code++;
                $message = "Maaf Password Salah";
            }
        } else {
            $err_code++;
            $message = "Maaf Username tidak ditemukan";
        }

        $dataResult = [
            'err_code' => $err_code,
            'message' => $message,
        ];
        return $dataResult;
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama_lengkap');
        $this->session->unset_userdata('alamat');
        $this->session->set_flashdata('message', "Berhasil Logout");
        redirect('users/login');
    }
}

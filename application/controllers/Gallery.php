<?php
class Gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('message', "Silahkan Login terlebih dahulu");
            redirect('users/login');
        }
        $this->load->model('Gallery_model');
    }
    public function index()
    {
        $data['title'] = "Gallery";
        $data['gallery'] = $this->Gallery_model->getDataAlbum();
        $this->load->view('layout/header', $data);
        $this->load->view('gallery/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function detail($id)
    {
        $idDecode = base64_decode($id);
        $data['title'] = "Gallery";
        $data['gallery_foto'] = $this->Gallery_model->albumFotoGet($idDecode);
        // var_dump($data['gallery_foto']);
        // die;
        $this->load->view('layout/header', $data);
        $this->load->view('gallery/gallery_foto', $data);
        $this->load->view('layout/footer', $data);
    }

    public function detail_foto($id)
    {
        $idFotoDecode = base64_decode($id);
        $data['title'] = "Gallery";
        $data['comment_picture'] = $this->Gallery_model->getCommentPicture($idFotoDecode);
        $data['like_picture'] = $this->Gallery_model->getLikePicture($idFotoDecode);
        $data['count_like'] = $this->Gallery_model->countLike($idFotoDecode);

        $this->load->view('layout/header', $data);
        $this->load->view('gallery/detail_foto', $data);
        $this->load->view('layout/footer', $data);
    }
}

<?php
class Gallery_model extends CI_Model
{
    public function getDataAlbum()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('album');
        return $query->result_array();
    }

    public function getDataFoto($album_id)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('album_id', $album_id);
        $query = $this->db->get('foto');
        return $query->result_array();
    }

    public function albumFotoGet($album_id)
    {
        $this->db->select('foto.foto_id, foto.judul_foto, foto.deskripsi_foto, foto.tanggal_unggah, foto.lokasi_file, foto.album_id, foto.user_id, album.album_id as ALBUMID, album.nama_album, album.user_id AS ALBUMUSER');
        $this->db->from('foto');
        $this->db->join('album', 'foto.album_id = album.album_id', 'left');
        $this->db->where('album.user_id', $this->session->userdata('user_id'));
        $this->db->where('album.album_id', $album_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCommentPicture($id_foto)
    {
        $this->db->select('foto.foto_id, foto.judul_foto, foto.deskripsi_foto, foto.tanggal_unggah, foto.lokasi_file, foto.album_id, foto.user_id, komentarfoto.komentar_id, komentarfoto.foto_id, komentarfoto.user_id, komentarfoto.isi_komentar, komentarfoto.tanggal_komentar, user.user_id, user.username, user.nama_lengkap');
        $this->db->from('komentarfoto');
        $this->db->join('foto', 'foto.foto_id = komentarfoto.foto_id', 'left');
        $this->db->join('user', 'foto.user_id = user.user_id', 'left');
        $this->db->where('foto.user_id', $this->session->userdata('user_id'));
        $this->db->where('foto.foto_id', $id_foto);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLikePicture($id_foto)
    {
        $this->db->select('foto.foto_id, foto.judul_foto, foto.deskripsi_foto, foto.tanggal_unggah, foto.lokasi_file, foto.album_id, foto.user_id, likefoto.like_id, likefoto.foto_id, likefoto.user_id, likefoto.tanggal_like');
        $this->db->from('likefoto');
        $this->db->join('foto', 'foto.foto_id = likefoto.foto_id', 'left');
        $this->db->where('foto.user_id', $this->session->userdata('user_id'));
        $this->db->where('foto.foto_id', $id_foto);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function countLike($id_foto)
    {
        $this->db->select('foto.foto_id, foto.judul_foto, foto.deskripsi_foto, foto.tanggal_unggah, foto.lokasi_file, foto.album_id, foto.user_id, likefoto.like_id, likefoto.foto_id, likefoto.user_id, likefoto.tanggal_like');
        $this->db->from('likefoto');
        $this->db->join('foto', 'foto.foto_id = likefoto.foto_id', 'left');
        $this->db->where('foto.foto_id', $id_foto);
        return $this->db->count_all_results();
    }
}

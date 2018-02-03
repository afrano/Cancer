<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        cek_login();
        cek_hakakses(array(1, 2, 3));
    }

    public function index() {
        $data['data_pasien'] = $this->user_model->get_allPasien();
        $data['isi'] = 'pasien/v_pasien';
        $data['title'] = 'Data User';
        $this->load->view('dashboard/dashboard', $data);
    }

    public function addPasien() {
        $data['provinsi'] = $this->user_model->get_all_provinsi();
        $data['isi'] = 'pasien/addPasien';
        $data['title'] = 'Data User';
        $this->load->view('dashboard/dashboard', $data);
    }

    function tambah_pasien() {
        $Create_Date = Date("Y-m-d H:i:s", time() + 60 * 360);
        $this->form_validation->set_rules('NIK', 'NIK', 'required');
        $this->form_validation->set_rules('MRN', 'MRN', 'required');
        $this->form_validation->set_rules('First_Name', 'First_Name', 'required');
        $this->form_validation->set_rules('Middle_Name', 'Middle_Name', 'required');
        $this->form_validation->set_rules('Family_Name', 'Family_Name', 'required');
        $this->form_validation->set_rules('Place_Of_Birth', 'Place_Of_Birth', 'required');
        $this->form_validation->set_rules('Date_Of_Birth', 'Date_Of_Birth', 'required');
        $this->form_validation->set_rules('Alamat_Tetap', 'Alamat_Tetap', 'required');
        $this->form_validation->set_rules('ID_Provinsi', 'ID_Provinsi', 'required');
        $this->form_validation->set_rules('id_kabupaten', 'id_kabupaten', 'required');
        $this->form_validation->set_rules('id_kecamatan', 'id_kecamatan', 'required');
        $this->form_validation->set_rules('kode_pos', 'kode_pos', 'required');
        $this->form_validation->set_rules('Alamat_Sementara', 'Alamat_Sementara', 'required');
        $this->form_validation->set_rules('id_provinsi_1', 'id_provinsi_1', 'required');
        $this->form_validation->set_rules('id_kabupaten_1', 'id_kabupaten_1', 'required');
        $this->form_validation->set_rules('id_kecamatan_1', 'id_kecamatan_1', 'required');
        $this->form_validation->set_rules('kode_pos1', 'kode_pos1', 'required');
        $this->form_validation->set_rules('ID_Sex', 'ID_Sex', 'required');
        $this->form_validation->set_rules('ID_Race', 'ID_Race', 'required');
        $this->form_validation->set_rules('ID_Religion', 'ID_Religion', 'required');
        $this->form_validation->set_rules('id_status_hubungan', 'id_status_hubungan', 'required');
        $this->form_validation->set_rules('ID_Occupation', 'ID_Occupation', 'required');
        $this->form_validation->set_rules('No_Telpon', 'No_Telpon', 'required');


        $NIK = $_POST['NIK'];
        $kode_rumahsakit = $_POST['Kode_RumahSakit'];
        $tgl_periksa = $_POST['Tgl_Periksa'];
        $nama_RumahSakit = $_POST['nama_RumahSakit'];
        $unit_ID = $_POST['unit_ID'];
        $unit = $_POST['unit'];
        $No_PALAB = $_POST['No_PALAB'];

        $jumlahSource = count($kode_rumahsakit);

        $ID_Distant_Metastases = $_POST['ID_Distant_Metastases'];
        $jumlah_ID_Distant_Metastases = count($ID_Distant_Metastases);

        $ID_Treatment = $_POST['ID_Treatment'];
        $jumlah_dipilih = count($ID_Treatment);

        $datapasien = array(
            'NIK' => $_POST['NIK'],
            'MRN' => $_POST['MRN'],
            'First_Name' => $_POST['First_Name'],
            'Middle_Name' => $_POST['Middle_Name'],
            'Family_Name' => $_POST['Family_Name'],
            'Place_Of_Birth' => $_POST['Place_Of_Birth'],
            'Date_Of_Birth' => $_POST['Date_Of_Birth'],
            'Alamat_Tetap' => $_POST['Alamat_Tetap'],
            'ID_Provinsi' => $_POST['ID_Provinsi'],
            'id_kabupaten' => $_POST['id_kabupaten'],
            'id_kecamatan' => $_POST['id_kecamatan'],
            'kode_pos' => $_POST['kode_pos'],
            'Alamat_Sementara' => $_POST['Alamat_Sementara'],
            'id_provinsi_1' => $_POST['id_provinsi_1'],
            'id_kabupaten_1' => $_POST['id_kabupaten_1'],
            'id_kecamatan_1' => $_POST['id_kecamatan_1'],
            'kode_pos1' => $_POST['kode_pos1'],
            'ID_Sex' => $_POST['ID_Sex'],
            'ID_Race' => $_POST['ID_Race'],
            'ID_Religion' => $_POST['ID_Religion'],
            'id_status_hubungan' => $_POST['id_status_hubungan'],
            'ID_Occupation' => $_POST['ID_Occupation'],
            'No_Telpon' => $_POST['No_Telpon'],
            'Create_Date' => $Create_Date,
        );
        $Cek = 0;
        $Cek = $this->user_model->Cekdata('data_pasien', 'NIK', $NIK)->result_array();
        $datatumor = array(
            'NIK' => $NIK,
            'ID_Topography' => $_POST['ID_Topography'],
            'ID_Morphology' => $_POST['ID_Morphology'],
            'ID_Diagnosis' => $_POST['Diagnosis'],
            'ID_Disease' => $_POST['Disease'],
            'Diagnosis_Klinis' => $_POST['Diagnosis_Klinis'],
            'Diagnosis_Date' => $_POST['Diagnosis_Date'],
            'ID_Behaviour' => $_POST['Behaviour'],
            'No_Of_Metastases' => $_POST['No_Of_Metastases'],
            'ID_Grade' => $_POST['Grade'],
            'ID_Stage' => $_POST['Stage'],
            'ID_Laterality' => $_POST['Laterality'],
            'ID_Immunohistokimia' => $_POST['ID_Immunohistokimia'],
            'Date_IHC' => $_POST['Date_IHC'],
            'ID_Hybridization' => $_POST['ID_Hybridization'],
            'Date' => $_POST['Date'],
            'ID_Biopsy' => $_POST['Biopsy'],
            'ID_Sublocation' => $_POST['Sublocation'],
            'Kesimpulan' => $_POST['kesimpulan'],
            'Create_Date' => $Create_Date,
        );


        $Admission_Date = $_POST['Admission_Date'];
        $Date_Last_Contact = $_POST['Date_Last_Contact'];
        $id_status = $_POST['status'];
        $Registrar = $_POST['Registrar'];
        $Date_Of_Abstract = $_POST['Date_Of_Abstract'];
        $Verifeir = $_POST['Verifeir'];
        $Date_Of_Verification = $_POST['Date_Of_Verification'];

        for ($sp = 0; $sp < $jumlahSource; $sp++) {
            $this->db->query("INSERT INTO sources_follow_up values('','$NIK','$tgl_periksa[$sp]','$kode_rumahsakit[$sp]','$nama_RumahSakit[$sp]',"
                    . "'$unit_ID[$sp]','$unit[$sp]','$No_PALAB[$sp]','$Admission_Date','$Date_Last_Contact','$id_status','$Registrar','$Date_Of_Abstract','$Verifeir','$Date_Of_Verification','$Create_Date','')");
        }

        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            $this->db->query("INSERT INTO treatment_pasien values('','$ID_Treatment[$x]','$NIK','$Create_Date','')");
        }

        for ($x1 = 0; $x1 < $jumlah_ID_Distant_Metastases; $x1++) {
            $this->db->query("INSERT INTO distant_metastases_pasien values('','$ID_Distant_Metastases[$x1]','$NIK','$Create_Date','')");
        }

        if ($Cek == NULL) {
            $this->user_model->tambahData('data_pasien', $datapasien);
            $this->user_model->tambahData('data_tumor_pasien', $datatumor);
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Data Berhasil Disimpan</strong></div>");
            redirect(base_url() . 'Pasien');
        } else {
            $this->user_model->tambahData('data_tumor_pasien', $datatumor);
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Maaf Data Sudah Ada</strong></div>");
            redirect('Pasien');
        }
        redirect(base_url() . 'Pasien');
    }

    function DetailPasien($NIK = null) {
        cek_hakakses(array(1));
        if ($data_user = $this->user_model->get_DetilPasien($NIK)) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('hak_akses', 'hak_akses', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
//            if ($this->form_validation->run()) {
//                $data_simpan = array(
//                    'username' => $_POST['username'],
//                    'nama' => $_POST['nama'],
//                    'hak_akses' => $_POST['hak_akses'],
//                    'status' => $_POST['status'],
//                );
//
//                if ($this->user_model->ubah($NIK, $data_simpan)) {
//                    $this->session->set_flashdata('pesan_sukses', 'Data Berhasil DIsimpan');
//                    redirect('pasien/v_pasien');
//                } else {
//                    $this->session->set_flashdata('pesan_error', 'Data Gagal Disimpan');
//                    redirect('pasien/v_pasien');
//                }
//            } else {
            $data['row'] = $data_user->row();
            $data['isi'] = 'pasien/detailPasien';
            $data['title'] = 'Data User';
            $this->load->view('dashboard/dashboard', $data);
            //       }
        }
//        else {
//            echo 'Data tidak Ditemukan';
//        }
    }

//    function detailPasien($NIK = null) {
//        cek_hakakses(array(1));
//        if ($data_user = $this->user_model->get_DetilPasien($NIK)) {
//            $this->form_validation->set_rules('username', 'Username', 'required');
////   $this->form_validation->set_rules('password', 'password', 'required');
//            $this->form_validation->set_rules('nama', 'nama', 'required');
//            $this->form_validation->set_rules('hak_akses', 'hak_akses', 'required');
//            $this->form_validation->set_rules('status', 'status', 'required');
//            if ($this->form_validation->run()) {
//                $data_simpan = array(
//                    'username' => $_POST['username'],
////         'password' => md5($_POST['password']),
//                    'nama' => $_POST['nama'],
//                    'hak_akses' => $_POST['hak_akses'],
//                    'status' => $_POST['status'],
//                );
//
//                if ($this->user_model->ubah($NIK, $data_simpan)) {
//                    $this->session->set_flashdata('pesan_sukses', 'Data Berhasil DIsimpan');
//                    redirect(base_url() . 'pasien/v_pasien');
//                } else {
//                    $this->session->set_flashdata('pesan_error', 'Data Gagal Disimpan');
//                    redirect(base_url() . 'pasien/v_pasien');
//                }
//            } else {
//                $data['row'] = $data_user->row();
//                $data['isi'] = 'pasien/detailPasien';
//                $data['title'] = 'Data User';
//                $this->load->view('dashboard/dashboard', $data);
//            }
//        } else {
//            echo 'Data tidak Ditemukan';
//        }
//    }
//    public function DataTumorPasien() {
//        $NIK = 1;
//        $Create_Date = Date("Y-m-d H:i:s", time() + 60 * 360);
//        $ID_Distant_Metastases = 1;
//        foreach ($_POST['ID_Treatment[]'] as $selected) {
//            $datatumor = array(
//                'NIK' => $NIK,
//                'ID_Topography' => $_POST['ID_Topography'],
//                'ID_Morphology' => $_POST['ID_Morphology'],
//                'ID_Diagnosis' => $_POST['ID_Diagnosis'],
//                'ID_Disease' => $_POST['ID_Disease'],
//                'ID_Treatment' => $selected,
//                'Diagnosis_Klinis' => $_POST['Diagnosis_Klinis'],
//                'Diagnosis_Date' => $_POST['Diagnosis_Date'],
//                'ID_Behaviour' => $_POST['ID_Behaviour'],
//                'ID_Distant_Metastases' => $ID_Distant_Metastases,
//                'No_Of_Metastases' => $_POST['No_Of_Metastases'],
//                'ID_Grade' => $_POST['ID_Grade'],
//                'ID_Stage' => $_POST['ID_Stage'],
//                'ID_Laterality' => $_POST['ID_Laterality'],
//                'ID_Immunohistokimia' => $_POST['ID_Immunohistokimia'],
//                'Date_IHC' => $_POST['Date_IHC'],
//                'ID_Hybridization' => $_POST['ID_Hybridization'],
//                'Date' => $_POST['Date'],
//                'ID_Biopsy' => $_POST['ID_Biopsy'],
//                'ID_Sublocation' => $_POST['ID_Sublocation'],
//                'Create_Date' => $Create_Date,
//            );
//        }
//
//        $this->User_model->tambahData('data_tumor_pasien', $datatumor);
//        $this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Data Berhasil Disimpan</strong></div>");
//        header('location:' . base_url() . 'Pasien');
////        } else {
////            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Maaf Data Sudah Ada</strong></div>");
////            header('location:' . base_url() . 'Tumor/Topography');
////        }
//    }

    function ubah($id_user = null) {
        cek_hakakses(array(1));
        if ($data_user = $this->user_model->get_byid($id_user)) {
            $this->form_validation->set_rules('username', 'Username', 'required');
//   $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('hak_akses', 'hak_akses', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            if ($this->form_validation->run()) {
                $data_simpan = array(
                    'username' => $_POST['username'],
//         'password' => md5($_POST['password']),
                    'nama' => $_POST['nama'],
                    'hak_akses' => $_POST['hak_akses'],
                    'status' => $_POST['status'],
                );

                if ($this->user_model->ubah($id_user, $data_simpan)) {
                    $this->session->set_flashdata('pesan_sukses', 'Data Berhasil DIsimpan');
                    redirect(base_url() . 'pasien/v_pasien');
                } else {
                    $this->session->set_flashdata('pesan_error', 'Data Gagal Disimpan');
                    redirect(base_url() . 'pasien/v_pasien');
                }
            } else {
                $data['row'] = $data_user->row();
                $data['isi'] = 'pasien/v_pasien';
                $data['title'] = 'Data User';
                $this->load->view('dashboard/dashboard', $data);
            }
        } else {
            echo 'Data tidak Ditemukan';
        }
    }

    function aktif($id) {
        cek_hakakses(array(1));
        if (isset($id)) { //memastikan ID user exist
            if ($data_user = $this->user_model->get_byid($id)) { //cek databse id_user ada
                $row = $data_user->row();
                if ($row->status == 0) {
//sesuaikan nama tabelnya dan primary key nya
                    $this->db->update('tb_user', array('status' => 1), array('id_user' => $id));
                    redirect(base_url() . 'user');
                } else {
//sesuaikan nama tabelnya dan primary key nya
                    $this->db->update('tb_user', array('status' => 0), array('id_user' => $id));
                    redirect(base_url() . 'user');
                }
            } else {
                echo 'Data Tidak Ditemukan';
            }
        } else {
            echo 'error disallowed uri';
        }
    }

    function hapus($kode = null) {
        $table = 'data_pasien';
        $where = 'NIK';
        $method = 'Pasien';
        if ($this->user_model->getdata_bykode($table, $where, $kode)) {
            if ($this->user_model->Hapusdata($table, array($where => $kode))) {
                $this->session->set_flashdata('pesan_sukses', 'Data berhasil Di Hapus');
                redirect($method);
            } else {
                $this->session->set_flashdata('pesan_error', 'Data Gagal Di Hapus');
                redirect($method);
            }
        } else {
            echo "Data Tidak Ditemukan";
        }
    }

    //--------------------------------------- autocom

    public function topography() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database
        $data = $this->db->from('topography')->like('Topography', $keyword)->get();

        // format keluaran di dalam array
        foreach ($data->result() as $row) {

            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->Topography,
                'ID_Topography' => $row->ID_Topography
            );
        }

        echo json_encode($arr);
    }

    public function Morphology() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database
        $data = $this->db->from('morphology')->like('Morphology', $keyword)->get();

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->Morphology,
                'ID_Morphology' => $row->ID_Morphology
            );
        }
        echo json_encode($arr);
    }

    public function add_ajax_kab($id_prov) {
        $query = $this->db->get_where('wilayah_kabupaten', array('provinsi_id' => $id_prov));
        $data = "<option value=''>- Select Kabupaten -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

    public function add_ajax_kec($id_kab) {
        $query = $this->db->get_where('wilayah_kecamatan', array('kabupaten_id' => $id_kab));
        $data = "<option value=''> - Select Kecamatan - </option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

    public function add_ajax_des($id_kec) {
        $query = $this->db->get_where('wilayah_desa', array('kecamatan_id' => $id_kec));
        $data = "<option value=''> - Kode Pos - </option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

}

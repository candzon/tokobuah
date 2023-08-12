<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model"); //load model product_model
        $this->load->library('form_validation'); //load form_validation
    }

    public function index()
    {
        $data["products"] = $this->product_model->getAll(); //ambil data dari model

        $this->load->view("admin/product/list", $data); // tampilkan view list.php
    }

    public function add()
    {
        $product = $this->product_model; //objek model

        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($product->rules()); // terapkan rules

        if ($validation->run()) { // melakukan validasi
            $product->save(); // simpan data ke database
            $this->session->set_flashdata('success', 'Berhasil disimpan'); // tampilkan pesan berhasil
        } else {
            $this->session->set_flashdata('error', 'Gagal disimpan'); // tampilkan pesan gagal
        }

        $this->load->view("admin/product/new_form"); // tampilkan form add
    }

    public function edit($id = null)
    {

        if (!isset($id)) redirect(base_url('admin/products/')); // redirect jika tidak ada $id

        $product = $this->product_model; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($product->rules()); // terapkan rules

        if ($validation->run()) { // melakukan validasi
            $product->update(); // update data ke database
            $this->session->set_flashdata('success', 'Berhasil disimpan'); // tampilkan pesan berhasil
        } else {
            $this->session->set_flashdata('error', 'Gagal disimpan'); // tampilkan pesan gagal
        }

        $data["product"] = $product->getById($id); // mengambil data untuk ditampilkan pada form
        if (!$data["product"]) show_404(); // jika tidak ada, tampilkan error 404

        $this->load->view("admin/product/edit_form", $data); // tampilkan form edit


    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404(); // jika tidak ada $id, tampilkan error 404

        if ($this->product_model->delete($id)) { // hapus data dari database
            redirect(base_url('admin/products')); // redirect ke halaman list
        }
    }
}

/* End of file Controllername.php */

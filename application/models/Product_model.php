<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{


    private $_table = "products"; // nama tabel
    public $product_id; // kolom tabel
    public $name; // kolom tabel   
    public $price; // kolom tabel
    public $image; // kolom tabel
    public $description; // kolom tabel


    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ],

            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'numeric'
            ],

            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
        // ini sama dengan : 
        // SELECT * FROM products
        // method ini akan mengembalikan sebuah array
        // yang berisi objek dari row
    }


    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["product_id" => $id])->row();
        // ini sama dengan :
        // SELECT * FROM products WHERE product_id = $id
        // method ini akan mengembalikan sebuah objek
        // yang berisi sebuah data dari row
    }

    public function save()
    {
        $post = $this->input->post(); //ambil data dari form
        $this->product_id = uniqid("img"); // membuat id unik
        $this->name = $post["name"]; // isi field name
        $this->price = $post["price"]; // isi field price
        $this->description = $post["description"]; // isi field description
        $this->image = $this->_uploadImage();
        return $this->db->insert($this->_table, $this); // simpan ke database   
        // ini sama dengan :
        // INSERT INTO products (product_id, name, price, description, image) VALUES (uniqid(), $name, $price, $description, $image)
        // method ini akan mengembalikan sebuah objek
        // yang berisi sebuah data dari row
    }

    public function update()
    {
        $post = $this->input->post(); //ambil data dari form
        $this->product_id = uniqid("img"); // isi field id
        $this->name = $post["name"]; // isi field name
        $this->price = $post["price"]; // isi field price
        $this->description = $post["description"]; // isi field description
        $this->image = $this->_uploadImage();
        $this->db->update($this->_table, $this, array('product_id' => $post['id'])); // update ke database
        // ini sama dengan :
        // UPDATE products SET name = $name, price = $price, description = $description, WHERE product_id = $id
        // method ini akan mengembalikan sebuah objek
        // yang berisi sebuah data dari row
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("product_id" => $id)); // hapus data dari database
        // ini sama dengan :
        // DELETE FROM products WHERE product_id = $id/
        // method ini akan mengembalikan sebuah objek
        // yang berisi sebuah data dari row
    }

    public function _uploadImage()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $this->product_id;
        $config['overwrite']            = true;


        $this->load->library('upload', $config); // load library upload
        if ($this->upload->do_upload('image')) { // upload file
            return $this->upload->data("file_name"); // jika berhasil, kembalikan nama file nya
        }else {
            return "default.png"; // jika gagal, kembalikan nama file default nya
        }

         
    }
}
    
    /* End of file ModelName.php */

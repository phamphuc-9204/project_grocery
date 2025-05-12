<?php

require_once 'app/models/ProductModel.php';

class ProductController
{
    private $products = [];    public function __construct()
    {
        //Gỉa sử chúng ta lưu trữ sản phẩm trong session để giữ lại khi làm mới trang 
        session_start();
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];
        }
        $this->products = $_SESSION['products'];
    }

    public function index()
    {
        $this->list();
    }
    public function list()
    {
        //Lấy danh sách sản phẩm từ session
        $products = $this->products;
        include 'app/views/product/list.php';
    }

    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Name = $_POST['Name'];
            $Description = $_POST['Description'];
            $Price = $_POST['Price'];

            //Kiểm tra dữ liệu đầu vào
            if (empty($Name)) {
                $errors[] = 'Tên sản phẩm là bắt buộc';
            } elseif (strlen($Name) <10 || strlen($Name) > 100) {
                $errors[] = 'Tên sản phẩm phải từ 10 đến 100 ký tự';
            }

            if (!is_numeric($Price) || $Price <= 0) {
                $errors[] = 'Giá sản phẩm phải là một số dương';
            }            //Nếu không có lỗi, thêm sản phẩm vào danh sách
            if (empty($errors)) {
                $ID = count($this->products) + 1; // Tạo ID tự động
                $product = new ProductModel($ID, $Name, $Description, $Price);
                $this->products[] = $product;
                $_SESSION['products'] = $this->products;
                header('Location: /project_grocery/Product/list');
                exit();
            }
        }
        include 'app/views/product/add.php';
    }

    public function edit ($ID)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($this->products as $key => $product) {
                if ($product->getID() == $ID) {
                    $this->products[$key]->setName($_POST['Name']);
                    $this->products[$key]->setDescription($_POST['Description']);
                    $this->products[$key]->setPrice($_POST['Price']);
                    break;
                }
            }
            $_SESSION['products'] = $this->products;

            header('Location: /project_grocery/Product/list');
            exit();
        }
        foreach ($this->products as $product) {
            if ($product->getID() == $ID) {
                include 'app/views/product/edit.php';
                return;
            }
        }
        die('Sản phẩm không tồn tại');
    }

    public function delete($ID)
    {
        foreach ($this->products as $key => $product) {
            if ($product->getID() == $ID) {
                unset($this->products[$key]);
                break;
            }
        }
        $this->products = array_values($this->products); // Để lại các chỉ số liên tiếp
        // Cập nhật lại session
        $_SESSION['products'] = $this->products;

        header('Location: /project_grocery/Product/list');
        exit();
    }
}

?>
<?php
ob_start();
$title = 'Sửa sản phẩm';
?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-edit"></i> Sửa sản phẩm
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="/project_grocery/product/edit/<?php echo $product->getID(); ?>" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="Name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="Name" name="Name" 
                       value="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>" 
                       required minlength="10" maxlength="100">
                <div class="invalid-feedback">
                    Tên sản phẩm phải từ 10 đến 100 ký tự
                </div>
            </div>

            <div class="mb-3">
                <label for="Description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="Description" name="Description" rows="3" required><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></textarea>
                <div class="invalid-feedback">
                    Vui lòng nhập mô tả sản phẩm
                </div>
            </div>

            <div class="mb-3">
                <label for="Price" class="form-label">Giá (VNĐ)</label>
                <input type="number" class="form-control" id="Price" name="Price" 
                       value="<?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>" 
                       required min="0">
                <div class="invalid-feedback">
                    Giá phải là số dương
                </div>
            </div>

            <div class="text-end">
                <a href="/project_grocery/product/list" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Hủy
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'app/views/layout.php';
?>
        </form>
        <a href="/project_grocery/Product/list">Quay lại danh sách sản phẩm</a>
    </body>
</html>
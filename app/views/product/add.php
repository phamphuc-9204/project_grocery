<?php
ob_start();
$title = 'Thêm sản phẩm mới';
?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-plus"></i> Thêm sản phẩm mới
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="/project_grocery/product/add" class="needs-validation" novalidate onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="Name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="Name" name="Name" required minlength="10" maxlength="100">
                <div class="invalid-feedback">
                    Tên sản phẩm phải từ 10 đến 100 ký tự
                </div>
            </div>

            <div class="mb-3">
                <label for="Description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Vui lòng nhập mô tả sản phẩm
                </div>
            </div>

            <div class="mb-3">
                <label for="Price" class="form-label">Giá (VNĐ)</label>
                <input type="number" class="form-control" id="Price" name="Price" required min="0">
                <div class="invalid-feedback">
                    Giá phải là số dương
                </div>
            </div>

            <div class="text-end">
                <a href="/project_grocery/product/list" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Hủy
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu sản phẩm
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?php
$content = ob_get_clean();
require_once 'app/views/layout.php';
?>
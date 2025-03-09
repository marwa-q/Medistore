<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 600;
        }

        .readonly-text {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Edit Product</h2>
            <form action="/public/products/update/<?= $product['id'] ?>" method="POST" id="editProductForm">
                <!-- Non-editable fields (display as text) -->
                <div class="form-group">
                    <label>Product ID</label>
                    <div class="readonly-text"><?= htmlspecialchars($product['id']) ?></div>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                </div>
                <div class="form-group">
                    <label>Created At</label>
                    <div class="readonly-text"><?= htmlspecialchars($product['created_at']) ?></div>
                    <input type="hidden" name="created_at" value="<?= htmlspecialchars($product['created_at']) ?>">
                </div>

                <!-- Editable fields -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="<?= htmlspecialchars($product['stock']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category Name</label>
                    <div class="readonly-text"><?= htmlspecialchars($product['category_name']) ?></div>
                    <input type="hidden" name="category_name" id="category_name" class="form-control" value="<?= htmlspecialchars($product['category_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL (Placeholder)</label>
                    <input type="text" name="image_url" id="image_url" class="form-control" placeholder="<?= htmlspecialchars($product['image_url']) ?>" required>
                    <small class="text-muted">Image upload functionality will be added later.</small>
                </div>

                <!-- Buttons -->
                <div class="form-group text-end">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='/public/products'">Cancel</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Changes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to save these changes?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSave">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle the confirmation save button
        document.getElementById('confirmSave').addEventListener('click', function() {
            document.getElementById('editProductForm').submit();
        });
    </script>
</body>

</html>
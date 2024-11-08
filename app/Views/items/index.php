<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .modal-content {
            border: 2px solid #774601;
        }
        .modal-header {
            background-color: #774601;
            color: white;
        }
        .button.is-primary {
            background-color: #774601;
            border-color: #774601;
        }
        .button.is-primary:hover {
            background-color: #5c3f01;
            border-color: #5c3f01;
        }
        .table th {
            background-color: #774601;
            color: white !important;
        }
        .input {
            border: 2px solid #774601;
        }
        .input:focus {
            border-color: #5c3f01;
            box-shadow: 0 0 5px rgba(119, 70, 1, 0.5);
        }
        .close-button {
            background: none;
            border: none;
            color: black; 
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            right: 1rem;
            top: 1rem;
            z-index: 10;
            line-height: 1;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="btn-container">
                <button class="button is-primary" id="add-item-button">
                    Add Item
                </button>
            </div>

            <div class="modal" id="itemModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Add Item</p>
                        <button class="close-button" aria-label="close" id="close-modal">X</button>
                    </header>
                    
                    <section class="modal-card-body">
                        <form id="dataForm" method="POST" action="<?= base_url('items/store') ?>">
                            <input type="hidden" id="id" name="id">
                            <div class="field">
                                <label class="label" for="items_name">Item Name</label>
                                <div class="control">
                                    <input type="text" class="input" id="items_name" name="items_name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="description">Description</label>
                                <div class="control">
                                    <input type="text" class="input" id="description" name="description" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="category">Category</label>
                                <div class="control">
                                    <input type="text" class="input" id="category" name="category" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="size">Size</label>
                                <div class="control">
                                    <input type="text" class="input" id="size" name="size" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="color">Color</label>
                                <div class="control">
                                    <input type="text" class="input" id="color" name="color" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="price">Price</label>
                                <div class="control">
                                    <input type="number" class="input" id="price" name="price" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="stock">Stock</label>
                                <div class="control">
                                    <input type="number" class="input" id="stock" name="stock" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="image_url">Image URL</label>
                                <div class="control">
                                    <input type="text" class="input" id="image_url" name="image_url" required>
                                </div>
                            </div>
                            <footer class="modal-card-foot">
                                <button type="submit" class="button is-primary">Submit</button>
                            </footer>
                        </form>
                    </section>
                </div>
            </div>

            <table class="table is-striped is-fullwidth mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image URL</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php foreach ($items as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= esc($row['id']); ?></td>
                                <td><?= esc($row['items_name']); ?></td>
                                <td><?= esc($row['description']); ?></td>
                                <td><?= esc($row['category']); ?></td>
                                <td><?= esc($row['size']); ?></td>
                                <td><?= esc($row['color']); ?></td>
                                <td><?= esc($row['price']); ?></td>
                                <td><?= esc($row['stock']); ?></td>
                                <td><?= esc($row['image_url']); ?></td>
                                <td><?= esc($row['created_at']); ?></td>
                                <td>
                                    <button class="button is-success" 
                                            data-target="#itemModal"
                                            onclick="populateModal(this)"
                                            data-id="<?= esc($row['id']); ?>"
                                            data-items-name="<?= esc($row['items_name']); ?>"
                                            data-description="<?= esc($row['description']); ?>"
                                            data-category="<?= esc($row['category']); ?>"
                                            data-size="<?= esc($row['size']); ?>"
                                            data-color="<?= esc($row['color']); ?>"
                                            data-price="<?= esc($row['price']); ?>"
                                            data-stock="<?= esc($row['stock']); ?>"
                                            data-image-url="<?= esc($row['image_url']); ?>">
                                        Update
                                    </button>
                                    <a href="<?= base_url('items/delete/' . $row['id']) ?>" onclick="return confirm('Are you sure you want to delete this item?')">
                                        <button class="button is-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="has-text-centered">No items found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        document.getElementById('add-item-button').onclick = function () {
            document.getElementById('dataForm').reset();
            document.getElementById('id').value = '';  // Clear the hidden ID field for a new item
            document.querySelector('.modal-card-title').textContent = 'Add Item';
            document.getElementById('dataForm').setAttribute('action', '<?= base_url("items/store") ?>');  // Set form action to store
            document.getElementById('itemModal').classList.add('is-active');
        };

        function populateModal(button) {
            const modal = document.getElementById('itemModal');
            
            // Populate fields with item data
            document.getElementById('id').value = button.getAttribute('data-id');
            document.getElementById('items_name').value = button.getAttribute('data-items-name');
            document.getElementById('description').value = button.getAttribute('data-description');
            document.getElementById('category').value = button.getAttribute('data-category');
            document.getElementById('size').value = button.getAttribute('data-size');
            document.getElementById('color').value = button.getAttribute('data-color');
            document.getElementById('price').value = button.getAttribute('data-price');
            document.getElementById('stock').value = button.getAttribute('data-stock');
            document.getElementById('image_url').value = button.getAttribute('data-image-url');

            // Set the form action to the update URL for the specific item
            const id = button.getAttribute('data-id');
            document.getElementById('dataForm').setAttribute('action', '<?= base_url("items/update") ?>/' + id);
            
            document.querySelector('.modal-card-title').textContent = 'Update Item';
            modal.classList.add('is-active');
        }
    </script>
</body>
</html>

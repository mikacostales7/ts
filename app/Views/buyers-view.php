<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New User</h2>
        <form method="POST" action="<?= base_url('/buyers') ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2>Buyers List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Postal Code</th>
                    <th>Country</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($buyers)): ?>
                    <?php foreach ($buyers as $buyer): ?>
                        <tr>
                            <td><?= esc($buyer['id']) ?></td>
                            <td><?= esc($buyer['first_name']) ?></td>
                            <td><?= esc($buyer['last_name']) ?></td>
                            <td><?= esc($buyer['email']) ?></td>
                            <td><?= esc($buyer['phone_number']) ?></td>
                            <td><?= esc($buyer['address']) ?></td>
                            <td><?= esc($buyer['city']) ?></td>
                            <td><?= esc($buyer['state']) ?></td>
                            <td><?= esc($buyer['postal_code']) ?></td>
                            <td><?= esc($buyer['country']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No buyers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-between">
            <div>
                Showing <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?> pages
            </div>
            <?= $pager->links() ?>
        </div>
    </div>
    
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>

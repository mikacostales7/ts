<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-image: url('/assets/bg.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
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
                <button class="button is-primary" data-target="#employeeModal" aria-haspopup="true" aria-controls="employeeModal" id="add-employee-button">
                    Sign Up Here
                </button>
                <a href="<?= base_url('/logout') ?>">
                    <button class="button is-danger" data-target="#employeeModal" aria-haspopup="true" aria-controls="employeeModal" id="add-employee-button" >
                        Logout
                    </button>
                </a>
                
                
            </div>
            <div class="modal" id="employeeModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Add Employee</p>
                        <button class="close-button" aria-label="close" id="close-modal">X</button>
                    </header>
                    
                    <section class="modal-card-body">
                        <form id="dataForm" method="POST" action="<?= base_url('/employees/create') ?>">
                            <input type="hidden" id="employee_id" name="employee_id">
                            <div class="field">
                                <label class="label" for="employee_name">Employee Name</label>
                                <div class="control">
                                    <input type="text" class="input" id="employee_name" name="employee_name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="email">Email</label>
                                <div class="control">
                                    <input type="email" class="input" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="password">Password</label>
                                <div class="control">
                                    <input type="password" class="input" id="password" name="password">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="department">Department</label>
                                <div class="control">
                                    <div class="select">
                                        <select class="input" id="department" name="department" required>
                                            <option value="" disabled selected>Select a department</option>
                                            <option value="IT">IT</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Registrar">Registrar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="age">Age</label>
                                <div class="control">
                                    <input type="number" class="input" id="age" name="age" required min="18">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="contact_number">Contact Number</label>
                                <div class="control">
                                    <input type="text" class="input" id="contact_number" name="contact_number" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="gender">Gender</label>
                                <div class="control">
                                    <div class="select">
                                        <select class="input" id="gender" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="address">Address</label>
                                <div class="control">
                                    <input type="text" class="input" id="address" name="address" required>
                                </div>
                            </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-primary">Submit</button>
                    </footer>
                        </form>
                </div>
                
                
            </div>
            
            
            <table class="table is-striped is-fullwidth mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if (!empty($employees)): ?>
                        <?php foreach ($employees as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= esc($row['employee_id']); ?></td>
                                <td><?= esc($row['employee_name']); ?></td>
                                <td><?= esc($row['department']); ?></td>
                                <td><?= esc($row['age']); ?></td>
                                <td><?= esc($row['gender']); ?></td>
                                <td><?= esc($row['email']); ?></td>
                                <td><?= esc($row['address']); ?></td>
                                <td><?= esc($row['contact_number']); ?></td>
                                <td><?= esc($row['created_at']); ?></td>
                                <td>
                                    <button class="button is-success" 
                                            data-target="#employeeModal" 
                                            onclick="populateModal(this)"
                                            data-id="<?= esc($row['id']); ?>"
                                            data-employee-id="<?= esc($row['employee_id']); ?>"
                                            data-employee-name="<?= esc($row['employee_name']); ?>"
                                            data-department="<?= esc($row['department']); ?>"
                                            data-age="<?= esc($row['age']); ?>"
                                            data-gender="<?= esc($row['gender']); ?>"
                                            data-email="<?= esc($row['email']); ?>"
                                            data-address="<?= esc($row['address']); ?>"
                                            data-contact-number="<?= esc($row['contact_number']); ?>">
                                        Update
                                    </button>
                                    <a href="<?= base_url('employees/delete/' . $row['id']) ?>" onclick="return confirm('Are you sure you want to delete this employee?')">
                                        <button class="button is-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                            
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="has-text-centered">No employees found</td>
                        </tr>
                    <?php endif; ?>
                   
                </tbody>
            </table>
        </div>
    </section>

    <script>
        document.getElementById('add-employee-button').onclick = function () {
            document.getElementById('employeeModal').classList.add('is-active');
        };

        document.getElementById('close-modal').onclick = function () {
            document.getElementById('employeeModal').classList.remove('is-active');
            document.getElementById('dataForm').reset();
        };

        function populateModal(button) {
            const id = button.getAttribute('data-id');
            const employeeId = button.getAttribute('data-employee-id');
            const employeeName = button.getAttribute('data-employee-name');
            const department = button.getAttribute('data-department');
            const age = button.getAttribute('data-age');
            const gender = button.getAttribute('data-gender');
            const email = button.getAttribute('data-email');
            const address = button.getAttribute('data-address');
            const contactNumber = button.getAttribute('data-contact-number');

            document.getElementById('employee_id').value = employeeId;
            document.getElementById('employee_name').value = employeeName;
            document.getElementById('department').value = department;
            document.getElementById('age').value = age;
            document.getElementById('gender').value = gender;
            document.getElementById('email').value = email;
            document.getElementById('address').value = address;
            document.getElementById('contact_number').value = contactNumber;

            document.getElementById('dataForm').action = `<?= base_url('/employees/update/'); ?>${id}`;
            document.getElementById('employeeModal').classList.add('is-active');
        }

        document.getElementById('add-employee-button').onclick = function () {
            document.getElementById('dataForm').reset();
            document.getElementById('dataForm').action = '<?= base_url('/employees/create') ?>';
            document.getElementById('employeeModal').classList.add('is-active');
        };
        

    </script>
</body>
</html>

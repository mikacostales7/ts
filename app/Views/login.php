<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-card {
            width: 400px;
            border: 2px solid #774601;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .login-card-header {
            background-color: #774601;
            color: white;
            text-align: center;
            padding: 5px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .input {
            width: 90%;
            padding: 10px;
            border: 2px solid #774601;
            border-radius: 4px;
            margin: 10px auto;
            display: block;
        }
        .input:focus {
            border-color: #5c3f01;
            box-shadow: 0 0 5px rgba(119, 70, 1, 0.5);
            outline: none;
        }
        .button {
            background-color: #774601;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 90%;
            margin: 10px auto;
            display: block;
            font-size: 16px;
        }
        .button:hover {
            background-color: #5c3f01;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-card-header">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div style="color: red; text-align: center;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div style="color: green; text-align: center;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?= base_url('/login') ?>">
                <?= csrf_field() ?>
                <input type="email" class="input" id="email" name="email" placeholder="Email" required>
                <input type="password" class="input" id="password" name="password" placeholder="Password" required>
                <button type="submit" class="button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

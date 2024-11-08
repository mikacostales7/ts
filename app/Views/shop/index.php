<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift Store</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            padding: 0;
        }

        body, html {
            height: 100%;
        }

        .container {
            display: flex;
            height: 100vh;
            gap: 25%;
        }

        .drawer {
            width: 300px;
            border: 2px solid black;
            background-color: #774601;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            gap: 2%
        }

        .drawer a, .drawer button {
            margin: 10px 0;
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-family: sans-serif;
            font-size: 1.5rem;
        }

        .drawer button {
            background-color: #774601;
            padding: 5px 20px;
            cursor: pointer;
        }

        .introduction {
            flex: 1;
            position: relative;
            background-color: #774601;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1;
        }

        .intro-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="drawer">
            <a href="<?= site_url('/') ?>">Home</a>
            <a href="<?= site_url('/grantAccess') ?>">Grant Access</a>
            <a href="">Appointment</a>
            <a href="">About Us</a>
            <button>Shop > </button>
        </div>
        <div class="introduction">
            <div class="overlay"></div>
            <div class="intro-content">
                <h1>Welcome to AJM Thrift Store!</h1>
                <p>Your go-to place for unique finds and great deals! Our mission is to provide high-quality thrifted items at affordable prices.</p>
            </div>
        </div>
    </div>
</body>
</html>

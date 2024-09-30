<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Pendaftaran</title>
    <style>
        /* Style untuk membuat halaman responsive */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Pendaftaran</h2>
        <?php
            $nameErr = $emailErr = $passwordErr = "";
            $name = $email = $password = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Nama lengkap wajib diisi";
                } else {
                    $name = test_input($_POST["name"]);
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Email wajib diisi";
                } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Format email tidak valid";
                } else {
                    $email = test_input($_POST["email"]);
                }

                if (empty($_POST["password"])) {
                    $passwordErr = "Password wajib diisi";
                } elseif (strlen($_POST["password"]) < 8) {
                    $passwordErr = "Password harus minimal 8 karakter";
                } else {
                    $password = test_input($_POST["password"]);
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <input type="text" name="name" id="name" value="<?php echo $name; ?>">
                <span class="error"><?php echo $nameErr; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <span class="error"><?php echo $passwordErr; ?></span>
            </div>

            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>

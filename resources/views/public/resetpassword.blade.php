<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-container button {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <p style="text-align:center;">Click the button below to reset your password:</p>
    <p style="text-align:center;">Your email: {{ $email }}</p>
    <p style="text-align:center;">
        <a href="{{ $resetLink }}">
            <button
                style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-align: center; display: inline-block; font-size: 16px; margin: 10px auto; cursor: pointer;">
                Reset Password
            </button>
        </a>
    </p>

</body>

</html>

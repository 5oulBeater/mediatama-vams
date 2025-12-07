<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #fff;
            padding: 25px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            width: 100%;
            background: #333;
            padding: 10px;
            color: white;
            border: none;
            margin-top: 15px;
            cursor: pointer;
        }

        .link {
            margin-top: 15px;
            text-align: center;
        }

        a { color: #333; text-decoration: none; }
    </style>

</head>
<body>

<div class="card">
    <h2>Create Account</h2>

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="role">
            <option value="customer">Customer</option>
        </select>

        <button type="submit">Register</button>
    </form>

    <div class="link">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
</div>

</body>
</html>

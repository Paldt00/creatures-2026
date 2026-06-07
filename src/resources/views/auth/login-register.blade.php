<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #0a2540;
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #164e87;
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e1e8ed;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 11px;
            background: #00d4b2;
            border: none;
            border-radius: 20px;
            color: #0a2540;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('home') }}" class="back">← Back to Home</a>

    <h1>Login / Register</h1>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid">
        <div class="card">
            <h2>Login</h2>

            <form method="POST" action="{{ route('public.login') }}">
                @csrf

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>

        <div class="card">
            <h2>Register</h2>

            <form method="POST" action="{{ route('public.register') }}">
                @csrf

                <label>Name</label>
                <input type="text" name="name" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>

                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

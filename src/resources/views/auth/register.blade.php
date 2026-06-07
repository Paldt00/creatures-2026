<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Freshwater Creatures Wiki</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #0a2540;
        }

        .container {
            max-width: 460px;
            margin: 70px auto;
            padding: 0 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #164e87;
            text-decoration: none;
            font-weight: bold;
        }

        .card {
            background: white;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #e1e8ed;
            box-shadow: 0 4px 8px rgba(0,0,0,0.04);
        }

        h1 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 28px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-bottom: 16px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
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
            margin-bottom: 18px;
        }

        .bottom-link {
            text-align: center;
            margin-top: 18px;
        }

        .bottom-link a {
            color: #164e87;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('home') }}" class="back">← Back to Home</a>

    <div class="card">
        <h1>Register</h1>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('public.register') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Register</button>
        </form>

        <div class="bottom-link">
            Sudah punya akun?
            <a href="{{ route('public.login.form') }}">Login di sini</a>
        </div>
    </div>
</div>

</body>
</html>

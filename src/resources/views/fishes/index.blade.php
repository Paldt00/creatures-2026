<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Database</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #edf4f8;
            color: #1f2937;
        }

        .container {
            width: 1100px;
            max-width: calc(100% - 40px);
            margin: 30px auto;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        .navbar {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            background: #0a2540;
            color: white;
        }

        .navbar a {
            color: #00d4b2;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .content {
            padding: 30px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin-bottom: 8px;
            color: #0a2540;
        }

        .btn {
            display: inline-block;
            background: #00d4b2;
            color: #0a2540;
            padding: 10px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
        }

        .fish-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            border-color: #00cfc8;
        }

        .fish-image {
            height: 170px;
            width: 100%;
            object-fit: cover;
            background: #ddd;
            display: block;
        }

        .no-image {
            height: 170px;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }

        .card-body {
            padding: 18px;
        }

        .card-body h2 {
            margin: 0 0 10px;
            color: #0a2540;
        }

        .badge {
            display: inline-block;
            background: #0a2540;
            color: #00d4b2;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        .desc {
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }

        .empty {
            border: 1px dashed #aaa;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            background: #f8fafc;
        }

        @media (max-width: 900px) {
            .fish-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .fish-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="navbar">
        <strong>
            <a href="{{ route('home') }}">🐟 Freshwater Creatures</a>
        </strong>

        <div class="nav-right">
            @auth
                <a href="{{ url('/admin') }}">Admin Panel</a>
            @else
                <a href="{{ url('/admin/login') }}">Login</a>
            @endauth
        </div>
    </div>

    <div class="content">

        <div class="header">
            <h1>Fish Database</h1>

            <p>
                Data ikan yang diinput oleh user login dan dapat dilihat oleh semua pengunjung.
            </p>

            @auth
                <a href="{{ url('/admin/fish/create') }}" class="btn">+ Add Fish</a>
            @else
                <a href="{{ url('/admin/login') }}" class="btn">Login to Add Fish</a>
            @endauth
        </div>

        @if ($fishes->isEmpty())
            <div class="empty">
                <h2>Belum ada data ikan</h2>
                <p>Login terlebih dahulu untuk menambahkan data ikan.</p>
            </div>
        @else
            <div class="fish-grid">
                @foreach ($fishes as $fish)
                    <div class="card">
                        @if ($fish->image)
                            <img
                                src="{{ asset('storage/' . $fish->image) }}"
                                alt="{{ $fish->name }}"
                                class="fish-image"
                            >
                        @else
                            <div class="no-image">
                                No Image
                            </div>
                        @endif

                        <div class="card-body">
                            <h2>{{ $fish->name }}</h2>

                            @if ($fish->rarity)
                                <div class="badge">
                                    {{ ucfirst($fish->rarity) }}
                                </div>
                            @endif

                            <div class="meta">
                                <strong>Location:</strong> {{ $fish->location ?? '-' }}
                            </div>

                            <div class="meta">
                                <strong>Added by:</strong> {{ $fish->user->name ?? 'Unknown' }}
                            </div>

                            <p class="desc">
                                {{ $fish->description ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</div>

</body>
</html>

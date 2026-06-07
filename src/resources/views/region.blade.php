<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Region: {{ $region->name }} - Freshwater Wiki</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #2c3e50;
        }

        .navbar {
            background: #0a2540;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar strong a,
        .navbar a {
            color: #00d4b2;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .breadcrumbs {
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #718096;
        }

        .breadcrumbs a {
            color: #164e87;
            text-decoration: none;
            font-weight: 500;
        }

        .header-box {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e1e8ed;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }

        .region-map {
            height: 280px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            font-weight: bold;
        }

        .region-map img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .region-content {
            padding: 30px;
            border-left: 5px solid #00d4b2;
        }

        .region-content h1 {
            margin: 0 0 10px 0;
            color: #0a2540;
        }

        .add-btn {
            display: inline-block;
            background: #00d4b2;
            color: #0a2540;
            padding: 10px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
        }

        .fish-list-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .fish-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e1e8ed;
            text-decoration: none;
            color: inherit;
            overflow: hidden;
            transition: 0.3s;
        }

        .fish-card:hover {
            transform: translateY(-3px);
            border-color: #00d4b2;
        }

        .fish-thumb {
            height: 150px;
            background: #edf2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-weight: bold;
            overflow: hidden;
        }

        .fish-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fish-info {
            padding: 15px;
            background: #fafafa;
        }

        .fish-name {
            font-weight: bold;
            font-size: 1.1rem;
            color: #164e87;
            margin-bottom: 5px;
        }

        .fish-meta {
            font-size: 0.85rem;
            color: #718096;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            color: #718096;
        }

        @media (max-width: 900px) {
            .fish-list-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            .fish-list-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <strong>
        <a href="{{ route('home') }}">🐟 Freshwater Wiki</a>
    </strong>

    @auth
        <a href="{{ url('/admin') }}">Admin Panel</a>
    @endauth
</div>

<div class="container">
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">Home</a> /
        <span>Region</span> /
        <strong>{{ $region->name }}</strong>
    </div>

    <div class="header-box">
        <div class="region-map">
            @if ($region->image)
                <img src="{{ asset('storage/' . $region->image) }}" alt="{{ $region->name }}">
            @else
                MAP / REGION IMAGE
            @endif
        </div>

        <div class="region-content">
            <h1>Habitat Air Tawar: {{ $region->name }}</h1>

            <p>
                {{ $region->description ?? 'Belum ada deskripsi untuk region ini.' }}
            </p>

            @auth
                <a href="{{ url('/admin/fish/create') }}" class="add-btn">+ Add Fish Species</a>
            @endauth
        </div>
    </div>

    <h2 style="color: #0a2540; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 20px;">
        Daftar Spesies
    </h2>

    @if ($region->fishes->count() > 0)
        <div class="fish-list-grid">
            @foreach ($region->fishes as $fish)
                <a href="{{ route('fish.show', $fish->slug) }}" class="fish-card">
                    <div class="fish-thumb">
                        @if ($fish->image)
                            <img src="{{ asset('storage/' . $fish->image) }}" alt="{{ $fish->name }}">
                        @else
                            SKETSA BIOLOGIS
                        @endif
                    </div>

                    <div class="fish-info">
                        <div class="fish-name">{{ $fish->name }}</div>
                        <div class="fish-meta">
                            {{ $fish->scientific_name ?? 'Nama ilmiah belum tersedia' }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            Belum ada spesies ikan yang didaftarkan untuk wilayah ini.
        </div>
    @endif
</div>

</body>
</html>

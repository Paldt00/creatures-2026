<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshwater Creatures Wiki</title>

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

        .navbar strong a {
            color: #00d4b2;
            text-decoration: none;
            font-size: 1.4rem;
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .login-btn,
        .logout-btn {
            padding: 7px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        .login-btn {
            border: 2px solid #00d4b2;
            color: #00d4b2;
            background: transparent;
        }

        .login-btn:hover {
            background: #00d4b2;
            color: #0a2540;
        }

        .logout-btn {
            background: transparent;
            border: 2px solid #ff6b6b;
            color: #ff6b6b;
        }

        .logout-btn:hover {
            background: #ff6b6b;
            color: white;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .hero {
            background: linear-gradient(135deg, #0a2540 0%, #164e87 100%);
            border-radius: 12px;
            padding: 40px;
            display: flex;
            gap: 40px;
            align-items: center;
            color: white;
            margin-bottom: 40px;
        }

        .hero-text {
            flex: 1;
        }

        .hero-text h1 {
            margin-top: 0;
            font-size: 2.5rem;
            color: #00d4b2;
        }

        .hero-text p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .hero-actions {
            margin-top: 20px;
        }

        .primary-btn {
            display: inline-block;
            background: #00d4b2;
            color: #0a2540;
            padding: 10px 20px;
            border-radius: 24px;
            text-decoration: none;
            font-weight: bold;
        }

        .primary-btn:hover {
            background: #00b89a;
        }

        .hero-image {
            width: 300px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border: 2px dashed rgba(255,255,255,0.3);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00d4b2;
            font-weight: bold;
            text-align: center;
            overflow: hidden;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .section-title {
            color: #0a2540;
            border-bottom: 3px solid #0a2540;
            padding-bottom: 10px;
            display: inline-block;
            margin-bottom: 25px;
        }

        .region-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            border: 1px solid #e1e8ed;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: #00d4b2;
        }

        .thumb {
            height: 150px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            font-weight: bold;
            overflow: hidden;
        }

        .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .title {
            padding: 15px;
            text-align: center;
            font-weight: bold;
            background: #fafafa;
            color: #0a2540;
        }

        .empty {
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px dashed #aaa;
            text-align: center;
        }

        @media (max-width: 900px) {
            .hero {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-image {
                width: 100%;
            }

            .region-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 520px) {
            .region-grid {
                grid-template-columns: 1fr;
            }

            .nav-actions {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <strong>
        <a href="{{ route('home') }}">
            🐟 Freshwater Creatures Wiki
        </a>
    </strong>

    <div class="nav-actions">
        @auth
            <a href="{{ url('/admin') }}" class="login-btn">
                Add Region / Species
            </a>

            <form method="POST" action="{{ route('public.logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('public.login.form') }}" class="login-btn">
                Login/Register
            </a>
        @endauth
    </div>
</div>

<div class="container">
    <div class="hero">
        <div class="hero-text">
            <h1>
                Welcome To Freshwater Creature
            </h1>

            <p>
                {{ $webSetting?->description ?? 'Eksplorasi mini wiki tentang ikan air tawar, habitat sungai, rawa, serta karakteristik biologis dari berbagai wilayah dunia.' }}
            </p>

            @auth
                <div class="hero-actions">
                    <a href="{{ url('/admin/regions/create') }}" class="primary-btn">
                        + Add Region
                    </a>
                </div>
            @endauth
        </div>

        <div class="hero-image">
            @if ($webSetting?->logo)
                <img src="{{ asset('storage/' . $webSetting->logo) }}" alt="Website Logo">
            @else
                Logo / Website Image
            @endif
        </div>
    </div>

    <h2 class="section-title">Explore Region</h2>

    @if ($regions->isEmpty())
        <div class="empty">
            <h3>Belum ada region</h3>
            <p>Login terlebih dahulu untuk menambahkan region.</p>
        </div>
    @else
        <div class="region-grid">
            @foreach ($regions as $region)
                <a href="{{ route('region.show', $region->slug) }}" class="card">
                    <div class="thumb">
                        @if ($region->image)
                            <img src="{{ asset('storage/' . $region->image) }}" alt="{{ $region->name }}">
                        @else
                            {{ strtoupper($region->name) }}
                        @endif
                    </div>

                    <div class="title">
                        {{ $region->name }}
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fish->name }} - Wiki Detail</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #2c3e50;
            line-height: 1.6;
        }

        .navbar {
            background: #0a2540;
            padding: 15px 30px;
            display: flex;
            justify-content: flex-start;
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
            margin-bottom: 25px;
            font-size: 0.9rem;
            color: #718096;
        }

        .breadcrumbs a {
            color: #164e87;
            text-decoration: none;
        }

        .breadcrumbs a:hover {
            text-decoration: underline;
        }

        .layout {
            display: flex;
            gap: 40px;
        }

        .main {
            flex: 1;
            background: white;
            padding: 35px;
            border-radius: 12px;
            border: 1px solid #e1e8ed;
        }

        .main h1 {
            margin-top: 0;
            font-size: 2.3rem;
            color: #0a2540;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 10px;
        }

        .main h2 {
            color: #164e87;
            font-size: 1.5rem;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .main p {
            text-align: justify;
            font-size: 1.05rem;
            color: #4a5568;
        }

        .sidebar {
            width: 320px;
            background: white;
            border: 1px solid #00d4b2;
            border-radius: 8px;
            overflow: hidden;
            align-self: flex-start;
        }

        .sidebar-title {
            background: #0a2540;
            color: #00d4b2;
            padding: 15px;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
        }

        .sidebar-image {
            height: 220px;
            background: #edf2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            font-size: 0.85rem;
            font-weight: bold;
            border-bottom: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .sidebar-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #edf2f7;
        }

        table td.label {
            font-weight: bold;
            color: #718096;
            width: 40%;
            background: #fafafa;
        }

        table td.value {
            color: #2d3748;
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            background: #feebc8;
            color: #744210;
        }

        .bio-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            background: #c6f6d5;
            color: #22543d;
        }

        .edit-btn {
            display: inline-block;
            margin-top: 20px;
            background: #00d4b2;
            color: #0a2540;
            padding: 10px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .edit-btn:hover {
            background: #00b89a;
        }

        @media (max-width: 900px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <strong>
        <a href="{{ route('home') }}">🐟 Freshwater Wiki</a>
    </strong>
</div>

<div class="container">
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">Home</a> /
        <a href="{{ route('home') }}">Region</a> /
        <a href="{{ route('region.show', $fish->region->slug) }}">{{ $fish->region->name }}</a> /
        <strong>{{ $fish->name }}</strong>
    </div>

    <div class="layout">
        <div class="main">
            <h1>{{ $fish->name }}</h1>

            <p>
                {{ $fish->description ?? 'Deskripsi ikan belum tersedia.' }}
            </p>

            <h2>Karakteristik & Perilaku</h2>

            <p>
                {{ $fish->characteristics ?? 'Karakteristik dan perilaku ikan belum tersedia.' }}
            </p>

            @auth
                <a href="{{ url('/admin/regions/' . $fish->region_id . '/edit') }}" class="edit-btn">
                    Edit Data
                </a>
            @endauth
        </div>

        <div class="sidebar">
            <div class="sidebar-title">{{ $fish->name }}</div>

            <div class="sidebar-image">
                @if ($fish->image)
                    <img src="{{ asset('storage/' . $fish->image) }}" alt="{{ $fish->name }}">
                @else
                    ILUSTRASI IKAN
                @endif
            </div>

            <table>
                <tr>
                    <td class="label">Nama Ilmiah</td>
                    <td class="value">{{ $fish->scientific_name ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Region</td>
                    <td class="value">{{ $fish->region->name }}</td>
                </tr>

                <tr>
                    <td class="label">Habitat Asli</td>
                    <td class="value">{{ $fish->habitat ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Berat Rata-rata</td>
                    <td class="value">{{ $fish->average_weight ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Status</td>
                    <td class="value">
                        <span class="status-badge">
                            {{ $fish->status ?? 'Unknown' }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="label">Biogeografi</td>
                    <td class="value">
                        <span class="bio-badge">
                            {{ $fish->biogeography ?? '-' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>

@extends('layouts.layouts')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kirim Pesan WhatsApp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 480px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #25D366; /* warna hijau WhatsApp */
        }
        .status {
            margin: 15px 0;
            padding: 12px;
            border-radius: 5px;
            font-weight: bold;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        button {
            background-color: #25D366;
            border: none;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #1ebe57;
        }
    </style>
</head>
<body>
    <h1>Kirim Pesan WhatsApp</h1>

    @if(session('status'))
        <div class="status success">{{ session('status') }}</div>
    @endif

    @if(session('error'))
        <div class="status error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="">
        @csrf
        <button type="submit">Kirim Pesan WhatsApp</button>
    </form>
</body>


@endsection
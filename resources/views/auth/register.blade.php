<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Toko Online</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 6px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 25px;
        }

        .form-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .divider {
            margin: 20px 0;
            text-align: center;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #7f8c8d;
            font-size: 14px;
        }

        .back-link {
            display: inline-block;
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
            margin-top: 15px;
        }

        .back-link:hover {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Daftar</h1>
            <p>Buat akun baru untuk mulai berbelanja</p>
        </div>

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Nama / Username</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Masukkan nama Anda" required>
                @error('nama')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password Anda" required>
            </div>

            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="form-footer">
            <a href="{{ url('/login') }}">Sudah punya akun? Login sekarang</a>
        </div>

        <div class="form-footer">
            <a href="{{ url('/') }}" class="back-link">← Kembali ke Home</a>
        </div>
    </div>
</body>
</html>

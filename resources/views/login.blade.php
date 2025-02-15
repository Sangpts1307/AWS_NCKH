<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-box {
            width: 320px;
            height: 380px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-box h2 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px; 
        }
        .form-label {
            font-size: 14px;
            margin-bottom: 8px;
        }
        .form-control {
            height: 42px;
            font-size: 15px;
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .btn-login {
            width: 100%;
            height: 45px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Đăng nhập</h2>
        <form action="{{ url('/login') }}" method="POST">
            <div class="mb-4">
                <label class="form-label">Tên đăng nhập <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" placeholder="example@gmail.com" name="email">
                {{ csrf_field() }}
            </div>
            <div class="mb-4">
                <label class="form-label">Mật khẩu <span class="text-danger">(*)</span></label>
                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-login">Đăng nhập</button>
        </form>
    </div>

</body>
</html>

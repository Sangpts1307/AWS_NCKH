<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Dữ Liệu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-box {
            max-width: 1000px;
            height: 550px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-logout {
            float: right;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container-box">
        <div class="col-md-12">
            <h3 class="text-center mb-3">Hệ thống quản lý dữ liệu</h3>
            <a href="/logout" class="btn btn-danger btn-logout">Đăng xuất</a>
        </div>
        <!-- Search form -->
        <div class="row">
            <div class="row col-md-9">
                <form id="search-form" class="row" action="{{ url('/homePage') }}" method="GET" enctype="multipart/form-data">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Tên file" name="file_name" value="@if(isset($param['file_name'])) {{ $param['file_name'] }} @endif">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="from_date">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="to_date">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="row col-md-3">
                <form id="form-upload" action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
                    <!-- Upload file btn -->
                    <div class="col-md-6 mb-3">
                        <input id="choose_file" type="file" name="file" class="btn btn-primary hidden">
                        <label for="choose_file" class="btn btn-primary">Tải lên</label>
                        {{ csrf_field() }}
                    </div>
                    
                </form>
            </div>
        </div>

        <!-- Data table -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tên file</th>
                    <th>Ngày upload</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>{{ $file->file_name }}</td>
                    <td>{{ $file->created_at }}</td>
                    <td>
                        <a href="{{ url('/download/' . $file->id) }}" class="btn btn-sm btn-primary">Tải về</a>
                        <a href="{{ url('/delete/' . $file->id) }}"  class="btn btn-sm btn-danger">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#choose_file').on('change', function() {
            $('#form-upload').submit();
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #c6540dff;
            position: fixed;
        }
        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #000000ff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 230px;
            padding: 20px;
        }
    </style>
</head>
<body>

@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="content">
    @yield('content')
</div>

</body>
</html>

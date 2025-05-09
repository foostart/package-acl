<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/mail-base.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/font-awesome-4.7.0.min.css') }}">
</head>
<body>
<h2>{!! Config::get('acl_base.app_name') !!}</h2>
<div>
    Nếu bạn đã gửi yêu cầu khôi phục mật khẩu từ Hệ thống quản lý thực tập của Khoa CNTT Trường Cao đẳng Công nghệ Thủ Đức,
    {!! $body !!} để khôi phục mật khẩu.<br/>
    Nếu bạn không gửi yêu cầu, có thể bỏ qua email này.
</div>
</body>
</html>

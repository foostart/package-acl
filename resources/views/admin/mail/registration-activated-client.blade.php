
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {!! HTML::style('package-acl/css/mail-base.css') !!}
   {!! HTML::style('package-acl/css/font-awesome-4.7.0.min.css') !!}
</head>
<body>
<h2>Welcome to {!! Config::get('acl_base.app_name')!!}</h2>
<div>
    <h3>Dear: {!! $body['email'] !!}</h3>
    <strong>Your email has been confirmed successfully.</strong>
    You can now login to the website using the
    <a href="{!! URL::to('/login') !!}">Following link</a>.
</div>
</body>
</html>

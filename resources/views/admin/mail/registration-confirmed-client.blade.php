<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {!! HTML::style('packages/foostart/css/font-awesome-4.7.0.min.css') !!}
    {!! HTML::style('packages/foostart/css/mail-base.css') !!}
</head>
<body>
<h2>Welcome to: {!! Config::get('acl_base.app_name') !!}</h2>
<div>
    <h3>Dear: {!! $body['first_name'] !!}</h3>
    <strong>You account has been created.</strong> You can now login to the website using the
    <a href="{!! URL::to('/login') !!}">Following link</a>.
    <br/>
    <strong>Please find your account details below: </strong>
    <ul>
        <li>Username: {!! $body['email']!!}</li>
        <li>Password: {!! $body['password']!!}</li>
    </ul>
</div>
</body>
</html>
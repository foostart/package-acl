<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {!! HTML::style('packages/foostart/css/mail-base.css') !!}
    {!! HTML::style('packages/foostart/css/font-awesome-4.7.0.min.css') !!}
</head>
<body>
<h2><i class="fa fa-pencil"></i> Registration request on: {!!Config::get('acl_base.app_name')!!}</h2>
<div>
    <h3>Dear: {!!$body['first_name']!!}</h3>
    <strong>You account has been created. However, before you can use it you need to confirm your email address first by clicking the
        <a href="{!!URL::route('user.email-confirmation', ['token' => $body['token'], 'email' => $body['email'] ] )!!}">Following link</a></strong>
    <br/>
    <strong>Please find your account details below: </strong>
    <ul>
        <li>Username: {!!$body['email']!!}</li>
        <li>Password: {!!$body['password']!!}</li>
    </ul>
</div>
</body>
</html>
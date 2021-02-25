<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
        {!!  HTML::style('packages/foostart/css/mail-base.css') !!}
        {!! HTML::style('packages/foostart/css/font-awesome-4.7.0.min.css') !!}
	</head>
	<body>
		<h2>Password recovery for {!! Config::get('acl_base.app_name') !!}</h2>
		<div>
            We received a request to change your password, if you authorize it {!! $body !!}<br/>
            Otherwise ignore this email.
		</div>
	</body>
</html>
<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
</head>
<body>
<h2>{{{ $subject }}}</h2>
@section('content')
@show
<br>
<p>
{{{ Lang::get('email.thanks') }}},
<br>
{{{ Lang::get('email.sender') }}}
</p>
</body>
</html>

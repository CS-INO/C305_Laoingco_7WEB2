@include('components.header')
{!! Form::open(['route'=>'login', 'method'=>'get']) !!}
<p>Email</p>
{!! Form::text('email') !!}
<p>Password</p>
{!! Form::text('password') !!}

@include('components.footer')

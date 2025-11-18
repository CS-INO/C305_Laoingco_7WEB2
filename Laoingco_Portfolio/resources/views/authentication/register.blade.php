@include('components.header')
{!! Form::open(['route'=>'register', 'method'=>'post']) !!}
<p>Name</p>
{!! Form::text('name') !!}
<p>Email</p>
{!! Form::Email('email') !!}
<p>Password</p>
{!! Form::Password('password') !!}
<p>Confirm Password</p>
{!! Form::Password('password_confirmation') !!}

@include('components.footer')


@layout('templates.main')
@section('welcome')
	{{ 'Hello, you don\'t need to sign up if you\'ve got an '  }}
	{{ HTML::link('admin', 'Login') }}
@endsection
@section('content')
	{{ Form::open('signup') }}
		{{-- username field --}}
		<p> {{ Form::label('username', 'Username') }} </p>
		<p> {{ Form::text('username') }} </p>
		{{-- password field --}}
		<p> {{ Form::label('password', 'Password') }} </p>
		<p> {{ Form::password('password') }} </p>
		{{-- password confirmation field --}}
		<p> {{ Form::label('password_confirmation', 'Confirm password') }} </p>
		<p> {{ Form::password('password_confirmation') }} </p>
		{{-- submit button --}}
		<p> {{ Form::submit('Sign up') }} </p>
	{{ Form::close() }}
@endsection
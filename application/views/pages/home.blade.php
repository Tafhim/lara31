@layout('templates.main')
@section('welcome')
	{{ 'Hello guest, ' }}
	{{ HTML::link('admin', 'Login') }}
	{{ '?' }}
@endsection
@section('content')
	@foreach ($posts as $post)
		<div class="post">
			<h1>{{ HTML::link('view/'.$post->id, $post->title) }}</h1>
			<p>{{ substr($post->body,0, 120).' [..]' }}</p>
			<p>{{ HTML::link('view/'.$post->id, 'Read more &rarr;') }}</p>
		</div>
	@endforeach
@endsection
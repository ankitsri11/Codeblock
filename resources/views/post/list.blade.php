@extends('master')

@section('css')

@stop

@section('content')
	@if(isset($category))
		<h2>All Codeblocks in category: {{ $category->name }}</h2>
	@elseif(isset($tag))
		<h2>All Codeblocks with tag: {{ $tag->name }}</h2>
	@else
		<h2>{{ $title }}</h2>
	@endif

	@if(count($posts) > 0)
		@foreach ($posts as $post)
			@if($post['private'] != 1)
				<h3 class="text-left margin-top-half">{{HTML::actionlink($url = array('action' => 'PostController@show', 'params' => array($post['slug'])), $post['name'], array('class' => 'display-block decoration-none'))}}</h3>
				<div class="margin-bottom-half">
					<p>
						<i class="fa fa-user"></i> {{HTML::actionlink($url = array('action' => 'UserController@show', 'params' => array($post['user']['id'])), $post['user']['username'])}}
						<i class="fa fa-minus"></i>
						<i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($post['created_at'])) }}
					</p>
				</div>
				<p>{{ $post['description'] }}</p>
				<hr class="margin-bottom-half">
			@else
				@if(Auth::check())
					@if(Auth::user()->id == $post->user_id)
						<h3 class="text-left margin-top-half">{{HTML::actionlink($url = array('action' => 'PostController@show', 'params' => array($post['slug'])), $post['name'], array('class' => 'display-block decoration-none'))}}</h3>
						<div class="margin-bottom-half">
							<p>
								<i class="fa fa-user"></i> {{HTML::actionlink($url = array('action' => 'UserController@show', 'params' => array($post['user']['id'])), $post['user']['username'])}}
								<i class="fa fa-minus"></i>
								<i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($post['created_at'])) }}
							</p>
						</div>
						<p>{{ $post['description'] }}</p>
						<hr class="margin-bottom-half">
					@else
						<h3>{{ $post['name'] }}</h3>
						<p><strong>This codeblock is private...</strong></p>
						<hr class="margin-bottom-half">
					@endif
				@endif
			@endif
		@endforeach
	@else
		<div class="text-center alert info">There are no blocks here yet.</div>
	@endif
@stop

@section('script')

@stop
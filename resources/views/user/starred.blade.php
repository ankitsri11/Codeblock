@extends('master')

@section('css')

@stop

@section('content')
	@if(isset($posts))
		<h2>{{ $user->username }}s starred Codeblocks</h2>
		@if(count($posts) > 0)
			@foreach ($posts as $post)
				@if($post->private != 1 || Auth::check() && Auth::user()->id == $post->user_id)
					<h3 class="text-left margin-top-half">{{HTML::actionlink($url = array('action' => 'PostController@show', 'params' => array($post->slug)),$post->name, array('class' => 'display-block decoration-none'))}}</h3>
					<div class="margin-bottom-half">
						<p>
							<i class="fa fa-user"></i> {{HTML::actionlink($url = array('action' => 'UserController@show', 'params' => array($post->user->username)), $post->user->username)}}
							<i class="fa fa-minus"></i>
							<i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($post->created_at)) }}
						</p>
					</div>
					<p>{{ $post->description }}</p>
					<hr class="margin-bottom-half">
				@endif
			@endforeach
		@else
			<div class="text-center alert info">You have no starred codeblocks yet.</div>
		@endif
	@endif
@stop

@section('script')

@stop
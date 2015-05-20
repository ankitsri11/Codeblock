@extends('master')

@section('css')

@stop

@section('content')
	<h2>Users</h2>
	{{ HTML::table(array('username', 'email', array('active' => 'isactive'), array('role' => 'rolename'), 'created_at'), $users, array('Pagination' => 10,  'Edit' => 'UserController@edit', 'View' => 'UserController@show'), 'There are no users right now.') }}
@stop

@section('script')

@stop
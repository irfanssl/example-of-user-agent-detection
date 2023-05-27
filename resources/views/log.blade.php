@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col text-center">
			<img src="{{asset('images/avatar.jpg')}}" style="width: 200px; height: 200px" alt="avatar.jpg">
			<h5><b>{{$user->name}}</b></h5>
			<p>{{$user->email}}</p>
		</div>
    </div>
    <div class="row">
		<div class="col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-sm-10 col-md-8 col-lg-6">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col" class="text-center">User Agent</th>
						<th scope="col" class="text-center">Waktu</th>
					</tr>
				</thead>
				<tbody>
					@foreach($user->user_agent as $key => $agent)
					<tr>
						<td>
							@php
								$user_agent = json_decode($agent->user_agent);
							@endphp
							{{$user_agent->os}} - {{$user_agent->browser}} <br>
							{{$user_agent->device_vendor}} - {{$user_agent->device_model}} - {{$user_agent->device_type}}
						</td>
						<td>{{date_format(date_create($agent->created_at), 'd/m/Y h:m')}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-sm-1 col-md-2 col-lg-3"></div>
    </div>
</div>
@endsection

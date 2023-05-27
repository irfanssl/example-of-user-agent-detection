@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($user as $use)
            <div class="col g-4">
                <div class="card h-80" style="width: 15rem;">
                    <img src="{{asset('images/avatar.jpg')}}" class="card-img-top" alt="avatar.jpg">
                    <div class="card-body">
                        <h5 class="card-title">{{ substr($use->name, 0, 10)}} <span class="fs-6"><br><b>{{ substr($use->email, 0, 15)}}</b></span></h5>
                        <p class="card-text">
                            @php
								$user_agent = json_decode($use->last_user_agent);
                                if(count($user_agent) > 0){
                                    $device = json_decode($user_agent[0]->user_agent);
                                }
							@endphp
                            
                            @if(isset($device))
                            {{'Last : '.$device->browser.' - '.$device->os.' - '.$device->device_vendor}}
                                @else
                                &nbsp;
                            @endif
                            
                            @php
                                $device = null;
                            @endphp
                        </p>
                        <a href="/user/email/{{$use->email}}" class="btn btn-primary">User agent history</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row my-5">
        <div class="col text-center">
            {{ $user->links() }}
        </div>
    </div>
</div>
@endsection

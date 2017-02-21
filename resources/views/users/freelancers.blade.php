@extends('layouts.app')
@section('title') Фрилансеры @stop
@section('content')
    <div class="row">
        <div class="col s12 m3">
            <h2>Специальность</h2>
            <ul class="cats">
                @foreach ($cats as $cat)
                    <li><a href="{{ route('user.cat', $cat->slug) }}" class="valign-wrapper"><img src="{{$cat->img}}"> <span class="valign">{{$cat->title}}</span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="col s12 m9">
            <h2>Фрилансеры</h2>
            <div class="freelancers">
                @foreach ($freelancers as $freelancer)
                    @if ($freelancer->hasRole('Freelancer'))
                        <div class="freelancer col s3">
                            <a href="/user/{{ $freelancer->id }}"><img src="/uploads/avatars/{{ $freelancer->image }}" class="avatar freelancer_avartar"></a>
                            <a href="/user/{{ $freelancer->id }}"><h3>{{ $freelancer->first_name }} {{ $freelancer->last_name }}</h3></a>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
@stop
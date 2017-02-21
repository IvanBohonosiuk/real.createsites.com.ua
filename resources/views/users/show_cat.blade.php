@extends('layouts.app')

@section('title') {{ $ucat->title }} @endsection

@section('content')
    <div class="row">
        <div class="col s12 m3 l3">
            <h2>Специальность</h2>
            <ul class="cats">
                @foreach ($cats as $cat)
                    <li><a href="{{ route('user.cat', $cat->slug) }}" class="valign-wrapper"><img src="{{$cat->img}}"> <span class="valign">{{$cat->title}}</span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="col s12 m9 l9">
            <h2>Фрилансеры категории {{ $ucat->title }}</h2>
            <div class="freelancers">
                @foreach ($freelancers as $freelancer)
                    @foreach($freelancer->categories as $item)
                        @if($ucat->id == $item->id)
                            @if ($freelancer->hasRole('Freelancer'))
                                <div class="freelancer col s3">
                                    <a href="/user/{{ $freelancer->id }}"><img src="/uploads/avatars/{{ $freelancer->image }}" class="avatar freelancer_avartar"></a>
                                    <a href="/user/{{ $freelancer->id }}"><h3>{{ $freelancer->first_name }} {{ $freelancer->last_name }}</h3></a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
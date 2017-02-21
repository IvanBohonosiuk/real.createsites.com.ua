@extends('layouts.app')

@section('title') Shop @endsection

@section('content')
    <div class="row">
        <div class="col s12 m3 l3">
            <h2>Специальность</h2>
            <ul class="cats">
                {{--@foreach ($cats as $cat)--}}
                    {{--<li><a href="{{ route('project.cat', $cat->slug) }}" class="valign-wrapper"><img src="{{$cat->img}}"> <span class="valign">{{$cat->title}}</span></a></li>--}}
                {{--@endforeach--}}
            </ul>
        </div>
        <div class="col s12 m9 l9">
            <h2>@lang('app.menu_shop')</h2>
            @if (Auth::user())
                @if (Auth::user()->hasRole('Freelancer'))
                    <a href="{{ route('project.create') }}" class="right btn waves-effect prj_create_proect blue"><i class="material-icons">add</i> <span>Добавить товар</span></a>
                @endif
            @endif
            <div class="row">
                @foreach ($products as $product)
                    <div class="col s3 prj card-panel hoverable">
                        <div class="product_img">
                            <img src="/uploads/products/{{ $product->img }}" width="100%" />
                        </div>
                        <a href="{{ route('shop.show', ['id' => $product->id]) }}" class="title">{{ $product->title }}</a>
                        <p class="price right">${{ $product->price }}</p>
                        <div class="meta">
                            <div class="user">
                                <a href="{{ route('user.show', $product->user->id) }}"><img src="/uploads/avatars/{{ $product->user->image }}" class="avatar project_avatar"></a>
                                <a href="{{ route('user.show', $product->user->id) }}" class="name">{{ $product->user->first_name }} {{ $product->user->last_name }}</a>
                                {{--                                <p><span class="rating">{{ $project->user->rating }}</span></p>--}}
                            </div>
                            {{--<div class="right"> Ставок {{ count($project->bids) }}</div>--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
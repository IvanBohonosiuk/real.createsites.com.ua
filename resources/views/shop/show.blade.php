@extends('layouts.app')
@section('title') {{$product->title}} @stop
@section('content')
    <div class="row">
        <div class="col s12 m4 l4">
            <div class="big_img">
                <img src="/uploads/products/{{ $product->img }}" width="100%" />
            </div>
        </div>
        <div class="project col s12 m8 l8">
            <h2>{{$product->title}}</h2>
            <p class="price right">${{$product->price}}</p>
            <p class="categories">
                @foreach ($product->categories as $category)
                    <a href="{{ route('project.cat', $category->slug) }}">{{$category->title}}</a>&nbsp;
                @endforeach
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="description">
                {!! $product->description !!}
            </div>
        </div>
    </div>
@stop
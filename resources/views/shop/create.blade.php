@extends('layouts.app')
@section('title') Создать продукт @stop
@section('content')

    @include('partials.error-messages')

    <div class="row">
        <div class="col m12">
            <h1 class="center">Создать продукт</h1>
            <form action="{{ route('shop.create.save') }}" method="POST">
                <div class="input-field col m12">
                    <label for="title">Название продукта</label>
                    <input type="text" class="validate" id="title" name="title">
                </div>

                <div class="input-field col m12">
                    <label for="description">Описание продукта</label>
                    <textarea name="description" id="description" class="materialize-textarea editor" rows="5"></textarea>
                </div>

                <div class="input-field col s12">
                    <select name="cat_ids[]" id="cat_id" multiple>
                        <option value="" disabled selected>Выберите категорию</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="input-field col m4">
                        <label for="price">Цена</label>
                        <input type="number" name="price" id="price" class="validate" step="5" required="required">
                    </div>

                    <div class="input-field col m4">
                        <label for="price">Цена со скидкой</label>
                        <input type="number" name="sale_price" id="sale_price" class="validate" step="5">
                    </div>

                    <div class="input-field col m4">
                        <label for="price">Количество</label>
                        <input type="number" name="qty" id="qty" class="validate" step="1" required="required">
                    </div>
                </div>

                <div class="file-field input-field clearfix">
                    <div class="btn">
                        <span>Главное изображение товара</span>
                        <input type="file" id="img" name="img">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="_token" id="token" value="{{ Session::token() }}">
                <button type="submit" class="btn blue">Опубликовать продукт</button>
            </form>
        </div>
    </div>

    @include('tinymce::tpl', ['els' => ['editor']])

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@stop

@stop
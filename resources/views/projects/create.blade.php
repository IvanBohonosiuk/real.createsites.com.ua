@extends('layouts.app')
@section('title') Создать проект @stop
@section('content')

    @include('partials.error-messages')

    <div class="row">
        <div class="col m12">
            <h1 class="center">Создать проект</h1>
            <form action="{{ route('project.create.save') }}" method="POST">
                <div class="input-field col m12">
                    <label for="title">Название проекта</label>
                    <input type="text" class="validate" id="title" name="title">
                </div>

                <div class="input-field col m12">
                    <label for="description">Описание проекта</label>
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

                <div class="input-field col m6">
                    <label for="price">Бюджет проекта</label>
                    <input type="number" name="price" id="price" class="validate" step="1" required="required">
                </div>

                <div class="col m6">
                    <label for="end_date">Актуален до</label>
                    <input type="date" name="end_date" id="end_date" class="datepicker">
                </div>

                <div class="col m12">
                    <p>
                        <input type="checkbox" name="remote" id="remote" value="1">
                        <label for="remote">Удаленная работа</label>
                    </p>
                </div>

                {{--<div class="input-field">--}}
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="_token" id="token" value="{{ Session::token() }}">
                    <button type="submit" class="btn blue">Опубликовать проект</button>
                {{--</div>--}}
            </form>
        </div>
    </div>

    @include('tinymce::tpl', ['els' => ['editor']])

    @section('scripts')
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.input-field select').material_select();
            });
        </script>
    @stop

@stop
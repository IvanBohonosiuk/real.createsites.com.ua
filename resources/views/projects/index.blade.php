@extends('layouts.app')

@section('title') @lang('project.list_title') @endsection

@section('content')
    <div class="row">
        <div class="col s12 m3 l3">
            <h2>Специальность</h2>
            <ul class="cats">
                @foreach ($cats as $cat)
                    <li><a href="{{ route('project.cat', $cat->slug) }}" class="valign-wrapper"><img src="{{$cat->img}}"> <span class="valign">{{$cat->title}}</span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="col s12 m9 l9">
            <h2>@lang('project.list_title')</h2>
            @if (Auth::user())
                @if (Auth::user()->can('add_projects'))
                    <a href="{{ route('project.create') }}" class="right btn waves-effect prj_create_proect blue"><i class="material-icons">add</i> <span>@lang('project.add')</span></a>
                @endif
            @endif
            @foreach ($projects as $project)
                <div class="prj card-panel hoverable">
                    <a href="{{ route('projects.show', ['id' => $project->id]) }}" class="title">{{ $project->title }}</a>
                    <p class="price right">${{ $project->price }}</p>
                    <div class="meta">
                        <p class="status left">{{ $project->status }}</p>
                        @if ($project->remote == 1)
                            <p class="remote right">@lang('project.remote')</p>
                        @endif
                        <div class="user">
                            <a href="{{ route('user.show', $project->user->id) }}"><img src="/uploads/avatars/{{ $project->user->image }}" class="avatar project_avatar"></a>
                            <a href="{{ route('user.show', $project->user->id) }}" class="name">{{ $project->user->first_name }} {{ $project->user->last_name }}</a>
                            {{--                                <p><span class="rating">{{ $project->user->rating }}</span></p>--}}
                        </div>
                        <div class="right"> Ставок {{ count($project->bids) }}</div>
                    </div>
                </div>
            @endforeach
            {{--{!! $projects->links() !!}--}}
{{--            {{ dd($projects) }}--}}
        </div>
    </div>
@endsection
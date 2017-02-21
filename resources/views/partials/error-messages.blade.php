@if (count($errors) > 0)
    <div class="row">
        <div class="col m4 offset-m4 center-align">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if (Session::has('message'))
    <div class="row">
        <div class="col m4 offset-m4 center-align">
            {{ Session::get('message') }}
        </div>
    </div>
@endif
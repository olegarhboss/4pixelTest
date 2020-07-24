@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="float-left">@isset($departament){{ $departament->name }}@else @lang('dashboard.new_departament') @endisset</h2>
        </div>
        
        <div class="card-body">
            @isset($departament)
                <form action={{ route('departaments.update', $departament->id) }} enctype="multipart/form-data" method=POST>
                @method('PUT')
            @else
                <form action={{ route('departaments.store') }} enctype="multipart/form-data" method=POST>
            @endisset
            @csrf

            <div class="form-group">
                <label for="exampleInputName">@lang('dashboard.name_departament')</label>
                <input type="text" name="name" value="@isset($departament){{ $departament->name }}@else{{ old('name') ?? '' }}@endisset" class="form-control form-control-lg @error('name') is-invalid @enderror" required placeholder="@lang('dashboard.departament_name_placeholder')" id="exampleInputName">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlDescription">@lang('dashboard.description_departament')</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="exampleFormControlDescription" rows="4" required placeholder="@lang('dashboard.departament_description_placeholder')">@isset($departament){{ $departament->description }}@else{{ old('description') ?? '' }}@endisset</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <b>@lang('dashboard.logo')</b>
            <div class="custom-file mt-2 mb-3">
                <input type="file" name="logo" accept="image/jpeg,image/png" class="custom-file-input @error('logo') is-invalid @enderror" @if(!isset($departament)) required @endif id="logoFile">
                <label class="custom-file-label" for="logoFile">@lang('dashboard.select_logo')</label>
                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <h3>@lang('dashboard.users')</h3>

            @foreach ($users as $user)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}" @if(isset($departament) && $user->departaments->find($departament->id)) checked @endif id="defaultCheck{{ $loop->index }}">
                    <label class="form-check-label" for="defaultCheck{{ $loop->index }}">
                        {{ $user->name }} (<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>)
                    </label>
                </div>
            @endforeach

            <hr>

            <button type=submit class="btn btn-primary">@lang('dashboard.save')</button>

            </form>
        </div>
    </div>
</div>
@endsection
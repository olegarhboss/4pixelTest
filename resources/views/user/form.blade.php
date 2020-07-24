@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="float-left">@isset($user){{ $user->name }}@else @lang('dashboard.new_user') @endisset</h2>
        </div>
        
        <div class="card-body">
            @isset($user)
                <form action={{ route('users.update', $user->id) }} method=POST>
                @method('PUT')
            @else
                <form action={{ route('users.store') }} method=POST>
            @endisset
            @csrf

            <div class="form-group">
                <label for="exampleInputName">@lang('dashboard.user_name')</label>
                <input type="text" name="name" value="@isset($user){{ $user->name }}@else{{ old('name') ?? '' }}@endisset" class="form-control form-control-lg @error('name') is-invalid @enderror" required placeholder="@lang('dashboard.user_name_placeholder')" id="exampleInputName">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">@lang('auth.email')</label>
                <input type="email" name="email" value="@isset($user){{ $user->email }}@else{{ old('email') ?? '' }}@endisset" class="form-control form-control-lg @error('email') is-invalid @enderror" required placeholder="@lang('dashboard.user_name_placeholder')" id="exampleInputEmail">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">@lang('auth.password')</label>
                <input type="password" name="password" @if (!isset($user)) required @endif class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="@lang('dashboard.password_placeholder')" id="exampleInputPassword1">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword2">@lang('passwords.confirm_password')</label>
                <input type="password" name="password_confirmation" @if (!isset($user)) required @endif class="form-control form-control-lg" placeholder="@lang('dashboard.password_placeholder')" id="exampleInputPassword2">
            </div>


            <hr>

            <button type=submit class="btn btn-primary">@lang('dashboard.save')</button>

            </form>
        </div>
    </div>
</div>
@endsection
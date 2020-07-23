@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('passwords.verify')</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang('passwords.fresh_email')
                        </div>
                    @endif

                    @lang('passwords.allert_send_link')
                    @lang('passwords.allert_dont_link')
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">@lang('passwords.resend_link')</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

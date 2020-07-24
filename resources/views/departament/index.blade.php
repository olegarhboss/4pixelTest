@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="float-left">@lang('dashboard.departaments')</h1>
            <a href="{{ route('departaments.create') }}" class="btn btn-primary float-right">@lang('dashboard.add')</a>
        </div>
        
        <div class="card-body">
            {{-- Оповещение о добавлении нового Отдела --}}
            @if (session('create-departament'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @lang('dashboard.added_allert') <strong>{{ session('create-departament') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
                
            {{-- Оповещение обновления Отдела --}}
            @if (session('update-departament'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @lang('dashboard.updated_allert') <strong>{{ session('update-departament') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
            
            {{-- Оповещение удаления отдела --}}
            @if (session('delete-departament'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    @lang('dashboard.deleted_allert') <strong>{{ session('delete-departament') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            {{-- Вывод списка всех Отделов --}}
            @each('components.departament', $departaments, 'departament')

            {{-- Постраничная навигация --}}
            {{ $departaments->links() }}
        </div>
    </div>
</div>
@endsection
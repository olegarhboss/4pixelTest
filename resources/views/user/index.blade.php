@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="float-left">@lang('dashboard.users')</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary float-right">@lang('dashboard.add')</a>
        </div>
        
        <div class="card-body">
            {{-- Оповещение о добавлении нового Пользователя --}}
            @if (session('create-user'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @lang('dashboard.added_allert') <strong>{{ session('create-user') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
                
            {{-- Оповещение обновления Пользователя --}}
            @if (session('update-user'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @lang('dashboard.updated_allert') <strong>{{ session('update-user') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
            
            {{-- Оповещение удаления Пользователя --}}
            @if (session('delete-user'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    @lang('dashboard.deleted_allert') <strong>{{ session('delete-user') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            {{-- Вывод списка всех Пользователей --}}
            <table class="table table-hover">
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->name }}</th>
                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td>{{ $user->created_at->isoFormat('HH:mm dddd Do MMMM YYYY') }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary">@lang('dashboard.edit')</a>
                            
                            <button type="button" class="btn btn-danger" onclick="document.getElementById('destroy-form_{{ $user->id }}').submit();">@lang('dashboard.delete')</button>
                            <form id="destroy-form_{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {{-- Постраничная навигация --}}
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
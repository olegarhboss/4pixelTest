<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ asset($departament->logo) }}" class="card-img" alt="...">
        </div>
        
        <div class="col-md-8">
            <div class="card-body">
                <h2 class="card-title">{{ $departament->name }}</h2>
                
                <div class="float-right">
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('destroy-form_{{ $departament->id }}').submit();">@lang('dashboard.delete')</button>
                    <a href="{{ route('departaments.edit', $departament->id) }}" class="btn btn-secondary">@lang('dashboard.edit')</a>

                    <form id="destroy-form_{{ $departament->id }}" action="{{ route('departaments.destroy', $departament->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                <p class="card-text">{{ $departament->description }}</p>
                
                @if ($departament->users->count() > 0)
                    <h3 class="card-title">@lang('dashboard.users')</h3>
                    
                    <ol>
                        @foreach ($departament->users as $user)
                            <li>{{ $user->name }}</д>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
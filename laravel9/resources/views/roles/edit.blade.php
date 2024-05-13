<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="name" value="{{$role->name}}" class="form-control" id="exampleInputEmail1">
                    </div>

                    @foreach ($permissions as $permision)
                        <div class="form-group form-check">
                            <input type="checkbox" value="{{ $permision->id }}" @if($role->hasPermissionTo($permision->name)) checked @endif name="permissions[]" class="form-check-input"
                                id="exampleCheck{{ $permision->id }}">
                            <label class="form-check-label" for="exampleCheck{{ $permision->id }}">{{ $permision->name }}</label>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-outline-success">Save role</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

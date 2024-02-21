<x-app-layout>

    @section('css-styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="row g-3" action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                            @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <label for="roles" class="form-label">Roles</label>
                            <select id="roles" class="form-select multipleRoles" multiple='multiple' name="roles[]">
                                @if (isset($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" @if (in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('roles'))
                                <p class="text-danger">{{ $errors->first('roles') }}</p>
                            @endif
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @section('js-script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('.multipleRoles').select2({
                    placeholder: 'Select roles',
                    multiple:true,

                });
            });
        </script>
    @endsection
</x-app-layout>

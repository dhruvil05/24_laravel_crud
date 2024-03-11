<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Add User</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($users))
                                @foreach ($users as $user)
                                    
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }} {{ !$loop->last ? ', ' : ''}}
                                        @endforeach
                                    </td>
                                    @php
                                        $hide = array('SuperAdmin', 'Admin');
                                        $userroles = $user->roles->pluck('name')->toArray();
                                    @endphp
                                    <td class="">
                                        @if ($user->id !== 1)
                                            <a href="{{ route( 'user.edit', $user->id) }}" class="btn btn-primary m-2">Edit</a>
                                            <a href="{{ route( 'user.view', $user->id) }}" class="btn btn-success m-2">View</a>
                                            <form action="{{ route('user.delete', $user->id) }}" method="GET" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

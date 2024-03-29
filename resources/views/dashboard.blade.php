<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Students') }}
            </h2>
            <a href="{{route('create')}}" class="btn btn-sm btn-primary">Add Student</a>
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
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($students))
                                @foreach ($students as $student)
                                    
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->city }}</td>
                                    <td>{{ ucwords(Str::lower($student->state)) }}</td>
                                    <td>{{ $student->zip }}</td>
                                    <td class="flex align-items-center flex-direction-column">
                                        <a href="update/{{ $student->id }}" class="btn btn-primary m-2">Edit</a>
                                        <form action="{{ route('delete', $student->id) }}" method="post" class="m-2">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                                        </form>
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

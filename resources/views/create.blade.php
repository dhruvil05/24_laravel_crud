<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="row g-3" action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="{{old('firstName')}}">
                            @if($errors->has('firstName'))
                                <p class="text-danger">{{ $errors->first('firstName') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="{{old('lastName')}}">
                            @if($errors->has('lastName'))
                                <p class="text-danger">{{ $errors->first('lastName') }}</p>
                            @endif
                        </div>
                        <div class="col-md-12 inline-flex">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male">
                            <label class="form-check-label ml-2" for="inlineRadio1">Male</label>
                           
                            <input class="form-check-input ml-4" type="radio" name="gender" id="genderFemale" value="Female">
                            <label class="form-check-label ml-2" for="inlineRadio2">Female</label>

                            @if($errors->has('gender'))
                                <p class="text-danger ml-4">{{ $errors->first('gender') }}</p>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{old('address')}}">
                            @if($errors->has('address'))
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
                            @if($errors->has('city'))
                                <p class="text-danger">{{ $errors->first('city') }}</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select id="state" class="form-select" name="state">
                                <option value=" ">Selete</option>
                                @if (isset($states))
                                    @foreach ($states as $state)
                                        <option>{{$state->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('state'))
                                <p class="text-danger">{{ $errors->first('state') }}</p>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="{{old('zip')}}">
                            @if($errors->has('zip'))
                                <p class="text-danger">{{ $errors->first('zip') }}</p>
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
</x-app-layout>

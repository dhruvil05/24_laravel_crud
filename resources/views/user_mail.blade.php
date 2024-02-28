<p><b>User name: </b> {{$user['name']}} </p>
<p><b>User roles: </b> 
    @foreach ($user['roles'] as $role)
        {{ $role->name }} {{ !$loop->last ? ', ' : ''}}
    @endforeach </p>
<p><b>User Email: </b> {{$user['email']}} </p>
<div>
    <h2>Hello, {{ $user->name }}</h2>

    <p>Roles:</p>
    <ul>
        @foreach ($roles as $role)
            <li>{{ $role }}</li>
        @endforeach
    </ul>

    <p>Permissions:</p>
    <ul>
        @foreach ($permissions as $permission)
            <li>{{ $permission }}</li>
        @endforeach
    </ul>
</div>

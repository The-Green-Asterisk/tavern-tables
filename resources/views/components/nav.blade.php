<nav>
    <a href="{{ route('home') }}">Home</a>
    @if(auth()->check())
        @if($taverns->count() > 0)
            <div id="tavern-menu">
                <div id="tavern-menu-button">Taverns</div>
                @foreach($taverns as $tavern)
                    <a href="{{ route('tavern', ['tavern' => $tavern->id]) }}">{{ $tavern->name }}</a>
                @endforeach
                <a href="{{ route('create-tavern') }}">Create Tavern</a>
            </div>
        @else
            <a href="{{ route('create-tavern') }}">Create Tavern</a>
        @endif
        <a href="{{ route('logout') }}">Log Out</a>
    @else
        <a id="login" href="#">Log In</a>
        <a id="signup" href="#">Sign Up</a>
    @endif
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
</nav>
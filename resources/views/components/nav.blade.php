<nav>
    <a href="{{ route('home') }}">Home</a>
    @if(auth()->check())
        @if(isset($taverns) && $taverns->count() > 0)
            <div id="tavern-menu">
                <div id="tavern-menu-button">Taverns</div>
                <div id="tavern-menu-options">
                    @foreach($taverns as $tavern)
                        <a href="{{ route('tavern', ['tavern' => $tavern->id]) }}">{{ $tavern->name }}</a>
                    @endforeach
                    <a href="{{ route('create-tavern-form') }}">Create Tavern</a>
                </div>
            </div>
        @else
            <a href="{{ route('create-tavern-form') }}">Create Tavern</a>
        @endif
        <a href="{{ route('logout') }}">Log Out</a>
    @else
        <a id="login" href="#">Log In</a>
        <a id="signup" href="#">Sign Up</a>
    @endif
</nav>
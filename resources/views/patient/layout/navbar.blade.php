<nav style="display: flex;">
    <div >
        <div class="user">
            <h3>{{ Auth::user()->name }}</h3>
            <p>{{ Auth::user()->email }}</p>
        </div>
        <div class="links">
            <div class="link">
                <a href="{{ route('patient.index') }}">
                    <h4>View</h4>
                </a>
            </div>
            <div class="link">
                <a href="{{ route('patient.book') }}">
                    <h4>Book</h4>
                </a>
            </div>
        </div>
    </div>

    <div style="height: 100%; display:flex; align-items: flex-end;">
        <form method="POST" action="{{ route('logout') }}" style="margin-bottom: 25px;">
            @csrf
            <input type="submit" value="logout"/>
        </form>
    </div>


</nav>

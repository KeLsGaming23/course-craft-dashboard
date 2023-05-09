    <h1 class="display-4">403 Forbidden</h1>
    <p>You do not have permission to access this page.</p>
    <a style="display: inline-block; 
                background-color: #007bff; 
                color: #fff; padding: 8px 16px; 
                border-radius: 4px; text-decoration: none; 
                transition: background-color 0.3s ease;" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('customLogout') }}" method="POST" style="display: none;">
        @csrf
    </form>
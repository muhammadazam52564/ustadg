<nav id="sidebar" class="sticky-top">
    <div class="sidebar-header">
        <h3>Ustad G.</h3>
    </div>
    <ul class="list-unstyled components">
        <p>Admin Dashboard</p>
        <li>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('admin.categories') }}">Categories</a>
        </li>
        <li>
            <a href="{{ route('admin.orders') }}">Order List</a>
        </li>
        <li>
            <a href="#ProfileSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Profile Settings</a>
            <ul class="collapse list-unstyled" id="ProfileSettings">
                <li>
                    <a href="{{ route('admin.change-password') }}">Change Password</a>
                </li>
                <li>
                    <a href="{{ route('admin.change-email') }}">Change Email</a>
                </li>
            </ul>
        </li>
    </ul>
    <div  class="my-5 py-5">
    </div>
    <div  class="mt-4 pt-4 d-flex justify-content-center">
        <label id="label" for="logout"  style="cursor: pointer">
            <i class="fa fa-sign-out-alt" ></i>Logout
        </label>
    </div>
    <div  class="mt-4 pt-4">
    </div>
</nav>

<form method="post" action="{{ route('logout')}}" class="d-none">
    @csrf
    <input  type="submit" id="logout">
</form>



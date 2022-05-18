<nav id="sidebar" class="sticky-top">
    <div class="sidebar-header">
        <h3>Ustad G.</h3>
    </div>
    <ul class="list-unstyled components">
        <p>Admin Dashboard</p>
        <li class="{{ Request::is('admin/dashboard') ? 'li-active':'' }}" >
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="{{ Request::is('admin/cities') ? 'li-active':'' }}" >
            <a href="{{ route('admin.cities') }}">
                <i class="fa fa-location"></i>
                Cities
            </a>
        </li>
        <li class="{{ Request::is('admin/domains') ? 'li-active':'' }}">
            <a href="{{ route('admin.domains') }}">
                <i class="fa fa-location"></i>
                Domains
            </a>
        </li>
        <li class="{{ Request::is('admin/categories') ? 'li-active':'' }}">
            <a href="{{ route('admin.categories') }}">
                <i class="fa fa-location"></i>
                Categories
            </a>
        </li>

        <li class="{{ Request::is('admin/banners') ? 'li-active':'' }}">
            <a href="{{ route('admin.banners', 'all') }}">
                <i class="fa fa-location"></i>
                Banners
            </a>
        </li>

        <li class="{{ Request::is('admin/orders') ? 'li-active':'' }}">
            <a href="{{ route('admin.orders') }}">
                <i class="fa fa-location"></i>
                Order List
            </a>
        </li>
        <li>
            <a href="#ProfileSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-location"></i>
                Profile Settings
            </a>
            <ul class="collapse list-unstyled {{ Request::is('admin/change-email') || Request::is('admin/change-password')  ? 'show':'' }}" id="ProfileSettings">
                <li>
                    <a
                        class="{{ Request::is('admin/change-password') ? 'li-active':'' }}"
                        href="{{ route('admin.change-password') }}">
                            <i class="ml-2 fa fa-location"></i>
                            Change Password
                    </a>
                </li>
                <li>
                    <a
                        class="{{ Request::is('admin/change-email') ? 'li-active':'' }}"
                        href="{{ route('admin.change-email') }}">
                            <i class="ml-2 fa fa-location"></i>
                            Change Email
                    </a>
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



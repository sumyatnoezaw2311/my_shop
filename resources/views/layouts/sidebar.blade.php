<div class="col-12 col-lg-4 col-xl-2 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 bg-light nav-brand">
        <div class="d-flex align-items-center">
            <span class="bg-primary p-2 rounded d-flex justify-content-center align-items-center mr-2">
                <i class="feather-shopping-bag text-white h4 mb-0"></i>
            </span>
            <span class="font-weight-bolder h4 mb-0 text-uppercase text-primary">My Shop</span>
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>

            <x-menu-spacer></x-menu-spacer>

            <x-menu-item name="Home" class="feather-home" link="{{ route('home') }}"></x-menu-item>

            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="My Test Menu"></x-menu-title>
            <x-menu-item name="Create Item" class="feather-plus-circle" ></x-menu-item>
            <x-menu-item name="Item List" class="feather-list" counter="50"></x-menu-item>

            @if(auth()->user()->role == 0)
                <x-menu-spacer></x-menu-spacer>
                <x-menu-title title="User Management"></x-menu-title>
                <x-menu-item name="User List" class="feather-list" link="{{ route('user-manager.users') }}" counter=""></x-menu-item>
                <x-menu-spacer></x-menu-spacer>
            @endif

            <x-menu-title title="User Profile"></x-menu-title>
            <x-menu-item name="Your Profile" class="feather-user" link="{{ route('profile') }}"></x-menu-item>
            <x-menu-item name="Change Password" class="feather-refresh-cw" link="{{ route('profile.edit.password') }}"></x-menu-item>
            <x-menu-item name="Update Name & Email" class="feather-message-square" link="{{ route('profile.edit.name.email') }}"></x-menu-item>
            <x-menu-item name="Update photo" class="feather-image" link="{{ route('profile.edit.photo') }}"></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            <x-menu-spacer></x-menu-spacer>
            <li class="menu-item">
                <a class="btn btn-outline-primary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    logout
                </a>
            </li>


        </ul>
    </div>
</div>

<li class="list-inline-item dropdown notification-list">
    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
       href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        <img src="{{asset('client/assets/images/user.png')}}" alt="user"
             class="rounded-circle">
    </a>
    <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5 class="text-overflow"><small>{{__('Xin chào! '.$userLogged->name)}}</small></h5>
        </div>

        <!-- item-->
        <a href="{{route('clients.users.info')}}" class="dropdown-item notify-item">
        <i class="zmdi zmdi-account-circle"></i> <span>{{__('Thông tin cá nhân')}}</span>
        </a>
        <a href="{{route('clients.users.edit_password')}}" class="dropdown-item notify-item">
            <i class="zmdi zmdi-account-circle"></i> <span>{{__('Đổi mật khẩu')}}</span>
        </a>
        <!-- item-->
        <a href="{{route('clients.logout')}}" class="dropdown-item notify-item">
            <i class="zmdi zmdi-power"></i> <span>Đăng xuất</span>
        </a>

    </div>
</li>

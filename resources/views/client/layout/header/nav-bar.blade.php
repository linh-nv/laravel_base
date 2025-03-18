<div class="navbar-custom">
    <div class="">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

{{--                <li>--}}
{{--                    <a href=""><i class="fi-air-play"></i>Tổng quan</a>--}}
{{--                </li>--}}

{{--                @can('view pawn receipts')--}}
{{--                <li>--}}
{{--                    <a href="{{route('clients.pawn-receipts.index')}}"><i class="icon-printer"></i>Cầm đồ</a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @can('view customers')--}}
{{--                <li>--}}
{{--                    <a href="{{route('clients.customers.index')}}"><i class="icon-people"></i>Khách hàng</a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @can('view categories')--}}
{{--                <li>--}}
{{--                    <a href="{{route('clients.categories.index')}}"><i class="icon-drawar"></i>Nhóm hàng hóa</a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @can('view products')--}}
{{--                <li>--}}
{{--                    <a href="{{route('clients.products.index')}}"><i class="icon-diamond"></i>Sản phẩm</a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @can('view invoice types')--}}
{{--                <li>--}}
{{--                    <a href="{{route('clients.invoice-types.index')}}"><i class="icon-diamond"></i>Loại hóa đơn</a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @can('view invoices')--}}
{{--                <li>--}}
{{--                    <a href="{{route('clients.invoices.index')}}"><i class="icon-diamond"></i>Hóa đơn</a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @role('root')--}}
                <li class="has-submenu">
                    <a href="#"><i class="fi-air-play"></i>Tổng quan</a>
                </li>
                <li class="has-submenu">
                    <a href="{{route('clients.pawn-receipts.index')}}"><i class="icon-printer"></i>Cầm đồ</a>
                </li>
                <li class="has-submenu">
                    <a href="{{route('clients.customers.index')}}"><i class="icon-people"></i>Khách hàng</a>
                </li>
                <li class="has-submenu">
                    <a href="{{route('clients.categories.index')}}"><i class=" icon-drawar"></i>Loại hàng hoá</a>
                </li>
                <li class="has-submenu"><a href="{{route('clients.users.index')}}"><i class="icon-user"></i>Người dùng</a></li>
                <li class="has-submenu"><a href="{{route('clients.shareholders.index')}}"><i class="icon-key"></i>Cổ đông</a></li>
                <li class="has-submenu"><a href="{{route('clients.capitals.index')}}"><i class="icon-layers"></i>Cổ phần</a></li>
               <li class="has-submenu">
                    <a href="#"><i class="fi-layers"></i>Hoá đơn</a>
                    <ul class="submenu">
                        <li><a href="{{route('clients.invoice-types.index')}}">Loại hoá đơn</a></li>
                        <li><a href="{{route('clients.fund-histories.index')}}">Lịch sử hoá đơn</a></li>
                    </ul>
                </li>
{{--                @endrole--}}
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->

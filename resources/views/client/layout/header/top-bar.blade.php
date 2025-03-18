<div class="topbar-main">
    <div class="container">

        <!-- Logo container-->
        @include('client.layout.header.top-bar.logo')
        <!-- End Logo container-->


        <div class="menu-extras topbar-custom">

            <ul class="list-inline float-right mb-0 d-flex">

                <li class="menu-item list-inline-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>
                @include('client.layout.header.top-bar.icon-list')
                @include('client.layout.header.top-bar.user')
            </ul>
        </div>
        <!-- end menu-extras -->
        <div class="clearfix"></div>
    </div> <!-- end container -->
</div>
<!-- end topbar-main -->

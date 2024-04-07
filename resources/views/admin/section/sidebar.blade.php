<nav class="page-sidebar" id="sidebar" style="background-color: #f4f4f4; padding: 20px;">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex" style="margin-bottom: 20px;">
            <div style="margin-right: 10px;">
                @if(file_exists(public_path(). '/uploads/user/'. auth()->user()->nimage))
                    <img src="{{ asset('uploads/user' . auth()->user()->image) }}" alt="" width="45px" style="border-radius: 50%;">
               
                @endif
            </div>
            <div class="admin-info">
                <div class="font-strong" style="color: #333; font-weight: bold;">{{ auth()->user()->name }}</div>
                <small style="color: #777;">{{ ucfirst(auth()->user()->role) }}</small></div>
        </div>
        <ul class="side-menu metismenu" style="list-style: none; padding: 0;">
            <li style="margin-bottom: 10px;">
                <a class="active" href="{{ route(auth()->user()->role) }}" style="text-decoration: none; color: #333;"><i class="sidebar-item-icon fa fa-th-large" style="margin-right: 10px;"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li style="margin-bottom: 10px;">
                <a class="" href="{{ route('banner.index') }}" style="text-decoration: none; color: #333;"><i class="sidebar-item-icon fa fa-image" style="margin-right: 10px;"></i>
                    <span class="nav-label">Banner Page</span>
                </a>
            </li>
            <li style="margin-bottom: 10px;">
                <a class="" href="{{ route('category.index') }}" style="text-decoration: none; color: #333;"><i class="sidebar-item-icon fa fa-sitemap" style="margin-right: 10px;"></i>
                    <span class="nav-label">Category Page</span>
                </a>
            </li>
            <li style="margin-bottom: 10px;">
                <a class="" href="{{ route('product.index') }}" style="text-decoration: none; color: #333;"><i class="sidebar-item-icon fa fa-shopping-bag" style="margin-right: 10px;"></i>
                    <span class="nav-label">Product Page</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('order.index') }}"  style="text-decoration: none; color: #333;"><i class="sidebar-item-icon fa fa-shopping-cart" style="margin-right: 10px;"></i>
                    <span class="nav-label">Order Page</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

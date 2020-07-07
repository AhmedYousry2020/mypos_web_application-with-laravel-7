<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">

            <li> <a href="{{route('dashboard.index')}}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>
           
            @if (auth()->user()->hasPermission('read_categories'))
            <li> <a href="{{route('dashboard.categories.index')}}"><i class="fa fa-cubes"></i><span>@lang('site.categories')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_products'))
            <li> <a href="{{route('dashboard.products.index')}}"><i class="fa fa-product-hunt"></i><span>@lang('site.products')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_users'))
            <li> <a href="{{route('dashboard.users.index')}}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_clients'))
            <li> <a href="{{route('dashboard.clients.index')}}"><i class="fa fa-user"></i><span>@lang('site.clients')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_orders'))
            <li> <a href="{{route('dashboard.orders.index')}}"><i class="fa fa-first-order"></i><span>@lang('site.orders')</span></a></li>
            @endif
        </ul>


    </section>

</aside>

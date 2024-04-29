<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo py-5">
        <a href="{{route('participation.index')}}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold"> <img src="{{asset('images/Logo.png')}}"
                                                                      class="img-fluid" width="120px"/></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item @if(request()->routeIs('users.index')) active @endif">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
                @php $count_users = \App\Models\User::count(); @endphp
                <div class="badge bg-custom-primary rounded-pill ms-auto">{{$count_users}}</div>
            </a>
        </li>


        <li class="menu-item @if(request()->routeIs('points.index')) active @endif">
            <a href="{{ route('points.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-star"></i>
                <div data-i18n="Points">Points</div>
            </a>
        </li>


        <li class="menu-item @if(request()->routeIs('order.index')) active @endif">
            <a href="{{ route('order.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="Orders">Orders</div>
            </a>
        </li>

        <hr>


        <li class="menu-item @if(request()->routeIs('codes.index')) active @endif">
            <a href="{{ route('codes.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-key"></i>
                <div data-i18n="Codes">Codes</div>
            </a>
        </li>


        <li class="menu-item @if(request()->routeIs('products.index')) active @endif">
            <a href="{{ route('products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-package"></i>
                <div data-i18n="Products">Products</div>
            </a>
        </li>


        <li class="menu-item @if(request()->routeIs('products.catalogue.index')) active @endif">
            <a href="{{ route('products.catalogue.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-book"></i>
                <div data-i18n="Catalogue">Catalogue</div>
            </a>
        </li>


        <hr>


        <li class="menu-item @if(request()->routeIs('export')) active @endif">
            <a href="{{ route('export') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-arrow-down"></i>
                <div data-i18n="Export">Export</div>
            </a>
        </li>

        <li class="menu-item @if(request()->routeIs('email.index')) active @endif">
            <a href="{{ route('email.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div data-i18n="Email">Email</div>
            </a>
        </li>

        <li class="menu-item @if(request()->routeIs('pages.index')) active @endif">
            <a href="{{ route('pages.index') }}" class="menu-link">
                <i class="menu-icon fas fa-file"></i>
                <div data-i18n="Pages">Pages</div>
            </a>
        </li>

        @role('super_admin')


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                <div data-i18n="Roles">Roles</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('admin.roles.index')) active @endif">
                    <a href="{{ route('admin.roles.index') }}" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('admin.permissions.index')) active @endif">
                    <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                        <div data-i18n="Permissions">Permissions</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('admin.users.index')) active @endif">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div data-i18n="Users">Users</div>
                    </a>
                </li>
            </ul>
        </li>
        @endrole

    </ul>
</aside>

<script>
    $(document).ready(function () {
        $('.menu-item').has('.menu-sub .menu-item.active').addClass('menu-open');
    });

</script>


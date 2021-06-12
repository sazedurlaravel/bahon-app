<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        {{-- <img src="#" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">
            <i class="fas fa-truck mr-2"></i>
            {{ config('app.name') }}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <x-nav-link :href="route('admin.home')" :active="request()->routeIs('admin.home')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> ড্যাশবোর্ড </p>
                    </x-nav-link>
                </li>
                <!-- <li class="nav-item">
                    <x-nav-link :href="route('admin.information.create')" :active="request()->routeIs('admin.information.create')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> main Page </p>
                    </x-nav-link>
                </li> -->
                {{-- Staff menu --}}
                @if(auth()->user()->hasRole('super_admin'))
                <li class="nav-item @if(request()->routeIs('admin.pourashava_admins.*')) menu-open @endif">
                        <x-nav-link href="#" :active="request()->routeIs('admin.pourashava_admins.*')">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                পৌরসভা অ্যাডমিন
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </x-nav-link>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-nav-link :href="route('admin.pourashava_admins.create')" :active="request()->routeIs('admin.pourashava_admins.create')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> নতুন অ্যাডমিন </p>
                                </x-nav-link>
                                <x-nav-link :href="route('admin.pourashava_admins.index')" :active="request()->routeIs('admin.pourashava_admins.index')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> অ্যাডমিনের তালিকা </p>
                                </x-nav-link>
                                <x-nav-link :href="route('admin.pourashava_admins.deactive')" :active="request()->routeIs('admin.pourashava_admins.deactive')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> ডিঅ্যাকটিভ তালিকা </p>
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @if(request()->routeIs('admin.pourashava_admin_wallets.*')) menu-open @endif">
                        <x-nav-link href="#" :active="request()->routeIs('admin.pourashava_admin_wallets.*')">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                <i class="fas fa-angle-left right"></i>
                                ই-ওয়ালেট
                            </p>
                        </x-nav-link>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-nav-link :href="route('admin.wallets.index')" :active="request()->routeIs('admin.wallets.index')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> ওয়ালেট রিকুয়েস্ট</p>
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item @if(request()->routeIs('admin.settings*')) menu-open @endif">
                        <x-nav-link href="#" :active="request()->routeIs('admin.settings*')">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                সেটিংস
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </x-nav-link>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-nav-link :href="route('admin.settings.divisions.index')" :active="request()->routeIs('admin.settings.divisions.*')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> বিভাগ </p>

                                </x-nav-link>
                            </li>


                            <li class="nav-item">
                                <x-nav-link :href="route('admin.settings.zilas.index')" :active="request()->routeIs('admin.settings.zilas.*')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> জেলা </p>
                                </x-nav-link>
                            </li>

                            <li class="nav-item">
                                <x-nav-link :href="route('admin.settings.pourashavas.index')" :active="request()->routeIs('admin.settings.pourashavas.*')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> পৌরসভা </p>
                                </x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link :href="route('admin.information.index')" :active="request()->routeIs('admin.information.index')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>তথ্য</p>
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Digital Center Admins --}}
                @if(auth()->user()->hasRole('pourashava_admin'))
                <li class="nav-item @if(request()->routeIs('admin.digital_center_admins.*')) menu-open @endif">
                    <x-nav-link href="#" :active="request()->routeIs('admin.digital_center_admins.*')">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            ডিজিটাল উদ্যোক্তা
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </x-nav-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-nav-link :href="route('admin.digital_center_admins.create')" :active="request()->routeIs('admin.digital_center_admins.create')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> নতুন ডিজিটাল উদ্যোক্তা </p>
                            </x-nav-link>

                            <x-nav-link :href="route('admin.digital_center_admins.index')" :active="request()->routeIs('admin.digital_center_admins.index')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ডিজিটাল উদ্যোক্তা তালিকা </p>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if(request()->routeIs('admin.pourashava_admin_wallets.*')) menu-open @endif">
                    <x-nav-link href="#" :active="request()->routeIs('admin.pourashava_admin_wallets.*')">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            <i class="fas fa-angle-left right"></i>
                            ই-ওয়ালেট
                        </p>
                    </x-nav-link>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            {{-- <x-nav-link :href="route('admin.pourashava_admin_wallets.create')" :active="request()->routeIs('admin.pourashava_admin_wallets.create')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> রিকুয়েস্ট এড মানি </p>
                            </x-nav-link> --}}

                            <x-nav-link :href="route('admin.pourashava_admin_wallets.index')" :active="request()->routeIs('admin.pourashava_admin_wallets.index')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>মাই ওয়ালেট</p>
                            </x-nav-link>
                        </li>

                        <li class="nav-item">
                            <x-nav-link :href="route('admin.pourashava_admin_wallets.get_request')" :active="request()->routeIs('admin.pourashava_admin_wallets.get_request')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ওয়ালেট রিকুয়েস্ট</p>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link href="{{route('admin.wallet.transaction')}}" active="">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ট্রাঞ্জেকশন হিস্টরি </p>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>


                <li class="nav-item @if(request()->routeIs('admin.settings*')) menu-open @endif">
                    <x-nav-link href="#" :active="request()->routeIs('admin.settings*')">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            সেটিংস
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </x-nav-link>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            
                            {{-- <x-nav-link :href="route('admin.settings.wardnumbers.index')" :active="request()->routeIs('admin.settings.wardnumbers.*')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ওয়ার্ড নাম্বার </p>
                            </x-nav-link>

                            <x-nav-link :href="route('admin.settings.villages.index')" :active="request()->routeIs('admin.settings.villages.*')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> গ্রাম </p>
                            </x-nav-link>

                            <x-nav-link :href="route('admin.settings.ownerships.index')" :active="request()->routeIs('admin.settings.ownerships.*')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ব্যবসার মালিকানার ধরণ </p>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.settings.business_types.index')" :active="request()->routeIs('admin.settings.business_types.*')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ব্যবসার ধরণ </p>
                            </x-nav-link>
                            
                            <x-nav-link :href="route('admin.settings.capital_ranges.index')" :active="request()->routeIs('admin.settings.capital_ranges.*')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ব্যবসার মূলধন পরিসর </p>
                            </x-nav-link> --}}

                            <x-nav-link :href="route('admin.settings.vehicle_types.index')" :active="request()->routeIs('admin.settings.vehicle_types.*')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> গাড়ীর ধরণ/শ্রেণী </p>
                            </x-nav-link>
                            <li class="nav-item">
                                <x-nav-link :href="route('admin.settings.pourashava_information.index')" :active="request()->routeIs('admin.information.index')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>তথ্য</p>
                                </x-nav-link>
                            </li>

                        </li>
                    </ul>
                </li>
                 @endif
            @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('pourashava_admin'))
            <li class="nav-item @if(request()->routeIs('admin.users.*')) menu-open @endif">
                <x-nav-link href="#" :active="request()->routeIs('admin.users.*')">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        সেবা ব্যবহারকারী
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </x-nav-link>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        @can('create_user')
                            <x-nav-link :href="route('admin.users.create')" :active="request()->routeIs('admin.users.create')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> নতুন ব্যবহারকারী </p>
                            </x-nav-link>
                        @endcan

                        @can('view_user')
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ব্যবহারকারীর তালিকা </p>
                            </x-nav-link>
                            <x-nav-link href="#" :active="request()->routeIs('admin.users.deactive')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> ডিঅ্যাকটিভ তালিকা </p>
                            </x-nav-link>
                        @endcan
                    </li>
                </ul>
            </li>
            @endif
                {{-- service users --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

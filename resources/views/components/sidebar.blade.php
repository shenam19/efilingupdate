<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand ">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/CTALogo.png') }}" alt="CTA e-filing"
            class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light" data-toggle="tooltip" data-placement="bottom" title="e-filing">གློག་རྡུལ་ཡིག་ཚགས།</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <ul class="nav nav-pills nav-sidebar flex-column user-panel" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item border-b">
                <a href="{{ url('user/profile') }}"  class="nav-link"
                data-toggle="tooltip" data-placement="bottom" title="My Profile">
                    <i class="nav-icon far fa-user align-middle"></i>
                </a>
            </li>
        </ul>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('compose') }}" class="nav-link {{ request()->routeIs('compose') ? 'active' : ''}}"
                    data-toggle="tooltip" data-placement="bottom" title="Compose">
                        <i class="nav-icon fas fa-edit align-middle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('inbox') }}" class="nav-link  {{ request()->routeIs('inbox') ? 'active' : ''}}"
                    data-toggle="tooltip" data-placement="bottom" title="Inbox">
                        <i class="fas fa-inbox nav-icon align-middle"></i>
                        @livewire('unread-count')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sent') }}" class="nav-link {{ request()->routeIs('sent') ? 'active' : ''}}"
                    data-toggle="tooltip" data-placement="bottom" title="Sent">
                        <i class="far fa-paper-plane nav-icon align-middle"></i>
    
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('draft') }}" class="nav-link {{ request()->routeIs('draft') ? 'active' : ''}}"
                    data-toggle="tooltip" data-placement="bottom" title="Draft">
                        <i class="far fa-file-alt nav-icon align-middle"></i>
                        <p class="text-lg">ཟིན་བྲིས།</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : ''}}"
                    data-toggle="tooltip" data-placement="bottom" title="Contact">                                                
                        <i class="far fa-address-card nav-icon align-middle"></i>                        
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>

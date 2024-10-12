
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-flex flex-wrap">
        
        <li class="nav-item  d-none d-sm-inline-block">
            <a id="dashboard" href="{{ route('dashboard') }}"
                class="nav-link {{request()->routeIs('dashboard') ? 'navActive' : ''}}" data-toggle="tooltip"
                data-placement="bottom" title="Dashboard">མདུན་འཆར།</a>
        </li>
        <li class="nav-item  d-none d-sm-inline-block">
            <a id="incoming" href="{{ route('record','incoming') }}"
                class="nav-link {{request()->is('records/incoming/*') || request()->is('records/incoming') ? 'navActive' : ''}}  "
                data-toggle="tooltip" data-placement="bottom" title="Incoming">ནང་འབྱོར།</a>
        </li>
        <li class="nav-item  d-none d-sm-inline-block">
            <a id="outgoing" href="{{ route('record','outgoing') }}"
                class="nav-link {{request()->is('records/outgoing/*') || request()->is('records/outgoing')? 'navActive' : ''}} "
                data-toggle="tooltip" data-placement="bottom" title="Outgoing">ཕྱིར་བཏང་།</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('folders.index')}}" class="nav-link
            {{request()->routeIs('folders.*') ? 'navActive' : ''}}" data-toggle="tooltip" data-placement="bottom"
                title="Folder">ཡིག་ཁུག།</a>
        </li>
        <li class="nav-item  d-none d-sm-inline-block">
            <a href="{{ route('media.index')}} " class="nav-link {{request()->routeIs('media.*') ? 'navActive' : ''}} "
                data-toggle="tooltip" data-placement="bottom" title="Media">ཡིག་པར།</a>
        </li>
        @can('manage account with staff role')
        <li class="nav-item  d-none d-sm-inline-block">
            <a id="manage-staff" href="{{ route('manage-staff.listMyStaff') }}"
                class="nav-link {{request()->routeIs('manage-staff.*') ? 'navActive' : ''}}  " data-toggle="tooltip"
                data-placement="bottom" title="Manage Staff">ལས་བྱེད་བཀོད་བྱུས།</a>
        </li>
        @endcan
        @can('manage sub organizations')
        <li class="nav-item  d-none d-sm-inline-block">
            <a id="manage-staff" href="{{ route('organization-structure.index') }}"
                class="nav-link {{request()->routeIs('organization-structure.*') ? 'navActive' : ''}} "
                data-toggle="tooltip" data-placement="bottom" title="Organization Structure">སྒྲིག་འཛུགས་ཀྱི་སྒྲོམ་གཞི།</a>
        </li>
        @endcan
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </form>
        </li>
    </ul>
</nav>
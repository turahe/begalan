<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/dashlite.css">
    <link id="skin-default" rel="stylesheet" href="/assets/css/theme.css">
</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar ">
<div class="nk-app-root">
    <div class="nk-apps-sidebar is-dark">
        <div class="nk-apps-brand">
            <a href="{{ route('admin.dashboard') }}" class="logo-link">
                <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo.png') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo.png') }}" alt="logo-dark">
            </a>
        </div>
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-body">
                <div class="nk-sidebar-content" data-simplebar>
                    <div class="nk-sidebar-menu">
                        <!-- Menu -->
                        <ul class="nk-menu apps-menu">
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.dashboard') }}" class="nk-menu-link" title="Analytics Dashboard">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/index-sales.html" class="nk-menu-link" title="Sales Dashboard">
                                    <span class="nk-menu-icon"><em class="icon ni ni-speed"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/index-crypto.html" class="nk-menu-link" title="Crypto Dashboard">
                                    <span class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/index-invest.html" class="nk-menu-link" title="Invest Dashboard">
                                    <span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-hr"></li>
                            <li class="nk-menu-item">
                                <a href="html/apps/mailbox.html" class="nk-menu-link" title="Mailbox">
                                    <span class="nk-menu-icon"><em class="icon ni ni-inbox"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/apps/messages.html" class="nk-menu-link" title="Messages">
                                    <span class="nk-menu-icon"><em class="icon ni ni-chat"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/apps/file-manager.html" class="nk-menu-link" title="File Manager">
                                    <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/apps/chats.html" class="nk-menu-link" title="Chats">
                                    <span class="nk-menu-icon"><em class="icon ni ni-chat-circle"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/apps/calendar.html" class="nk-menu-link" title="Calendar">
                                    <span class="nk-menu-icon"><em class="icon ni ni-calendar"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/apps/kanban.html" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-template"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-hr"></li>
                            <li class="nk-menu-item">
                                <a href="html/components.html" class="nk-menu-link" title="Go to Components">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nk-sidebar-footer">
                        <ul class="nk-menu nk-menu-md">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link" title="Settings">
                                    <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nk-sidebar-profile nk-sidebar-profile-fixed dropdown">
                    <a href="#" data-toggle="dropdown" data-offset="50,-60">
                        <div class="user-avatar">
                            {{ auth()->user()->avatar }}
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md ml-4">
                        <div class="dropdown-inner user-card-wrap d-none d-md-block">
                            <div class="user-card">
                                <div class="user-avatar">
                                    {{ auth()->user()->avatar }}
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{ auth()->user()->name }}</span>
                                    <span class="sub-text text-soft">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                                <em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-app-name">
                            <div class="nk-header-app-logo">
                                <em class="icon ni ni-dashlite bg-purple-dim"></em>
                            </div>
                            <div class="nk-header-app-info">
                                <span class="sub-text">DashLite</span>
                                <span class="lead-text">Dashboard</span>
                            </div>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown chats-dropdown hide-mb-xs">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                            <a href="#">Setting</a>
                                        </div>
                                        <div class="dropdown-body">
                                            <ul class="chat-list">
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <span>IH</span>
                                                            <span class="status dot dot-lg dot-gray"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Iliash Hossain</div>
                                                                <span class="time">Now</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: Please confrim if you got my last messages.</div>
                                                                <div class="status delivered">
                                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item is-unread">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar bg-pink">
                                                            {{ auth()->user()->avatar }}
                                                            <span class="status dot dot-lg dot-success"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">{{ auth()->user()->name }}</div>
                                                                <span class="time">4:49 AM</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>
                                                                <div class="status unread">
                                                                    <em class="icon ni ni-bullet-fill"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <img src="./images/avatar/b-sm.jpg" alt="">
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">George Philips</div>
                                                                <span class="time">6 Apr</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">Have you seens the claim from Rose?</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar user-avatar-multiple">
                                                            <div class="user-avatar">
                                                                <img src="./images/avatar/c-sm.jpg" alt="">
                                                            </div>
                                                            <div class="user-avatar">
                                                                {{ auth()->user()->avatar }}
                                                            </div>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Softnio Group</div>
                                                                <span class="time">27 Mar</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                <div class="status sent">
                                                                    <em class="icon ni ni-check-circle"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <img src="./images/avatar/a-sm.jpg" alt="">
                                                            <span class="status dot dot-lg dot-success"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Larry Hughes</div>
                                                                <span class="time">3 Apr</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">Hi Frank! How is you doing?</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar bg-purple">
                                                            <span>TW</span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Tammy Wilson</div>
                                                                <span class="time">27 Mar</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                <div class="status sent">
                                                                    <em class="icon ni ni-check-circle"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                            </ul><!-- .chat-list -->
                                        </div><!-- .nk-dropdown-body -->
                                        <div class="dropdown-foot center">
                                            <a href="html/chats.html">View All</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown notification-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Notifications</span>
                                            <a href="#">Mark All as Read</a>
                                        </div>
                                        <div class="dropdown-body">
                                            <div class="nk-notification">
                                                @foreach(Auth::user()->unreadNotifications as $notification)
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-primary-dim ni ni-share"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Iliash shared <span>Dashlite-v2</span> with you.</div>
                                                        <div class="nk-notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div><!-- .nk-notification -->
                                        </div><!-- .nk-dropdown-body -->
                                        <div class="dropdown-foot center">
                                            <a href="{{ route('notifications') }}">View All</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown list-apps-dropdown d-lg-none">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-na"><em class="icon ni ni-menu-circled"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <div class="dropdown-body">
                                            <ul class="list-apps">
                                                <li>
                                                    <a href="{{ route('admin.dashboard') }}">
                                                        <span class="list-apps-media"><em class="icon ni ni-dashlite bg-primary text-white"></em></span>
                                                        <span class="list-apps-title">Dashboard</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/chats.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-chat-circle bg-info-dim"></em></span>
                                                        <span class="list-apps-title">Chats</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/mailbox.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-inbox bg-purple-dim"></em></span>
                                                        <span class="list-apps-title">Mailbox</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/messages.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-chat bg-success-dim"></em></span>
                                                        <span class="list-apps-title">Messages</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/file-manager.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-folder bg-purple-dim"></em></span>
                                                        <span class="list-apps-title">File Manager</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/components.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-layers bg-secondary-dim"></em></span>
                                                        <span class="list-apps-title">Components</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="list-apps">
                                                <li>
                                                    <a href="/demo2/ecommerce/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-cart bg-danger-dim"></em></span>
                                                        <span class="list-apps-title">Ecommerce Panel</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/demo4/subscription/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-calendar-booking bg-primary-dim"></em></span>
                                                        <span class="list-apps-title">Subscription Panel</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/demo5/crypto/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-bitcoin-cash bg-warning-dim"></em></span>
                                                        <span class="list-apps-title">Crypto Wallet Panel</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/demo6/invest/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-invest bg-blue-dim"></em></span>
                                                        <span class="list-apps-title">HYIP Invest Panel</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- .nk-dropdown-body -->
                                    </div>
                                </li>
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ auth()->user()->name }}</span>
                                                    <span class="sub-text">{{ auth()->user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header @e -->
            @include('admin.partials.sidebarMenu')
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="/assets/js/bundle.js"></script>
<script src="/assets/js/scripts.js"></script>
</body>

</html>


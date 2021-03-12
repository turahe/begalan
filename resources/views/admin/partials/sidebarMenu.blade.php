<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-inner" data-simplebar>
        <ul class="nk-menu nk-menu-md">
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Dashboards</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('admin.dashboard') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                    <span class="nk-menu-text">Default Dashboard</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Contents</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                    <span class="nk-menu-text">Posts</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.pages.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Pages</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.posts.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Posts</span>
                        </a>
                    </li>
                </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
                <a href="{{ route('admin.categories.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                    <span class="nk-menu-text">Categories</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                    <span class="nk-menu-text">User Manage</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.users.index') }}" class="nk-menu-link"><span class="nk-menu-text">User List - Regular</span></a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link"><span class="nk-menu-text">User List - Compact</span></a>
                    </li>
                </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                    <span class="nk-menu-text">AML / KYCs</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="html/kyc-list-regular.html" class="nk-menu-link"><span class="nk-menu-text">KYC List - Regular</span></a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="html/kyc-details-regular.html" class="nk-menu-link"><span class="nk-menu-text">KYC Details - Regular</span></a>
                    </li>
                </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                    <span class="nk-menu-text">Transactions</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.payments.index') }}" class="nk-menu-link"><span class="nk-menu-text">Payments</span></a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.withdraws') }}" class="nk-menu-link"><span class="nk-menu-text">Withdraws</span></a>
                    </li>
                </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
        </ul><!-- .nk-menu -->
    </div>
</div>
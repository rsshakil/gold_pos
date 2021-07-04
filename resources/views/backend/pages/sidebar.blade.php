<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="<?php echo(\Config::get('app.url').'home');?>"
                style="line-height: 25px;">
                <div class="d-table m-auto">
                    <!-- <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25%;"
                        src="<?php echo(\Config::get('app.url'))?>public/backend/images/logo/jacos_logo.png"
                        alt="Jacos Dashboard"> -->
                        Poss software
                    <!-- <span class="d-none d-md-inline ml-1">{{__('messages.heading')}}</span> -->
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                aria-label="Search">
        </div>
    </form>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= (!empty($active) && $active=='dashboard')? 'active':'' ?>"
                    href="<?php echo(\Config::get('app.url').'home');?>">
                    <i class="material-icons">home</i>
                    <span>{{__('messages.dashboard_text')}}</span>
                </a>
            </li>
        @if(Auth::user()->outletid==0)
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'role');?>"
                    class="nav-link <?= (!empty($active) && $active=='role')? 'active':'' ?>">
                    <i class="material-icons">person</i>
                    <span>{{__('messages.role_management')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'permission');?>"
                    class="nav-link <?= (!empty($active) && $active=='permission')? 'active':'' ?>">
                    <i class="material-icons">account_balance</i>
                    <span>{{__('messages.permission_management')}} </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'assign_role_model');?>"
                    class="nav-link <?= (!empty($active) && $active=='assign_role_model')? 'active':'' ?>">
                    <i class="material-icons">all_inclusive</i>
                    <span>{{__('messages.assign_role_to_user')}}</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'assign_permission_model');?>"
                    class="nav-link <?= (!empty($active) && $active=='assign_permission_model')? 'active':'' ?>">
                    <i class="material-icons">enhanced_encryption</i>
                    <span>{{__('messages.assign_permission_to_user')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'user_list');?>"
                    class="nav-link <?= (!empty($active) && $active=='user_list')? 'active':'' ?>">
                    <i class="material-icons">person</i>
                    <span>{{__('messages.manage_users')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'csv_upload');?>"
                    class="nav-link <?= (!empty($active) && $active=='user_list')? 'active':'' ?>">
                    <i class="material-icons">person</i>
                    <span>Test Csv</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'outlets');?>"
                    class="nav-link <?= (!empty($active) && $active=='outlets')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Outlets</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'category_list');?>"
                    class="nav-link <?= (!empty($active) && $active=='category_list')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Category Manager</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'wholesale_purchase');?>"
                    class="nav-link <?= (!empty($active) && $active=='wholesale_purchase')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Wholesale Purchase</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'maker_item');?>"
                    class="nav-link <?= (!empty($active) && $active=='maker_item')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Maker Item</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'products');?>"
                    class="nav-link <?= (!empty($active) && $active=='products')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'sales');?>"
                    class="nav-link <?= (!empty($active) && $active=='sales')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Sales</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'exchange_product');?>"
                    class="nav-link <?= (!empty($active) && $active=='exchange_product')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Exchange Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'old_purchase');?>"
                    class="nav-link <?= (!empty($active) && $active=='old_purchase')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Old purchase</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'orders');?>"
                    class="nav-link <?= (!empty($active) && $active=='orders')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>orders</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'settings');?>"
                    class="nav-link <?= (!empty($active) && $active=='settings')? 'active':'' ?>">
                    <i class="material-icons">storefront</i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
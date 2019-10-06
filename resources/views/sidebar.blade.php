<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="{{ route('home') }}"><img src="{{ asset('resources/images/logo/materialize-logo-color.png') }}" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">E-Café</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>

    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            <li class="bold">
                <a class="waves-effect waves-cyan " href="{{route('home')}}"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="">{{ __('Welcome') }}</span><span class="badge badge pill orange float-right mr-10">0</span></a>
            </li>
             <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">label</i>
                <span class="menu-title" data-i18n="">{{ __('Categories') }}</span></a>
                
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="collapsible-body" href="{{route('all_categories')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{ __('All Categories') }}</span></a>
                        </li>
                        <li>
                            <a class="collapsible-body" href="{{route('add_category')}}" data-i18n="">
                            <i class="material-icons">radio_button_unchecked</i><span>{{ __('Add new Category') }}</span></a>
                        </li>
                    </ul>
                </div>
            </li>
       
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan "href="#"><i class="material-icons">shopping_cart</i>
                <span class="menu-title" data-i18n="">{{ __('Orders') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="collapsible-body" href="{{route('orders')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                            <span> {{ __('All Orders') }}</span></a>
                        </li>
                    </ul>
                </div>
        </li>   
            
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">local_shipping</i>
                <span class="menu-title" data-i18n="">{{ __('Stock') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li>
                                <a class="collapsible-body" href="{{route('stock')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                <span> {{ __('Main Stock') }}</span></a>
                            </li>
                            <li>
                                <a class="collapsible-body" href="{{route('items_index')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                <span> {{ __('Available Stock') }}</span></a>
                            </li>
                            <li>
                              <a class="collapsible-body" href="{{route('add_item')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{ __('Add  new Item') }}</span></a>
                            </li>
                               <li>
                              <a class="collapsible-body" href="{{route('packing-units.index')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{ __('Packing Units') }}</span></a>
                            </li>
                    </ul>
                </div>
        </li>

        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">card_giftcard</i>
                <span class="menu-title" data-i18n="">{{ __('All Coupons') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li>
                                <a class="collapsible-body" href="{{route('coupons')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                <span> {{ __('All Coupons') }}</span></a>
                            </li>
                            <li>
                              <a class="collapsible-body" href="{{route('add_coupon')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{ __('Add  New Coupon') }}</span></a>
                            </li>
                    </ul>
                </div>
        </li>
    </ul>    
</aside>

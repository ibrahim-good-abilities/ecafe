
<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">
                @yield('top-nav-content')
                <ul class="navbar-list right">
                @if(auth()->user() && auth()->user()->role->role_name == 'cashier')

                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="call-cashier"><i class="material-icons">call</i></span></a></li>
                @endif

                @if(auth()->user() && auth()->user()->role->role_name == 'parista')
                <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="call-parista"><i class="material-icons">call</i></span></a></li>
                @endif
                @if(auth()->user() && auth()->user()->role->role_name == 'captain')
                <li><a class="waves-effect waves-block waves-light" href="{{ route('captain') }} "><i class="material-icons" >add</i></span></a></li>

                <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="call-captain"><i class="material-icons">call</i></span></a></li>
                @endif

                    <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>


                    <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>

                    <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">{{$count}}</small></i></a></li>


                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><i class="material-icons">person</i></span></a></li>
                    <!-- <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li> -->



                </ul>
                <!-- notifications-dropdown-->
                <ul class="dropdown-content" id="notifications-dropdown">
                    <li>
                         <span class="new badge">{{$count}}</span>
                        <h6>NOTIFICATIONS</h6>

                    </li>
                    @foreach($notifications as $notification)
                    <li class="divider"></li>
                    <li><a class="grey-text text-darken-2" href="{{$notification->target}}"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> <span class="notification-title">{{$notification->title}}</span></a>
                        <!-- <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time> -->
                    </li>
                    @endforeach
                </ul>
                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    @if(auth()->user() && auth()->user()->role->role_name == 'admin')
                    <li><a class="grey-text text-darken-1" href="{{ route('settings') }}"><i class="material-icons">settings</i>{{__('Settings')}}</a></li>
                    @endif
                    <li><a class="grey-text text-darken-1" href="{{ route('logout') }}"><i class="material-icons">keyboard_tab</i>{{__('Logout')}}</a></li>
                </ul>
                 <!-- call-dropdown for cashier-->
                 <ul class="dropdown-content" id="call-cashier">
                   @if(auth()->user() && auth()->user()->role->role_name == 'cashier')

                    <li><a  class="grey-text text-darken-2"data-sender="{{__('cashier')}}" id="call_captain"><i class="material-icons">call</i>{{__('Captain')}}</a></li>
                    <li><a  class="grey-text text-darken-2"data-sender="{{__('cashier')}}" id="call_parista"><i class="material-icons">call</i>{{__('Parista')}}</a></li>
                   @endif
                </ul>
                <!-- call-dropdown for parista-->
                <ul class="dropdown-content" id="call-parista">
                   @if(auth()->user() && auth()->user()->role->role_name == 'parista')

                    <li><a  class="grey-text text-darken-2" id="call_captain" data-sender="{{__('parista')}}"><i class="material-icons">call</i>{{__('Captain')}}</a></li>
                    <li><a  class="grey-text text-darken-2" id="call_cashier" data-sender="{{__('parista')}}"><i class="material-icons">call</i>{{__('Cashier')}}</a></li>
                   @endif
                </ul>
                <!-- call-dropdown for captain-->
                <ul class="dropdown-content" id="call-captain">
                   @if(auth()->user() && auth()->user()->role->role_name == 'captain')

                    <li><a  class="grey-text text-darken-2"  id="call_parista" data-sender="{{__('captain')}}"><i class="material-icons">call</i>{{__('Parista')}}</a></li>
                    <li><a  class="grey-text text-darken-2" id="call_cashier" data-sender="{{__('captain')}}"><i class="material-icons">call</i>{{__('Cashier')}}</a></li>
                   @endif
                </ul>

            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form>
                        <div class="input-field">
                            <input class="search-box-sm" type="search" required="">
                            <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>

    <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('assets/images/icon/logo-white.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="{{asset('assets/images/icon/avatar-big-01.jpg')}}" alt="John Doe" />
                    </div>
                    <h4 class="name">{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}</h4>
                    <form action="{{route('logout')}}"> <button class="btn btn-primary" type="submit">Sign out</button></form>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{route('home')}}">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                </li>

                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-trophy"></i>SMS Template
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-trophy"></i>Email Template
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{route('email-template')}}">
                                        <i class="fas fa-table"></i>Add Template</a>
                                </li>
                                <li>
                                    <a href="form.html">
                                        <i class="far fa-check-square"></i>Template List</a>
                                </li>

                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-trophy"></i>Cadence
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{route('add.cadence')}}">
                                        <i class="fas fa-table"></i>Add Cadence</a>
                                </li>
                                <li>
                                    <a href="{{route('my.cadence')}}">
                                        <i class="far fa-check-square"></i>Cadence List</a>
                                </li>

                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-trophy"></i>Lead
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                 <li>
                                     <a href={{route('leads.create')}}>
                                         <i class="fas fa-table"></i>Add Lead</a>
                                 </li>
                                 <li>
                                     <a href={{route('leads.upload')}}>
                                         <i class="far fa-check-square"></i>Upload Leads</a>
                                 </li>
                                 <li>
                                     <a href={{route('leads.index')}}>
                                         <i class="far fa-calendar-alt"></i>Manage Leads</a>
                                 </li>
                            </ul>
                        </li>



                    </ul>
                </nav>
            </div>
        </aside>

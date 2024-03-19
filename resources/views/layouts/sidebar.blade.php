<nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">

                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">
                            <span class="menu-title"> <i class="mdi mdi-home menu-icon f2"></i> &nbsp; Dashboard</span>
                            <i class="mdi mdi-home menu-icon f1"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#ui-basics-masters" aria-expanded="false" aria-controls="ui-basics-masters">
                            <span class="menu-title"> <i class="mdi mdi-database f2"></i> &nbsp; Masters</span>
                            <i class="mdi mdi-database menu-icon f1"></i> <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basics-masters">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('users.master')}}">Create Users</a></li>
                                
                                <li class="nav-item"> <a class="nav-link" href="{{route('item.masters.list')}}">Item Master</a></li>

                                <li class="nav-item"> <a class="nav-link" href="{{route('itemgroup.masters.list')}}">Item Group</a></li>

                                <li class="nav-item"> <a class="nav-link" href="{{route('vendor.masters.list')}}">Vendor Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('location.master')}}">Location Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('employee.master')}}">Employee Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="amc-master.php">Po/ Amc master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="section.php">Section</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('district.master')}}">District</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('courts.master.list')}}">Courts</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('courts.complex.list')}}">CourtComplex</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#ui-basics-purchase" aria-expanded="false" aria-controls="ui-basics-purchase">
                            <span class="menu-title"> <i class="mdi mdi-database f2"></i> &nbsp; Purchase History</span>
                            <i class="mdi mdi-database menu-icon f1"></i> <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basics-purchase">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('items.index')}}">Item Entry</a></li>
                                <li class="nav-item"> <a class="nav-link" href="">Dispatch</a></li>
                                <li class="nav-item"> <a class="nav-link" href="">Return</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('inventory.request.list')}}">Inventory Request</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="store-receipt.php">
                            <span class="menu-title"> <i class="mdi mdi-receipt  menu-icon f2"></i> &nbsp; Store Receipt</span>

                            <i class="mdi mdi-receipt  menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="issue-form.php">
                            <span class="menu-title"> <i class="mdi mdi-file-document-box menu-icon f2"></i> &nbsp; Issue Form</span>

                            <i class="mdi mdi-file-document-box menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="return-form.php">
                            <span class="menu-title"> <i class="mdi mdi-file-multiple  menu-icon f2"></i> &nbsp; Return Form</span>

                            <i class="mdi mdi-file-multiple menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="menu-title"> <i class="mdi mdi-file-send  menu-icon f2"></i> &nbsp; By Back / Transfer Form</span>

                            <i class="mdi mdi-file-send  menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="menu-title"> <i class="mdi mdi-magnify  menu-icon f2"></i> &nbsp; Query</span>

                            <i class="mdi mdi-magnify menu-icon f1"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="menu-title"> <i class="mdi mdi-receipt  menu-icon f2"></i> &nbsp; Reports</span>
                            <i class="mdi mdi-receipt menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.password.change')}}">
                            <span class="menu-title"> <i class="mdi mdi-lock menu-icon f2"></i> &nbsp; Change Password</span>
                            <i class="mdi mdi-lock menu-icon f1"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <span class="menu-title"> <i class="mdi mdi-power menu-icon f2"></i> &nbsp; Logout</span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <i class="mdi mdi-power menu-icon f1"></i>
                        </a>
                    </li>
                </ul>
            </nav>
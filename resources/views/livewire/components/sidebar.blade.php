<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
            <!--begin::Brand Image--> <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Inventory
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('inventory.units.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Units</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.products.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Products</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.products-two') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Products Two</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.products-three') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Products Three</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.products-four') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Products Four</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.products-six') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Products Six</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('categories.units.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('array') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Array Task</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('practice') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Practice</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Purchase
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('purchase.supplier.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('purchase.suppliers-new') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers New</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('purchase.suppliers-two') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers Two</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('purchase.suppliers-three') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers Three</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('purchase.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Purchase</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./layout/layout-custom-area.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Layout <small>+ Custom Area </small></p>
                            </a> </li>
                        <li class="nav-item"> <a href="./layout/sidebar-mini.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Sidebar Mini</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./layout/collapsed-sidebar.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Sidebar Mini <small>+ Collapsed</small></p>
                            </a> </li>
                        <li class="nav-item"> <a href="./layout/logo-switch.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Sidebar Mini <small>+ Logo Switch</small></p>
                            </a> </li>
                        <li class="nav-item"> <a href="./layout/layout-rtl.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Layout RTL</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="{{ route('pos') }}" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>POS</p>
                    </a></li>



            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
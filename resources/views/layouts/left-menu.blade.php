<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li
                    class="sidebar-item {{ checkRouteActive(['categories.index', 'categories.edit']) ? 'selected ' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{ route('categories.index') }}"
                        aria-expanded="false">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="hide-menu">
                            Category
                        </span></a>
                </li>
                <li class="sidebar-item {{ checkRouteActive(['products.index', 'products.edit']) ? 'selected' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{ route('products.index') }}"
                        aria-expanded="false">
                        <i class="fas fa-box    "></i>
                        <span class="hide-menu">
                            Fruit
                        </span></a>
                </li>
                <li
                    class="sidebar-item {{ checkRouteActive(['orders.index', 'orders.edit', 'orders.show']) ? 'selected' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{ route('orders.index') }}"
                        aria-expanded="false">
                        <i class="fas fa-money-bill-alt    "></i>
                        <span class="hide-menu">
                            Order
                        </span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<aside class="left-sidebar" data-sidebarbg="skin5">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
          <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link {{ checkUrlActive([route('categories.index'), route('categories.edit')]) ? 'selected' : '' }}"
                      href="{{ route('categories.index') }}" aria-expanded="false">
                      <i class="fa fa-bars" aria-hidden="true"></i>
                      <span class="hide-menu">
                          Category
                      </span></a>
              </li>
              <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link {{ checkUrlActive([route('products.index'), route('products.edit')]) ? 'selected' : '' }}"
                      href="{{ route('products.index') }}" aria-expanded="false">
                      <i class="fas fa-box    "></i>
                      <span class="hide-menu">
                          Product
                      </span></a>
              </li>
              {{-- <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link {{ checkUrlActive(route('admin-index-product')) }}"
                      href="{{ route('admin-index-product') }}" aria-expanded="false"><i
                          class="mdi mdi-chart-bar"></i><span class="hide-menu">Sản
                          phẩm</span></a>
              </li>
              <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link {{ checkUrlActive(route('admin-index-contact')) }}"
                      href="{{ route('admin-index-contact') }}" aria-expanded="false">
                     <i class="fa fa-id-card" aria-hidden="true"></i>  <span class="hide-menu">Liên hệ</span></a>
              </li>
              <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link {{ checkUrlActive(route('admin-index-banner')) }}"
                      href="{{ route('admin-index-banner') }}" aria-expanded="false"><i
                          class="fas fa-image    "></i><span class="hide-menu">Banner</span></a>
              </li>
              <li class="sidebar-item">
                  <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                      aria-expanded="false">
                      <i class="fa fa-cog" aria-hidden="true"></i>
                      <span class="hide-menu">Cấu hình </span></a>
                  <ul aria-expanded="false" class="collapse first-level">
                      <li class="sidebar-item">
                          <a href="{{ route('admin-edit-config', ['type' => 'website']) }}" class="sidebar-link"><i
                                  class="mdi mdi-emoticon"></i><span class="hide-menu"> Website </span></a>
                      </li>
                      <li class="sidebar-item">
                          <a href="{{ route('admin-edit-config', ['type' => 'introduce']) }}" class="sidebar-link"><i
                                  class="mdi mdi-emoticon"></i><span class="hide-menu"> Giới thiệu </span></a>
                      </li>
                      <li class="sidebar-item">
                          <a href="{{ route('admin-edit-config', ['type' => 'footer']) }}" class="sidebar-link"><i
                                  class="mdi mdi-emoticon"></i><span class="hide-menu"> Footer </span></a>
                      </li>

                  </ul>
              </li> --}}
          </ul>
      </nav>
      <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>

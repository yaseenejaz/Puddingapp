<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('dashboard')}}" class="brand-link">
      <img src="{{asset('public/assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PUDDING Co</span>
    </a>

    {{$id = (request('id')) ? request('id') : '' }}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('public/assets/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!-- <a href="#" class="d-block">Admin</a> -->
          <a href="{{route('admin-profile')}}" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <li class="nav-item {{(request()->is('add-zipcodes')) || (request()->is('zipcodes')) || (request()->is('edit-zipcode/'.$id)) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{(request()->is('add-zipcodes')) || (request()->is('zipcodes')) || (request()->is('edit-zipcode/'.$id)) ? 'active' : '' }}">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                Zipcodes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('addzipcodes')}}" class="nav-link {{(request()->is('add-zipcodes')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Zip Code</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('viewZipcodes')}}" class="nav-link {{(request()->is('zipcodes')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Zipcodes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{(request()->is('add-slider')) || (request()->is('sliders')) || (request()->is('edit/slide/'.$id)) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{(request()->is('add-slider')) || (request()->is('sliders')) || (request()->is('edit/slide/'.$id)) ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('add-slider')}}" class="nav-link {{(request()->is('add-slider')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Slide</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('sliders')}}" class="nav-link {{(request()->is('sliders')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Slider</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{(request()->is('add-product')) || (request()->is('products')) || (request()->is('edit-product/'.request('id'))) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{(request()->is('add-product')) || (request()->is('products')) || (request()->is('edit-product/'.request('id'))) ? 'active' : ''}}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="{{route('add-product')}}" class="nav-link {{request()->is('add-product') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('products')}}" class="nav-link {{request()->is('products') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{(request()->is('add-favourites')) || (request()->is('favourite-products')) || (request()->is('edit-favourite-product/'.request('id'))) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{(request()->is('add-favourites')) || (request()->is('favourite-products')) || (request()->is('edit-favourite-product/'.request('id'))) ? 'active' : '' }}">
              <i class="nav-icon far fa-bookmark"></i>
              
              <p>
                Favourite Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="{{route('add-favourites')}}" class="nav-link {{(request()->is('add-favourites')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Favourite</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('favourites')}}" class="nav-link {{(request()->is('favourite-products')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Favourites</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    
  </aside>

  @push('js')
  <script>
  /* $(document).ready(function(){
    
    $('.nav-link').on('click', function(){
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
    })
  }) */
  </script>
  @endpush
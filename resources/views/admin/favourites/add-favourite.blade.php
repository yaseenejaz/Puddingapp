@extends('layouts.admin-default')

@push('css')
<style>
input#favProd {
    width: 25px;
    height: 25px;
    margin-left: 10px !important;
}
</style>
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Favourite Products Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                          <div class="card card-primary">
              <div class="card-header">
              @if(!$product)
              <h3 class="card-title">Add Favourite Product</h3>  
              @else
              <h3 class="card-title">Edit Favourite Product</h3>  

              @endif
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!$product)
               <form action="{{route('store-favourite')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="productname">Product Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="productname" placeholder="Product Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="productUrl">Product URL</label>
                    <input type="text" name="producturl" class="form-control @error('producturl') is-invalid @enderror" value="{{old('producturl')}}" id="productUrl" placeholder="Product Url">
                    @error('producturl')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="zipcode">Product Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input image @error('image') is-invalid @enderror" name="image" id="productImage">
                            <label class="custom-file-label image-label" for="productImage">Product Image</label>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="favouriteimage">
                          
                        </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
              @else
               <form action="{{route('update-favourite', ['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="productname">Product Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}" id="productname" placeholder="Product Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="productUrl">Product URL</label>
                    <input type="text" name="producturl" class="form-control @error('producturl') is-invalid @enderror" value="{{$product->product_url}}" id="productUrl" placeholder="Product Url">
                    @error('producturl')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="zipcode">Product Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input image @error('image') is-invalid @enderror" name="image" id="productImage">
                            <label class="custom-file-label image-label" for="productImage">{{$product->product_image}}</label>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="favouriteimage">
                            <img src="{{asset('public/uploads/favourite-products').'/'.$product->product_image}}" height="150" />
                        </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
              @endif
              
            </div>
                </div>
            </div>
            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
@endsection

@push('js')

<script src="{{asset('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script>
$("#productImage").on("change", function() {
  var fileName = $(this).val().split("\\").pop();

  $(this).siblings(".image-label").addClass("selected").html(fileName);
});

</script>

@endpush
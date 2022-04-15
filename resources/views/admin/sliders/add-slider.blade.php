@extends('layouts.admin-default')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sliders Page</h1>
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
              @if(!$slider)
                <h3 class="card-title">Add Slide</h3>
              @else
                <h3 class="card-title">Edit Slide</h3>
              @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!$slider)
              <form action="{{route('store-slider')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="zipcodeName">Slide Name</label>
                    <input type="text" name="slidename" class="form-control @error('slidename') is-invalid @enderror" value="{{old('slidename')}}" id="zipcodeName" placeholder="Slide Name">
                    @error('slidename')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="zipcodeName">Slide Text</label>
                    <input type="text" name="slidetext" class="form-control @error('slidetext') is-invalid @enderror" value="{{old('slidename')}}" id="zipcodeName" placeholder="Slide Text">
                    @error('slidetext')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="zipcode">Slide Background Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input bg-image @error('bgimage') is-invalid @enderror" name="bgimage" id="bgimage">
                            <label class="custom-file-label bg-image-label" for="bgimage">Choose file</label>
                            @error('bgimage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                  </div>
                  <div class="form-group">
                    <label for="zipcodeUrl">Front Slider Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input front-image @error('frontimage') is-invalid @enderror" value="{{old('frontimage')}}" name="frontimage" id="frontimage">
                            <label class="custom-file-label front-image-label" for="frontimage">Choose file</label>
                            @error('frontimage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>              
              @else
              <form action="{{route('update-slide', ['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="zipcodeName">Slide Name</label>
                    <input type="text" name="slidename" class="form-control @error('slidename') is-invalid @enderror" value="{{$slider->name}}" id="zipcodeName" placeholder="Slide Name">
                    @error('slidename')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="zipcodeName">Slide Text</label>
                    <input type="text" name="slidetext" class="form-control @error('slidetext') is-invalid @enderror" value="{{$slider->slide_text}}" id="zipcodeName" placeholder="Slide Text">
                    @error('slidetext')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="zipcode">Slide Background Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input bg-image @error('bgimage') is-invalid @enderror" name="bgimage" id="bgimage">
                            <label class="custom-file-label bg-image-label" for="bgimage">{{$slider->bg_image}}</label>
                            @error('bgimage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="bgimage">
                          <img src="{{asset('public/uploads/sliders/bg').'/'.$slider->bg_image}}" width="150" />
                        </div>
                  </div>
                  <div class="form-group">
                    <label for="zipcodeUrl">Front Slider Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input front-image @error('frontimage') is-invalid @enderror" value="{{old('frontimage')}}" name="frontimage" id="frontimage">
                            <label class="custom-file-label front-image-label" for="frontimage">{{$slider->front_image}}</label>
                            @error('frontimage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="frontimage">
                          <img src="{{asset('public/uploads/sliders/front').'/'.$slider->front_image}}" width="150" />
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
$(".bg-image").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".bg-image-label").addClass("selected").html(fileName);
});

$(".front-image").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".front-image-label").addClass("selected").html(fileName);
});
</script>

@endpush
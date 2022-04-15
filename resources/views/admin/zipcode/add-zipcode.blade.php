@extends('layouts.admin-default')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Zipcode Page</h1>
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
              @if(!$zipcode)
                <h3 class="card-title">Add Zipcode</h3>
              @else
                <h3 class="card-title">Edit Zipcode</h3>
              @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              @if(!$zipcode)
              <form action="{{route('saveZipcodes')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="zipcodeName">Zipcode Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="zipcodeName" placeholder="Zipcode name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" value="{{old('zipcode')}}" id="zipcode" placeholder="Zipcode">
                    @error('zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="zipcodeUrl">Zipcode URL</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{old('url')}}" id="zipcodeUrl" placeholder="Zipcode">
                    @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>

              @else
              <form action="{{route('updateZipcode', ['id'=>$zipcode->id])}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="zipcodeName">Zipcode Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$zipcode->name}}" id="zipcodeName" placeholder="Zipcode name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" value="{{$zipcode->zipcode}}" id="zipcode" placeholder="Zipcode">
                    @error('zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="zipcodeUrl">Zipcode URL</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{$zipcode->url}}" id="zipcodeUrl" placeholder="Zipcode">
                    @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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

@endpush
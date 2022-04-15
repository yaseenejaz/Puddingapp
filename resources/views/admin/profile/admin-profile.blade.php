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
            <h1 class="m-0">Admin Profile</h1>
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
            <div class="col-md-8">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$admin->name}}</h3>
                <h5 class="widget-user-desc">{{$admin->user_post}}</h5>
              </div>
              <div class="widget-user-image">
              @if(!$admin->image)
                <img class="img-circle elevation-2" src="{{asset('public/assets/dist/img/avatar5.png')}}" alt="User Avatar">
              @else
                <img class="img-circle elevation-2" src="{{asset('public/uploads/admin-avatar').'/'.$admin->image}}" alt="User Avatar">
              @endif
              </div>
              <div class="card-footer">
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>    
                  <strong>{{ $message }}</strong>
              </div>
              @endif
                
              @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>    
                  <strong>{{ $message }}</strong>
              </div>
              @endif

                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>  
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form class="pro" action="{{route('update-user', ['id'=>$admin->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="card-body">
                  <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$admin->name}}" id="name" placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                   <div class="form-group">
                    <label for="userpost">User Post</label>
                    <input type="text" name="userpost" class="form-control @error('userpost') is-invalid @enderror" value="{{$admin->user_post}}" id="userpost" placeholder="Founder & CEO">
                    @error('userpost')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$admin->email}}" id="email" placeholder="E-Mail Address">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="avatar">User Avatar</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input image @error('image') is-invalid @enderror" name="image" id="avatar">
                          <label class="custom-file-label avatar-label" for="avatar">User Image{{old('image')}}</label>
                          @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                  </div>
                  <!-- <div class="passwords" style="display:block;">
                    <div class="form-group">
                    <label for="cpass">Current Password</label>
                    <input type="password" name="cpass" class="form-control" id="cpass" placeholder="Current Password">
                  </div>

                  <div class="form-group">
                    <label for="npass">New Password</label>
                    <input type="password" name="npass" class="form-control" id="npass" placeholder="New Password">
                  </div>

                  <div class="form-group">
                    <label for="cnpass">Confirm New Password</label>
                    <input type="password" name="cnpass" class="form-control" id="cnpass" placeholder="Confirm New Password">
                  </div>
                  </div> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save Profile</button>
                  <a href="#cp" class="btn btn-primary passwords float-right">Change Password <i class="fas fa-arrow-right"></i></a>
                </div>
              </form>

              <form action="{{route('update-passwords', ['id'=>$admin->id])}}" class="pass" method="post" style="display:none;">
              @csrf
              <div class="card-body">
                <div class="passwords" style="display:block;">
                    <div class="form-group">
                    <label for="cpass">Old Password</label>
                    <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" id="cpass" placeholder="Old Password">
                    @error('oldpassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="npass">New Password</label>
                    <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" id="npass" placeholder="New Password">
                    @error('newpassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="cnpass">Confirm New Password</label>
                    <input type="password" name="confirmpassword" class="form-control @error('confirmpassword') is-invalid @enderror" id="cnpass" placeholder="Confirm New Password">
                    @error('confirmpassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  </div>
                </div>
              

              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save Password</button>
                  <a href="#ep" class="btn btn-primary profile  float-right"><i class="fas fa-arrow-left"></i> Edit Profile</a>
                </div>
              </form>
              </div>
                            
            </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>  
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
$(document).ready(function(){

  var x = localStorage.getItem('tabbed');
  console.log(x);
  /* var x = window.location.hash;*/
  
  if(x == 'pro'){
    $('.pass').hide();
    $('.pro').show();
  }

  if(x == 'pass'){
    $('.pass').show();
    $('.pro').hide();
  } 

  $('.passwords').on('click', function(){
    localStorage.setItem('tabbed', 'pass');
    $('.pass').show();
    $('.pro').hide();
  })

  $('.profile').on('click', function(){
    localStorage.setItem('tabbed', 'pro');
    $('.pass').hide();
    $('.pro').show();
  });
});
$("#avatar").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".avatar-label").addClass("selected").html(fileName);
});

</script>

@endpush
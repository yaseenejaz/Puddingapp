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
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex flex-row  col-xl-12 justify-content-between mb-5">
                <h3>ZipCodes({{count($zipcodes)}})</h3>
                    <a href="{{route('addzipcodes')}}" class="btn btn-xl btn-primary">Add Zipcodes</a>
                </div>
                @csrf
                    <table id="zipscodes" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Zipcode</th>
                            <th>URL</th>
                            <td>EDIT</td>
                            <td>DELETE</td>
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($zipcodes as $zipcode)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$zipcode->name}}</td>
                            <td>{{$zipcode->zipcode}}</td>
                            <td>{{$zipcode->url}}</td>
                            <td><a href="{{route('editZipcode',[ 'id' => $zipcode->id])}}" class="btn btn-block btn-primary">EDIT</a></td>
                            <td><button type="submit" class="btn btn-block del btn-danger btn-primary" value="{{$zipcode->id}}" title="Delete Trainee" >
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></td>
                        </tr>
                        @endforeach
                        </tbody>
                        
                    </table>
            
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
<script src="{{asset('public/assets/plugins/toast-master/js/jquery.toast.js')}}"> </script>

<script>
  $(document).ready( function () {
   $("#zipscodes").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    })


   $(document).on('click', '.del', function(){
      var btn = $(this);
      var response = confirm('Confirm delete '+$(this).val());
      var id = $(this).val();
      var _token = $('input[type=hidden]').val();
      if(response == true){
        
        $.ajax({
                url:        "{{route('ajax.zipcode.del.req')}}",
                type:       'POST',
                data:       {_token:_token, 'delete_id':id},
                success:    function(data){
                     if(data == 1){
                        $(btn).closest('tr').fadeOut(1000);
                        setTimeout(function(){
                            $(btn).closest('tr').remove();
                            toastMsg('Success', 'Data Deleted', 'success');
                        }, 1500);
                        
                      }else{
                        toastMsg('Failed', 'Fail to delete', 'error');
                      }
                }

        });
      }
      
    });
});

function toastMsg(msgHeading, msgText, iconType){
        $.toast({
                heading: msgHeading,
                position: 'top-center',
                text: msgText,
                loaderBg: '#ff6849',
                icon: iconType,
                hideAfter: 3000,
                stack: 6
            });
}
</script>
@endpush
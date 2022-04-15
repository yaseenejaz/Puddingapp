@extends('layouts.admin-default')
@push('css')

@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol> -->
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
                <h3>Products</h3>
                    <a href="{{route('add-product')}}" class="btn btn-xl btn-primary">Add Product</a>
                </div>
                @csrf
                    <table id="zipscodes" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Product Image</th>
                            <th>Product URL</th>
                            <!-- <th>Favourite</th> -->
                            <th>EDIT</th>
                            <th>DELETE</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($products as $product)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$product->name}}</td>
                            <td style="text-align:center;">{{$product->price}}</td>
                            <td style="text-align:center;"><img src="{{asset('public/uploads/product-images').'/'.$product->image}}" height="50" /></td>
                            <td>{{$product->product_url}}</td>
                            <!-- <td style="text-align:center;">
                            @if(!$product->is_favourite)
                            <i class="far fa-times-circle" style="margin-top:16px;"></i>
                            @else
                            <i class="far fa-check-circle" style="margin-top:16px;"></i>
                            @endif </td> -->
                            <td><a href="{{route('edit-product', ['id'=>$product->id])}}" class="btn btn-block btn-primary">EDIT</a></td>
                            <td><button type="submit" class="btn btn-danger btn-primary" value="{{$product->id}}" title="Delete Trainee" >
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

    $('.btn-danger').on('click', function(){
      var btn = $(this);
      var response = confirm('Confirm delete '+$(this).val());
      var id = $(this).val();
      var _token = $('input[type=hidden]').val();
      if(response == true){
        $.ajax({
                url:        "{{route('ajax.product.del.req')}}",
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
@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            <h2 class="float-left">Sponsors</h2>
              <a href="{{route('sponsors.create')}}" class="btn btn-info float-right">Add Sponsor</a>
            </div> 
         
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th></th>
                  <th>Fullname</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Mobile</th>
                  <th>Balance</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sponsors as $sponsor)
                <tr>
                <td>@if($sponsor->Time > 2)
                  <span class="fa fa-flag" title="It has been more than 2 months since the last payment" style="color:red; cursor:pointer"></span>
                  @endif
                  </td>
                  <td>{{$sponsor->Fullname}}</td>
                  <td>{{$sponsor->Address}}</td>
                  <td>{{$sponsor->Email}}</td>
                  <td>{{$sponsor->Phone}}</td>
                  <td>{{$sponsor->Mobile}}</td>
                  <td><a href="{{ route('accounts.show', ['sponsor'=>$sponsor->Fullname,  $sponsor->id]) }}" class="btn btn-info btn-sm m-2">@if($sponsor->balance=='') {{0}} @else {{$sponsor->balance}} @endif USD</td>
                 <td><a href="{{ route('sponsors.edit', $sponsor->id) }}" class="btn btn-info btn-sm m-2"><span class="fas fa-edit"></span></a><button onclick="Delete({{ $sponsor->id}})" class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></button></td>
                </tr>
                @endforeach
               
                </tbody>
                
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
      <!-- Modal content-->
      <form action="" method="POST" id="deleteForm">
      @csrf
      @method('DELETE')
     
    </form>
  
    <script>
     $(function () {
      $("#example1").DataTable({
        dom: 'Bfrtip',
      
      lengthMenu: [
        [10, 25, 50, 100, -1],
        ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
      ],
      buttons: [
        'pageLength', 'pdfHtml5', 'csvHtml5', 'copyHtml5', 'excelHtml5', 'print'
      ]
      });
   
     });
     function Delete(id){
  
  var form=document.getElementById('deleteForm');
  form.action='/sponsors/'+id
  Swal.fire({
    position: 'top',
    title: 'Are you sure you want to delete this sponsor ?',
    text: "Once deleted, you will not be able to recover this information!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $('#deleteForm').submit();
    }
  })
 
       }
    </script>
    @endsection 
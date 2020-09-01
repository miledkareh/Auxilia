@extends('layouts.welcome')

@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            <h2 class="float-left">Employees</h2>
              <a href="{{route('users.create')}}" class="btn btn-info float-right">Add Employee</a>
            </div> 
         
            <div class="card-body">
        
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr >
                  <th>Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Account</th>
                  <th>Salary</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr >
                  <td>
                  <img src="{{ asset('storage/'.$user->image)}}" width="70px" height="60px" alt="">
                  
                  </td>
                  <td>{{$user->name}}</td>
                 
                  <td>{{$user->email}}</td>
                  <td><a href="{{ route('useraccounts.show', ['user'=>$user->name,  $user->id]) }}" class="btn btn-info btn-sm m-2">Account ({{$user->cnt}})</td>
                  <td><a href="{{ route('salarybreakdowns.show', ['user'=>$user->name,  $user->id]) }}" class="btn btn-info btn-sm m-2">@if($user->salary>0){{$user->salary}} @else {{0}} @endif</td>
                 <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm m-2"><span class="fas fa-edit"></span></a><button onclick="Delete({{ $user->id}})" class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></button></td>
                </tr>
                @endforeach
               
                </tbody>
                
              </table>
           
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
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
form.action='/users/'+id
Swal.fire({
  position: 'top',
  title: 'Are You Sure You Want To Delete This User ?',
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
// swal({
//    position: 'top',
//   title: "Are You Sure You Want To Delete This User !",
//   text: "Once deleted, you will not be able to recover this information!",
//   type: 'warning',
//   showCancelButton: true,
//   cancelButtonColor: '#d33',
//   dangerMode: true,
// })
// .then((willDelete) => {
//   if (willDelete) {
   
//   } else {
  
//   }
// });
     }
    </script>
    @endsection
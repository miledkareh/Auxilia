@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            <h2 class="float-left">{{ $_GET['user'] }} - Account</h2>
              <a href="{{route('useraccounts.create',['id'=>$user_id])}}"  class="btn btn-info float-right disabled" >Add Invoice</a>
            </div> 
         
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Date</th>
                  <th>Ref #</th>
                  <th>Notes</th>
                  <th>Total Amount</th>
                  <th>Currency</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($useraccounts as $useraccount)
                <tr>
                  <td>{{Carbon\Carbon::parse($useraccount->Dat)->format('Y-m-d')}}</td>
                  <td>{{$useraccount->Ref}}</td>
                  <td>{{$useraccount->Notes}}</td>
                  <td>{{$useraccount->Debit}}</td>
                  <td>{{ $useraccount->symbol }}</td>
                 
                 <td><a disabled href="{{ route('useraccounts.edit',['id'=>$user_id,  $useraccount->id] ) }}" class="btn btn-info btn-sm m-2"><span class="fas fa-edit"></span></a><button onclick="Delete({{ $useraccount->id}})" class="btn btn-danger btn-sm" disabled><span class="fas fa-trash"></span></button></td>
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
  form.action='/useraccounts/'+id+'/'+{{$user_id}}
  Swal.fire({
    position: 'top',
    title: 'Are you sure you want to delete this donation ?',
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
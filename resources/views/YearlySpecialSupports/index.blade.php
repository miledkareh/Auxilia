@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            <h2 class="float-left">Yearly Special Support</h2>
              <a href="{{route('YearlySpecialSupports.create')}}" class="btn btn-info float-right">Add</a>
            </div> 
         
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Year</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($YearlySpecialSupports as $YearlySpecialSupport)
                <tr>
                  <td>{{$YearlySpecialSupport->Yearr}}</td>
                  <td>{{$YearlySpecialSupport->Amount}}</td>
                 
                 <td><a href="{{ route('YearlySpecialSupports.edit', $YearlySpecialSupport->id) }}" class="btn btn-info btn-sm m-2"><span class="fas fa-edit"></span></a><button onclick="Delete({{ $YearlySpecialSupport->id}})" class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></button></td>
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
  form.action='/YearlySpecialSupports/'+id
  Swal.fire({
    position: 'top',
    title: 'Are you sure you want to delete this record ?',
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
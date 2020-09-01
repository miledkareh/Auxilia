@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
     
        <div class="col-12">
         
          <!-- /.card -->
         
          <div class="card">
            <div class="card-header">
           
            <h2 class="float-left">@if(isset($sponsor)) {{$sponsor[0]['Fullname']}} @else {{ $_GET['sponsor'] }} @endif - Donations</h2>
              <a href="{{route('accounts.create',['id'=>$sponsor_id])}}" class="btn btn-info float-right">Add Donation</a>
            </div> 
         
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Date</th>
                  <th>Ref #</th>
                  <th>Notes</th>
                  <th>Type</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Currency</th>
                  <th>Balance USD</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $balance=0; ?>
                @foreach($accounts as $account)
               
                <tr>
                  <td>{{Carbon\Carbon::parse($account->Dat)->format('Y-m-d')}}</td>
                  <td>{{$account->Ref}}</td>
                  <td>{{$account->Type}}</td>
                  <td>{{$account->Notes}}</td>
                  <td>{{$account->Debit}}</td>
                  <td>{{$account->Credit}}</td>
                  <td>{{$account->symbol}}</td>
                  <td> {{ $balance+=(($account->cDebit)-($account->cCredit))}} </td>
                 
                 
                 <td>
                  <div class="dropdown">
                    <a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h text-muted"></i>
                    </a>                        
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center">
                    <a href="{{ route('accounts.report', $account->id) }}" target="_blank" class="btn btn-primary btn-sm m-1"><span class="fas fa-print"></span></a>
                    <a href="{{ route('accounts.edit',['id'=>$sponsor_id,  $account->id] ) }}" class="btn btn-info btn-sm m-1"><span class="fas fa-edit"></span></a>
                    <button onclick="Delete({{ $account->id}})" class="btn btn-danger btn-sm m-1"><span class="fas fa-trash"></span></button>
                    <a href="{{ route('accounts.attachments', $account->id) }}" class="btn btn-info btn-sm m-2">Attachments</a>
                      
                    </div>
                  </div>
                </td>
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
      ],
      "aaSorting": [],
      });
   
     });
     function Delete(id){
  
  var form=document.getElementById('deleteForm');
  form.action='/accounts/'+id+'/'+{{$sponsor_id}}
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
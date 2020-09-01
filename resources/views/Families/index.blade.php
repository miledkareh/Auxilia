@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            <h2 class="float-left">Families</h2>
              <a href="{{route('families.create')}}" class="btn btn-info float-right">Add Family</a>
            </div> 
         
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Family Name</th>
                  <th>Mother Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Mobile</th>
                  <th>Region</th>
                  <th>Social Helper</th>
                
                  <th>Action</th>
            
                </tr>
                </thead>
                <tbody>
                @foreach($families as $family)
                <tr>
                <td>{{$family->FamilyName}}</td>
                  <td>{{$family->MotherName}}</td>
                  <td>{{$family->Address}}</td>
                  <td>{{$family->Email}}</td>
                  <td>{{$family->Phone}}</td>
                  <td>{{$family->Mobile}}</td>
                  <td>{{$family->Region}}</td>
                  <td>{{$family->name}}</td>
                 
                <td>
                  <div class="dropdown">
                    <a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h text-muted"></i>
                    </a>                        
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center">
                   
                    <a href="{{ route('families.report', $family->id) }}" target="_blank"   data-toggle="tooltip" title="Info" style="width:80%" class="btn btn-icon btn-outline-primary btn-sm m-1-1 mb-1" data-original-title="Print"><i class="fa fa-print"></i> Print file</a>
                    <a href="{{ url('families/account/'.$family->id) }}" data-id="'+id+'"  data-toggle="tooltip" title="Info" style="width:80%" class="btn btn-icon btn-outline-success btn-sm m-1-1 mb-1" data-original-title="Account"><i class="fa fa-home"></i> Account</a>
                    <a href="{{ url('families/details/'.$family->id) }}" data-id="'+id+'"  data-toggle="tooltip" title="Info" style="width:80%" class="btn btn-icon btn-outline-success btn-sm m-1-1 mb-1" data-original-title="Income/Outcome"><i class="fa fa-exchange-alt"></i> Income/Outcome</a>
                    <a href="{{ url('families/declaration/'.$family->id) }}" data-id="'+id+'"  data-toggle="tooltip" title="Info" style="width:80%" class="btn btn-icon btn-outline-success btn-sm m-1-1 mb-1" data-original-title="Changement"><i class="fa fa-exchange-alt"></i> Chagement Declaration</a>
                        <a href="{{ route('mothersinfo.show',  $family->id) }}" data-id="'+id+'"  data-toggle="tooltip" title="Info" style="width:80%" class="btn btn-icon btn-outline-warning btn-sm m-1-1 mb-1" data-original-title="Info"><i class="fa fa-list"></i> Mother Info</a>

                        <a href="{{ route('families.edit', $family->id) }}"  data-id="'+id+'" data-toggle="tooltip" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 " data-original-title="edit"><i class="fa fa-edit"></i> Edit</a>
            
                        <button type="button" onclick="Delete({{ $family->id}})" data-id="'+id+'"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 " data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>
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
      ]
      });
   
     });
     function Delete(id){
  
  var form=document.getElementById('deleteForm');
  form.action='/families/'+id
  Swal.fire({
    position: 'top',
    title: 'Are you sure you want to delete this family ?',
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
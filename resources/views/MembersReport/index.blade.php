@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
     
        <div class="col-12">
         
          <!-- /.card -->
         
          <div class="card">
            <div class="card-header">
           
           
            <form action="{{  route('membersreport.filter')}}" method="POST">
            @csrf
            <div class="row">
            <div class="col-md-12">
            <h2 class="float-left">Members Report</h2>
            </div>
            </div>
            <div class="row">
           

            <div class="col-md-2">
              <label>Status</label><select class='form-control' name='status'  >
     <option value="0" <?php if(isset($_POST['status']) && $_POST['status']==0) echo"selected"; ?> >All</option>
              @foreach($statuss as $status)
                 <option value="{{$status->status}}" <?php if(isset($_POST['status']) && $_POST['status']==$status->status) echo"selected"; ?>>{{$status->status}}</option>
              @endforeach

            </select>
            </div>
            <div class="col-md-2">
              <label>Family</label><select class='form-control' name='family'  >
      <option value="0" <?php if(isset($_POST['family']) && $_POST['family']==0) echo"selected"; ?>>All</option>
              @foreach($families as $family)
                 <option value="{{$family->id}}"  <?php if(isset($_POST['family']) && $_POST['family']==$family->id) echo"selected"; ?> >{{$family->FamilyName}}</option>
              @endforeach

            </select>
            </div>
            <div class="col-md-2">
              <label>Profession</label><select class='form-control' name='profession'  >
      <option value="0" <?php if(isset($_POST['profession']) && $_POST['profession']==0) echo"selected"; ?>>All</option>
             
                 <option value="School" <?php if(isset($_POST['profession']) && $_POST['profession']=='School') echo"selected"; ?>>School</option>
                 <option value="Work" <?php if(isset($_POST['profession']) && $_POST['profession']=='Work') echo"selected"; ?>>Work</option>
                 <option value="Other" <?php if(isset($_POST['profession']) && $_POST['profession']=='Other') echo"selected"; ?>>Other</option>
     

            </select>
     
            </div>
            <div class="col-md-2">
              <label>School</label><select class='form-control' name='school'  >
      <option value="0" <?php if(isset($_POST['school']) && $_POST['school']==0) echo"selected"; ?>>All</option>
              @foreach($schools as $school)
                 <option value="{{$school->school}}"  <?php if(isset($_POST['school']) && $_POST['school']==$school->school) echo"selected"; ?> >{{$school->school}}</option>
              @endforeach

            </select>
            </div>
            <div class="col-md-2">
            <br>
            <button class="btn btn-info" type="submit"><span class="fa fa-search"> Search</button>
            </div>
            </div>
            </form>
            
            </div> 
         
            <div class="card-body">
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                
               
                <th>Member</th>
                <th>Family</th>
                <th>Status</th>
                <th>Profession</th>
                <th>Description</th>
                  <th>Donations</th>
                </tr>
                </thead>
                <tbody>
                <?php $total=0; ?>
                @foreach($members as $member)
               <?php $total+=$member->sumAmount; ?>
                <tr>
                 
                  <td>{{$member->Name}}</td>
                  <td>{{$member->FamilyName}}</td>
                  <td>{{$member->Status}}</td>
                  <td>{{$member->Profession}}</td>
                  <td>{{$member->Description}}</td>
                 
                  <td> {{ $member->sumAmount}} </td>
                 
                 
                 
                </tr>
                @endforeach
               
                </tbody>
                <tfooter>
                <tr>
                <th colspan='5' >Totals</th>
                
                <th>{{$total}}</th>
                
                </tfooter>
              </table>
              <br>
             
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
   
    </script>
    @endsection 
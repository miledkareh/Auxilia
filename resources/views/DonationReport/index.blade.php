@extends('layouts.welcome')
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
     
        <div class="col-12">
         
          <!-- /.card -->
         
          <div class="card">
            <div class="card-header">
           
           
            <form action="{{  route('donationreport.filter')}}" method="POST">
            @csrf
            <div class="row">
            <div class="col-md-12">
            <h2 class="float-left">Donation Report</h2>
            </div>
            </div>
            <div class="row">
            <div class="col-md-2">
<label>From Date</label><input type="date" class='form-control' name='fromdate' value="{{ isset($_POST['fromdate'])  ? (($_POST['fromdate']!='') ? Carbon\Carbon::parse($_POST['fromdate'])->format('Y-m-d') : '') :  date('Y-m-d', strtotime('-2 months')) }}" />
     
            </div>
            <div class="col-md-2">
              <label>To Date</label><input type="date" class='form-control' name='todate' value="{{ isset($_POST['todate'])  ? (($_POST['todate']!='') ? Carbon\Carbon::parse($_POST['todate'])->format('Y-m-d') : '') : date('Y-m-d') }}" />
     
            </div>
            <div class="col-md-2">
              <label>Sponsor</label><select class='form-control' name='sponsor'  >
     <option value="0" <?php if(isset($_POST['sponsor']) && $_POST['sponsor']==0) echo"selected"; ?> >All</option>
              @foreach($sponsors as $sponsor)
                 <option value="{{$sponsor->id}}" <?php if(isset($_POST['sponsor']) && $_POST['sponsor']==$sponsor->id) echo"selected"; ?>>{{$sponsor->Fullname}}</option>
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
              <label>Type</label><select class='form-control' name='type'  >
      <option value="0" <?php if(isset($_POST['type']) && $_POST['type']==0) echo"selected"; ?>>All</option>
             
                 <option value="Allocation" <?php if(isset($_POST['type']) && $_POST['type']=='Allocation') echo"selected"; ?>>Allocation</option>
                 <option value="Medicale" <?php if(isset($_POST['type']) && $_POST['type']=='Medicale') echo"selected"; ?>>Medicale</option>
                 <option value="Scolaire" <?php if(isset($_POST['type']) && $_POST['type']=='Scolaire') echo"selected"; ?>>Scolaire</option>
                 <option value="Divers" <?php if(isset($_POST['type']) && $_POST['type']==='Divers') echo"selected"; ?>>Divers</option>

            </select>
     
            </div>
            <div class="col-md-2">
              <label>Region</label><select class='form-control' name='region'  >
      <option value="0" <?php if(isset($_POST['region']) && $_POST['region']==0) echo"selected"; ?>>All</option>
              @foreach($regions as $region)
                 <option value="{{$region->Name}}"  <?php if(isset($_POST['region']) && $_POST['region']==$region->Name) echo"selected"; ?> >{{$region->Name}}</option>
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
                <th>Date</th>
                <th>Sponsor</th>
                <th>Member</th>
                <th>Family</th>
                <th>Region</th>
                <th>Type</th>
                  <th>Notes</th>
                  <th>Amount</th>
                
                  <th>Currency</th>
                  <th>Amount USD</th>
                 
                </tr>
                </thead>
                <tbody>
                <?php $total=0; ?>
                @foreach($accountreports as $accountreport)
               <?php $total+=$accountreport->cAmount; ?>
                <tr>
                  <td>{{Carbon\Carbon::parse($accountreport->Date)->format('Y-m-d')}}</td>
                  <td>{{$accountreport->sponsor}}</td>
                  <td>{{$accountreport->familymember}}</td>
                  <td>{{$accountreport->family}}</td>
                  <td>{{$accountreport->region}}</td>
                  <td>{{$accountreport->Type}}</td>
                  <td>{{$accountreport->Notes}}</td>
                  <td>{{$accountreport->Amount}}</td>
                  <td>{{$accountreport->symbol}}</td>
                  <td> {{ $accountreport->cAmount}} </td>
                 
                 
                 
                </tr>
                @endforeach
               
                </tbody>
                <tfooter>
                <tr>
                <th colspan='8'>Totals</th>
                
                <th>{{$total}}</th>
                <th></th>
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
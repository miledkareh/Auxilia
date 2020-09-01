@extends('layouts.welcome')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    @if(isset($family))
            
          <input type="hidden" name="family_id" value="{{ $family[0]['id'] }}" />
          @else
          <input type="hidden" name="family_id" value="0" />
            @endif
    
    <section class="content m-2" <?php if(!isset($family)) echo "style='display:none'";?>>
    
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           {{$family[0]['FamilyName']}} - Changement Declarations
            </h2>
             
            </div> 
         
            <div class="card-body">
            <div class="row" style="display:none">
            <div class="col-md-12 float-right ">
                  <button class="btn btn-info btn-md float-right m-2 " data-toggle="modal" data-target="#myModal" id="Add" >Add Member</button>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-12 mb-4">
                       
                       <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                           <table class="table table-bordered" id="changementtable">
                               <thead class="thead-light">
                                   <tr>
                                      
                                           <th class="text-left border-right-0 border-bottom-0">Declaration</th>
                                       

                                      
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Date</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Type</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Remarks</th>
                                           
                                           <th class="text-center border-right-0 border-bottom-0">Action</th>
                                      
                                   </tr>
                               </thead>
                               <tbody id="changement-rows">
                       
                           
                             @foreach($declarations as $declaration)
                                      <tr>
                                          <td align='center'>
          <select type='text'  id='changement_{{$declaration->id}}'  class='form-control' >
            @foreach($changementdata as $changement)
            <option value="{{$changement->id}}"
              @if($changement->id===$declaration->changement_id)
              selected
              @endif
               >{{$changement->Name}}</option>
            @endforeach
          </select>
         </td>
         
         
          
          <td align='center'><input class='form-control' type='date' id='date_{{$declaration->id}}' value="{{ isset($declaration) && $declaration->Date!=null ? Carbon\Carbon::parse($declaration->Date)->format('Y-m-d') : old('Date') }}"/></td> 
          <td align='center'>
            <select class='form-control' id='type_{{$declaration->id}}'  >
           
             
                @if($declaration->Type === 'Changement Declaration')
                 <option value="Changement Declaration" selected>Changement Declaration</option>
                 <option value="Other" >Other</option>
                 @else
                 <option value="Changement Declaration" >Changement Declaration</option>
                 <option value="Other" selected>Other</option>
                 @endif
         

            </select>
            </td>
            <td align='center'><textarea class='form-control' type='text' id='remarks_{{$declaration->id}}' >{{$declaration->Remarks}}</textarea></td> 
          <td class="text-center border-right-0 border-bottom-0">
           <div class="dropdown ">
          <a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-ellipsis-h text-muted"></i>
          </a>                      
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center" >
         
          <button type="button"  data-id="{{$declaration->id}}" data-toggle="tooltip" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 UpdateChangement" data-original-title="edit"><i class="fa fa-edit"></i> Update</button>
            
            <button type="button" data-id="{{$declaration->id}}"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 DeleteChangement" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>
              </div>
              </div>
         
         
         </td>
         
          </tr>
                                      @endforeach
                               </tbody>
                               <tfooter>
                               <tr>
         <td align='center'>
          <select type='text'  id='Changement'  class='form-control' >
          <option value="0"></option>
            @foreach($changementdata as $changement)
            <option value="{{$changement->id}}">{{$changement->Name}}</option>
            @endforeach
          </select>
         </td>
         
         
          
          <td align='center'><input class='form-control' type='date' id='Date'/></td> 
          <td align='center'>
            <select class='form-control' id='Type'  >
            <option value=""></option>
                 <option value="Changement Declaration">Changement Declaration</option>
                 <option value="Other" >Other</option>

            </select>
            </td>
            <td align='center'><textarea class='form-control' type='text' id='Remarks' ></textarea></td> 
         
         
          

          <td class="text-center border-right-0 border-bottom-0">
          <button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddChangement" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>
         </td>
          </tr>
                               </tfooter>
                           </table>
                       </div>
                   </div>
                   </div>
            <!-- /.card-body -->
            </div>
          <!-- /.card -->
          </div>
        <!-- /.col -->
      </div>
    

    
      <!-- /.row -->
    </section>

   
  <script>
    $(document).ready(function(){
  
  setTimeout(() => {
    $("div.alert").remove();
  }, 1000);
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //  fetchRecords();
     // fetchRecords1();

      //======================= Add Member ===============================
      $(document).on("click", ".AddChangement" , function() {
    
        
      $.ajax({
        url: '/addChangement',
        type: "GET",
        data: {'family_id':$('input[name=family_id]').val(),'Type':$('#Type').val(),'changement_id':$('#Changement').val(),'Remarks':$('#Remarks').val(),'Date':$('#Date').val(), '_token':CSRF_TOKEN},
        dataType: 'JSON',
        success: function (data) {
          Swal.fire({

  icon: 'success',
  title: 'Added Successfully !',
  showConfirmButton: false,
  timer: 1500
});
setTimeout(() => {
  location.reload();
}, 1000);
        //  fetchRecords();
          // this is good
        }
      });

      });

//========================= Add Member In House ==================================
$(document).on("click", ".AddCharge" , function() {
  
        
    $.ajax({
      url: '/addDetail',
      type: "GET",
      data: {'family_id':$('input[name=family_id]').val(),'Type':2,'Name':$('#Name1').val(),'Member':$('#Member1').val(),'Currency':$('#Currency1').val(),'Amount':$('#Amount1').val(),'Period':$('#Period1').val(), '_token':CSRF_TOKEN},
      dataType: 'JSON',
      success: function (data) {
        Swal.fire({

icon: 'success',
title: 'Added Successfully !',
showConfirmButton: false,
timer: 1500
});
setTimeout(() => {
  location.reload();
}, 1000);
        //fetchRecords1();
        // this is good
      }
    });

    });
      //=========================Delete Member ================================
      $(document).on("click", ".DeleteChangement" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteChangement/'+ID,
    type: 'get',
    success: function(response){
      $(el).closest( "tr" ).remove();
      Swal.fire({
  
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
    }
  });
});
//========================== Delete Member in house ===========================
$(document).on("click", ".DeleteCharge" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteDetail/'+ID,
    type: 'get',
    success: function(response){
      $(el).closest( "tr" ).remove();
      Swal.fire({
 
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
    }
  });
});
      //============= Update Member ======================
      $(document).on("click", ".UpdateChangement" , function() {
  var ID = $(this).data('id');
  var el = this;
  var changement_id = $('#changement_'+ID).val();

var remarks = $('#remarks_'+ID).val();
var date = $('#date_'+ID).val();
var type = $('#type_'+ID).val();

  alert(type);
  if(changement_id != '' && changement_id != 0){
  
    $.ajax({
      url: '/updateChangement',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'Type': type,'id': ID,'changement_id': changement_id,'Remarks': remarks,'Date': date},
     
      success: function(response){
        Swal.fire({
  
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
      }
    });
  }else{
    alert('Fill all fields');
  }

 
});

//========================== Update Memember In House ======================================
$(document).on("click", ".UpdateCharge" , function() {
  var ID = $(this).data('id');
  var el = this;
 var name = $('#name_'+ID).val();

  var member = $('#member_'+ID).val();
  var currency = $('#currency_'+ID).val();
  var amount = $('#amount_'+ID).val();
  var period = $('#period_'+ID).val();
  
  if(name != '' && name != 0){
  
    $.ajax({
      url: '/updateDetail',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'Type': 2,'id': ID,'Name': name,'Member': member,'Currency': currency,'Amount': amount,'Period': period},
     
      success: function(response){
        Swal.fire({
 
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
      }
    });
  }else{
    alert('Fill all fields');
  }

 
});
//========== fetsh Members ==============================








  });
  function fetchRecords(){
    
  $.ajax({
    url: '/getDetails',
    type: 'GET',
    data: {'action':1,'id':$('input[name=family_id]').val()},
    dataType: 'JSON',
   
    success: function(response){

      var len = 0;
      $('#membertable tbody tr:not(:first)').empty();
       // Empty <tbody>
       $('#member-rows').empty();
      if(response['data'] != null){
    
        len = response['data'].length;
      
      }
      var tr_str="";
      if(len > 0){
        for(var i=0; i<len; i++){

          var id = response['data'][i].id;
          var Name = response['data'][i].Name;
          var DOB = response['data'][i].DateOfBirth;
         
          var Status = response['data'][i].Status;
          var Profession = response['data'][i].Profession;
          var Description = response['data'][i].Description;

          tr_str += "<tr>" +
          "<td align='center'><input type='text' id='name_"+id+"' value='"+Name+"' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='dob_"+id+"' value='"+DOB.split(' ')[0]+"' /></td>" + 
          "<td align='center'><input class='form-control' type='text' id='status_"+id+"' value='"+Status+"' /></td>"; 
if(Profession=='School'){
tr_str += "<td align='center'>"+
"<select class='form-control'  id='profession_"+id+"'>"+
"<option value='School' selected>School</option>"+
"<option value='Work'>Work</option></select></td>";
}
else{
tr_str += "<td align='center'>"+
"<select class='form-control' id='profession_"+id+"'>"+
"<option value='School' >School</option>"+
"<option value='Work' selected>Work</option></select></td>";
}
tr_str += "<td align='center'><input class='form-control' type='text' id='description_"+id+"' value='"+Description+"'/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          ' <div class="dropdown ">'+
          '<a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '<i class="fa fa-ellipsis-h text-muted"></i>'+
          '</a>'+                           
          '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center" >'+
         
          '<a href="/familymembers/'+id+'/edit" data-id="'+id+'"  data-toggle="tooltip" style="width:80%" title="Info" class="btn btn-icon btn-outline-warning btn-sm m-1-1 mb-1" data-original-title="Info"><i class="fa fa-list"></i> Member Info</a>'+
         // '<div class="dropdown-divider"></div>'+

          '<button type="button"  data-id="'+id+'" data-toggle="tooltip" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 UpdateResource " data-original-title="edit"><i class="fa fa-edit"></i> Update</button>'+
            
            '<button type="button" data-id="'+id+'"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 DeleteResource" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>'+
              '</div>'+
              '</div>'+
         
         
         '</td>' +
          '</tr>';

        

        }
       
        $("#member-rows").append(tr_str);
         
      }else{
      
        tr_str = "<tr class='norecord'>" +
        "<td align='center' colspan='6'>No record found.</td>" +
        "</tr>";

        $("#member-rows").append(tr_str);
      }

    }
  });
}



  </script>
@endsection

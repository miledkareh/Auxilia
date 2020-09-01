@extends('layouts.welcome')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content m-3">
    <div class="row">
        <div class="col-8">
        </div>
        <div class="col-4">
            @if(session()->has('success'))
                <div class="alert alert-success">
                {{ session()->get('success')}}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           {{$familymember->Name}}  - Information
            </h2>
             
            </div> 
         
            <div class="card-body">
          
                  <div class="row">
                  <div class="col-sm-12 mb-4">
                  <input type="hidden" name="family_id" value="{{ $familymember->family_id }}" />
                       <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                           <table class="table table-bordered" id="membertable">
                               <thead class="thead-light">
                                   <tr>
                                      
                                           <th class="text-left border-right-0 border-bottom-0">Handicap</th>
                                       

                                      
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Description</th>

                                           <th class="text-center border-right-0 border-bottom-0">Action</th>
                                      
                                   </tr>
                               </thead>
                               <tbody id="member-rows">
                                      
                               </tbody>
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
    
      </form>
    </section>

    <section class="content m-3">
  
    <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           {{$familymember->Name}}  - Academic Results
            </h2>
             
            </div> 
         
            <div class="card-body">
          
                  <div class="row">
                  <div class="col-sm-12 mb-4">
              
                       <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                           <table class="table table-bordered" id="academictable">
                               <thead class="thead-light">
                                   <tr>
                                      
                                           <th class="text-left border-right-0 border-bottom-0">Actual</th>
                                           <th class="text-left border-right-0 border-bottom-0">New</th>
                                           <th class="text-left border-right-0 border-bottom-0">Average</th>
                                      
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Remarks</th>

                                           <th class="text-center border-right-0 border-bottom-0">Action</th>
                                      
                                   </tr>
                               </thead>
                               <tbody id="academic-rows">
                                      
                               </tbody>
                               <tfooter>
                              <tr>
          <td align='center'><input type='text'  id='Actual' value='' class='form-control' /></td>

          <td align='center'><input class='form-control' type='text' id='New' value=''/></td>
          <td align='center'><input class='form-control' type='text' id='Average' value=''/></td>
          <td align='center'><input class='form-control' type='text' id='Remarks' value=''/></td>
          <td class="text-center border-right-0 border-bottom-0">
          <button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddAcademic" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>
         </td>
          </tr>
                               </tfooter>
                        
                           </table>
                       </div>
                   </div>
                   </div>
                   <div class="form-group ">
                
  
                   <a href="{{ route('families.edit', $familymember->family_id) }}" class="btn btn-danger float-right ">Cancel</a>
                  
                   </div>
            <!-- /.card-body -->
            </div>
          <!-- /.card -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
      </form>
    </section>
   <script>
  
   
    $(document).ready(function(){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      setTimeout(() => {
    $("div.alert").remove();
  }, 1000);
      fetchRecords();
      fetchAcademic();
      $(document).on("click", ".AddMember" , function() {
    
        
    $.ajax({
      url: '/addMemberInfo',
      type: "GET",
      data: {'familymember_id':$('input[name=family_id]').val(),'Handicap':$('#Handicap').val(),'Description':$('#Description').val(), '_token':CSRF_TOKEN},
      dataType: 'JSON',
      success: function (data) {
        Swal.fire({
position: 'top-end',
icon: 'success',
title: 'Added Successfully !',
showConfirmButton: false,
timer: 1500
})
        fetchRecords();
        $('#Handicap').val('');
        $('#Description').val('');
        // this is good
      }
    });

    });

    $(document).on("click", ".UpdateMember" , function() {
  var ID = $(this).data('id');
  var el = this;
 var handicap = $('#handicap_'+ID).val();

  var description = $('#description_'+ID).val();

  
  if(handicap != '' ){
  
    $.ajax({
      url: '/updateMemberInfo',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'id': ID,'Handicap': handicap,'Description': description},
     
      success: function(response){
        Swal.fire({
  position: 'top-end',
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

$(document).on("click", ".DeleteMember" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteMemberInfo/'+ID,
    type: 'get',
    success: function(response){
      $(el).closest( "tr" ).remove();
      Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
    }
  });
});

$(document).on("click", ".AddAcademic" , function() {
    
        
    $.ajax({
      url: '/addAcademicInfo',
      type: "GET",
      data: {'familymember_id':$('input[name=family_id]').val(),'Actual':$('#Actual').val(),'New':$('#New').val(),'Average':$('#Average').val(),'Remarks':$('#Remarks').val(), '_token':CSRF_TOKEN},
      dataType: 'JSON',
      success: function (data) {
        Swal.fire({
position: 'top-end',
icon: 'success',
title: 'Added Successfully !',
showConfirmButton: false,
timer: 1500
})
$('#Actual').val('');
$('#New').val('');
$('#Average').val('');
$('#Remarks').val('');
        fetchAcademic();
        // this is good
      }
    });

    });

    $(document).on("click", ".UpdateAcademic" , function() {
  var ID = $(this).data('id');
  var el = this;
 var actual = $('#actual_'+ID).val();

  var new1 = $('#new_'+ID).val();
  var average = $('#average_'+ID).val();
  var remarks = $('#remarks_'+ID).val();

  
  if(actual != '' ){
  
    $.ajax({
      url: '/updateAcademicInfo',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'id': ID,'Actual': actual,'New': new1,'Average': average,'Remarks': remarks},
     
      success: function(response){
        Swal.fire({
  position: 'top-end',
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

$(document).on("click", ".DeleteAcademic" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteAcademicInfo/'+ID,
    type: 'get',
    success: function(response){
      $(el).closest( "tr" ).remove();
      Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
    }
  });
});

    });
     function fetchRecords(){
     
  $.ajax({
    url: '/getmemberInfo',
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

      if(len > 0){
        for(var i=0; i<len; i++){

          var id = response['data'][i].id;
          var Handicap = response['data'][i].Handicap;
          var Description = response['data'][i].Description;
    

          var tr_str = "<tr>" +
          "<td align='center'><input type='text' id='handicap_"+id+"' value='"+Handicap+"' class='form-control' /></td>" ;

tr_str += "<td align='center'><input class='form-control' type='text' id='description_"+id+"' value='"+Description+"'/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
        

          '<button type="button"  data-id="'+id+'" data-toggle="tooltip" title="Edit" class="btn btn-icon btn-outline-info btn-sm m-1 UpdateMember " data-original-title="edit"><i class="fa fa-edit"></i> Update</button>'+
           
            '<button type="button" data-id="'+id+'"  data-toggle="tooltip" title="Delete" class="btn btn-icon btn-outline-danger btn-sm m-1 DeleteMember" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>'+
            
           
         
         
         '</td>' +
          '</tr>';

          $("#membertable tbody").append(tr_str);

        }
        var tr_str = "<tr>" +
          "<td align='center'><input type='text'  id='Handicap' value='' class='form-control' /></td>" +
        
          "<td align='center'><input class='form-control' type='text' id='Description' value=''/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          '<button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddMember" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>'+
         '</td>' +
          '</tr>';
          $("#membertable tbody").append(tr_str);
      }else{
        var tr_str = "<tr>" +
          "<td align='center'><input type='text'  id='Handicap' value='' class='form-control' /></td>" +

          "<td align='center'><input class='form-control' type='text' id='Description' value=''/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          '<button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddMember" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>'+
         '</td>' +
          '</tr>';
        tr_str += "<tr class='norecord'>" +
        "<td align='center' colspan='6'>No record found.</td>" +
        "</tr>";

        $("#membertable tbody").append(tr_str);
      }

    }
  });
}

function fetchAcademic(){
     
     $.ajax({
       url: '/getacademicInfo',
       type: 'GET',
       data: {'action':1,'id':$('input[name=family_id]').val()},
       dataType: 'JSON',
      
       success: function(response){
   
         var len = 0;
       
          // Empty <tbody>
          $('#academic-rows').empty();
         if(response['data'] != null){
       
           len = response['data'].length;
         
         }
   
         if(len > 0){
           for(var i=0; i<len; i++){
   
             var id = response['data'][i].id;
             var Actual = response['data'][i].Actual;
             var New = response['data'][i].New;
             var Average = response['data'][i].Average;
             var Remarks = response['data'][i].Remarks;
   
             var tr_str = "<tr>" +
             "<td align='center'><input type='text' id='actual_"+id+"' value='"+Actual+"' class='form-control' /></td>" ;
   
   tr_str += "<td align='center'><input class='form-control' type='text' id='new_"+id+"' value='"+New+"'/></td>" + 
   "<td align='center'><input class='form-control' type='text' id='average_"+id+"' value='"+Average+"'/></td>" + 
   "<td align='center'><input class='form-control' type='text' id='remarks_"+id+"' value='"+Remarks+"'/></td>" + 
             '<td class="text-center border-right-0 border-bottom-0">' +
           
   
             '<button type="button"  data-id="'+id+'" data-toggle="tooltip" title="Edit" class="btn btn-icon btn-outline-info btn-sm m-1 UpdateAcademic" data-original-title="edit"><i class="fa fa-edit"></i> Update</button>'+
              
               '<button type="button" data-id="'+id+'"  data-toggle="tooltip" title="Delete" class="btn btn-icon btn-outline-danger btn-sm m-1 DeleteAcademic" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>'+
               
              
            
            
            '</td>' +
             '</tr>';
   
             $("#academic-rows").append(tr_str);
   
           }
          
         }else{
          
           tr_str += "<tr class='norecord'>" +
           "<td align='center' colspan='5'>No record found.</td>" +
           "</tr>";
   
           $("#academic-rows").append(tr_str);
         }
   
       }
     });
   }
   </script>

@endsection

@extends('layouts.welcome')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    <section class="content m-2">
   
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
            {{isset($family) ? 'Edit Family' : 'Create Family'}}
            </h2>
             
            </div> 
         
            <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                   <li class="list-group-item text-danger">
                    {{$error}}
                   </li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($family) ? route('families.update', $family->id) : route('families.store')}}" method="POST">
            @csrf

            @if(isset($family))
            @method('PUT')

          <input type="hidden" name="family_id" value="{{ $family->id }}" />
          @else
          <input type="hidden" name="family_id" value="0" />
            @endif
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="Ref">Ref#</label>
                  <input type="text" class="form-control"  name="Ref" id="Ref" value="{{ isset($family) ? $family->Ref : old('Ref') }}">
                </div>
               
               
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="FamilyName">Family Name</label>
                  <input type="text" class="form-control"  name="FamilyName" id="FamilyName" value="{{ isset($family) ? $family->FamilyName : old('FamilyName') }}">
                </div>
                <div class="col-md-4">
                  <label for="MotherName">Mother Name</label>
                  <input type="text" class="form-control"  name="MotherName" id="MotherName" value="{{ isset($family) ? $family->MotherName : old('MotherName') }}">
                </div>
                <div class="col-md-4">
                  <label for="Date">Date</label>
                  <input type="date" class="form-control" name="Date" id="Date" value="{{ isset($family) ? Carbon\Carbon::parse($family->Date)->format('Y-m-d') : old('Date') }}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
              <div class="col-md-4">
                  <label for="Phone">Phone</label>
                  <input type="text" class="form-control" placeholder="+961 09 000 000"  name="Phone" id="Phone" value="{{ isset($family) ? $family->Phone : old('Phone') }}">
                </div>
                <div class="col-md-4">
                  <label for="Mobile">Mobile</label>
                  <input type="text" class="form-control" placeholder="+961 70 000 000"  name="Mobile" id="Mobile" value="{{ isset($family) ? $family->Mobile : old('Mobile') }}">
                </div>
                <div class="col-md-4">
                  <label for="Email">Email</label>
                  <input type="email" class="form-control" placeholder="example@example.com"  name="Email" id="Email" value="{{ isset($family) ? $family->Email : old('Email') }}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="Region">Region</label>
                  <select  class="form-control"  name="Region" id="Region" >
                  @foreach($regions as $region)
                       <option value="{{$region->Name}}"
                       
                       @if(isset($family))
                        @if($family->Region === $region->Name)
                        selected
                        @endif
                      @endif
                       >{{$region->Name}}</option>
                       @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="Street">Street</label>
                  <input type="text" class="form-control"  name="Street" id="Street" row="3" value="{{ isset($family) ? $family->Street : old('Street') }}">
                </div>
                <div class="col-md-4">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control"  name="Address" id="Address" value="{{ isset($family) ? $family->Address : old('Address') }}"/>
                  </div>
              </div>
            </div>
           
            <div class="form-group">
              <div class="row">
                 
                  <div class="col-md-4">
                    <label for="Place">Place</label>
                    <input type="text" class="form-control"  name="Place" id="Place" value="{{ isset($family) ? $family->Place : old('Place') }}" >
                </div>
                <div class="col-md-4">
                  <label for="Building">Building</label>
                  <input type="text" class="form-control"  name="Building" id="Building" value="{{ isset($family) ? $family->Building : old('Building') }}" >
                </div>
                <div class="col-md-4">
                  <label for="Floor">Floor</label>
                  <input type="text" class="form-control"  name="Floor" id="Floor" row="3" value="{{ isset($family) ? $family->Floor : old('Floor') }}">
                </div>
                </div>
            </div>


         

           
            <div class="form-group">
              <div class="row">
              <div class="col-md-4">
                <label for="Religion">Religion</label>
                  <input type="text" class="form-control"   name="Religion" id="Religion" value="{{ isset($family) ? $family->Religion : old('Religion') }}">
                </div>
                <div class="col-md-4">
                  <label for="SocialHepler">Social Helper</label>
                  <select type="text" class="form-control"  name="SocialHelper" id="SocialHelper" >
                  @foreach($users as $user)
                       <option value="{{$user->id}}"
                       
                       @if(isset($family))
                        @if($family->SocialHepler === $user->id)
                        selected
                        @endif
                      @endif
                       >{{$user->name}}</option>
                       @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                <label for="RelativeName">Relative Name</label>
                  <input type="text" class="form-control"   name="RelativeName" id="RelativeName" value="{{ isset($family) ? $family->RelativeName : old('RelativeName') }}">
                </div>
              </div>
            </div>
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('families.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
             </div>
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      

      <!-- <div class="col-sm-12 mb-4">
                       
                        <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                            <table class="table table-bordered" id="items">
                                <thead class="thead-light">
                                    <tr>
                                       
                                            <th class="text-center border-right-0 border-bottom-0">Action</th>
                                       

                                       
                                            <th class="text-left border-right-0 border-bottom-0">Item</th>
                                        

                                       
                                            <th class="text-center border-right-0 border-bottom-0 w-10">quantity</th>
                                      

                                     
                                      

                                       
                                            <th class="text-right border-right-0 border-bottom-0">Price</th>
                                            <th class="text-right border-right-0 border-bottom-0">Tax</th>

                                       
                                            <th class="text-right border-bottom-0 item-total">Total</th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="bill-item-rows">
                                  

                                   
                                        <tr id="addItem">
                                            <td class="text-center border-right-0 border-bottom-0">
                                                <button type="button" @click="onAddItem" id="button-add-item" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-lg" data-original-title="add"><i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                            <td class="text-right border-bottom-0" colspan="5" :colspan="colspan"></td>
                                        </tr>
                              

                                   
                                        <tr id="tr-subtotal">
                                            <td class="text-right border-right-0 border-bottom-0" colspan="5" :colspan="colspan">
                                                <strong>subtotal</strong>
                                            </td>
                                            <td class="text-right border-bottom-0 long-texts">
                                               
                                                <span id="sub-total" v-if="totals.sub" v-html="totals.sub"></span>
                                                <span v-else></span>
                                            </td>
                                        </tr>
                                  

                                </tbody>
                            </table>
                        </div>
                    </div> -->
      <!-- /.row -->
    </section>
    
    <section class="content m-2" <?php if(!isset($family)) echo "style='display:none'";?>>
    
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           Family Members
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
                           <table class="table table-bordered" id="membertable">
                               <thead class="thead-light">
                                   <tr>
                                      
                                           <th class="text-left border-right-0 border-bottom-0">Name</th>
                                       

                                      
                                           <th class="text-center border-right-0 border-bottom-0 w-10">DOB</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Position</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Status</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Profession</th>
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
    </section>

    <section class="content m-2" <?php if(!isset($family)) echo "style='display:none'";?>>
    
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           Family members living in the same house
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
                           <table class="table table-bordered" id="membertable1">
                               <thead class="thead-light">
                                   <tr>
                                      
                                           <th class="text-left border-right-0 border-bottom-0">Name</th>
                                       

                                      
                                           <th class="text-center border-right-0 border-bottom-0 w-10">DOB</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Position</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Status</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Profession</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Description</th>
                                           <th class="text-center border-right-0 border-bottom-0">Action</th>
                                      
                                   </tr>
                               </thead>
                               <tbody id="member-rows1">
                                      
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
    </section>
  <script>
    $(document).ready(function(){
  
  setTimeout(() => {
    $("div.alert").remove();
  }, 1000);
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      fetchRecords();
      fetchRecords1();

      //======================= Add Member ===============================
      $(document).on("click", ".AddMember" , function() {
    
        
      $.ajax({
        url: '/addMember',
        type: "GET",
        data: {'family_id':$('input[name=family_id]').val(),'action':1,'Name':$('#Name').val(),'DateOfBirth':$('#DateOfBirth').val(),'Status':$('#Status').val(),'Profession':$('#Profession').val(),'Position':$('#Position').val(),'Description':$('#Description').val(), '_token':CSRF_TOKEN},
        dataType: 'JSON',
        success: function (data) {
          Swal.fire({
  
  icon: 'success',
  title: 'Added Successfully !',
  showConfirmButton: false,
  timer: 1500
})
          fetchRecords();
          $('#Name').val('');
         $('#DateOfBirth').val('');
         $('#Status').val('');
         $('#Profession').val('');
         $('#Position').val('');
          $('#Description').val('');
          // this is good
        }
      });

      });

//========================= Add Member In House ==================================
$(document).on("click", ".AddMember1" , function() {
    
        
    $.ajax({
      url: '/addMember',
      type: "GET",
      data: {'family_id':$('input[name=family_id]').val(),'action':2,'Name':$('#Name1').val(),'DateOfBirth':$('#DateOfBirth1').val(),'Status':$('#Status1').val(),'Profession':$('#Profession1').val(),'Position':$('#Position1').val(),'Description':$('#Description1').val(), '_token':CSRF_TOKEN},
      dataType: 'JSON',
      success: function (data) {
        Swal.fire({

icon: 'success',
title: 'Added Successfully !',
showConfirmButton: false,
timer: 1500
})
        fetchRecords1();
        $('#Name1').val('');
         $('#DateOfBirth1').val('');
         $('#Status1').val('');
         $('#Profession1').val('');
         $('#Position1').val('');
          $('#Description1').val('');
        // this is good
      }
    });

    });
      //=========================Delete Member ================================
      $(document).on("click", ".DeleteMember" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteMember/'+ID,
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
$(document).on("click", ".DeleteMember1" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteMember/'+ID,
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
      $(document).on("click", ".UpdateMember" , function() {
  var ID = $(this).data('id');
  var el = this;
 var name = $('#name_'+ID).val();

  var dob = $('#dob_'+ID).val();
  var status = $('#status_'+ID).val();
  var description = $('#description_'+ID).val();
  var profession = $('#profession_'+ID).val();
  var position = $('#position_'+ID).val();
  if(name != '' && dob != ''){
  
    $.ajax({
      url: '/updateMember',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'action': 1,'id': ID,'Name': name,'DateOfBirth': dob,'Status': status,'Profession': profession,'Description': description,'Position':position},
     
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
$(document).on("click", ".UpdateMember1" , function() {
  var ID = $(this).data('id');
  var el = this;
 var name = $('#name_'+ID).val();

  var dob = $('#dob_'+ID).val();
  var status = $('#status_'+ID).val();
  var description = $('#description_'+ID).val();
  var profession = $('#profession_'+ID).val();
  var position = $('#position_'+ID).val();
  if(name != '' && dob != ''){
  
    $.ajax({
      url: '/updateMember',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'action': 2,'id': ID,'Name': name,'DateOfBirth': dob,'Status': status,'Profession': profession,'Position': position,'Description': description},
     
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
    url: '/getMembers',
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
          var Name = response['data'][i].Name;
          var DOB = response['data'][i].DateOfBirth;
         
          var Status = response['data'][i].Status;
          var Profession = response['data'][i].Profession;
          var Position = response['data'][i].Position;
          var Description = response['data'][i].Description;

          var tr_str = "<tr>" +
          "<td align='center'><input type='text' id='name_"+id+"' value='"+Name+"' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='dob_"+id+"' value='"+DOB.split(' ')[0]+"' /></td>" ; 
          if(Position=='' || Position==null){
tr_str += "<td align='center'>"+
"<select class='form-control'  id='position_"+id+"'>"+
"<option value='' selected></option>"+
"<option value='Father' >Father</option>"+
"<option value='Mother'>Mother</option>"+
"<option value='Daughter'>Daughter</option>"+
"<option value='Son'>Son</option></select></td>";
}
         else if(Position=='Father'){
tr_str += "<td align='center'>"+
"<select class='form-control'  id='position_"+id+"'>"+
"<option value='' ></option>"+
"<option value='Father' selected>Father</option>"+
"<option value='Mother'>Mother</option>"+
"<option value='Daughter'>Daughter</option>"+
"<option value='Son'>Son</option></select></td>";
}
else if(Position=='Mother'){
  tr_str += "<td align='center'>"+
"<select class='form-control'  id='position_"+id+"'>"+
"<option value='' ></option>"+
"<option value='Father' >Father</option>"+
"<option value='Mother' selected>Mother</option>"+
"<option value='Daughter'>Daughter</option>"+
"<option value='Son'>Son</option></select></td>";
} 
else if(Position=='Daughter'){
  tr_str += "<td align='center'>"+
"<select class='form-control'  id='position_"+id+"'>"+
"<option value='' ></option>"+
"<option value='Father' >Father</option>"+
"<option value='Mother' >Mother</option>"+
"<option value='Daughter' selected>Daughter</option>"+
"<option value='Son'>Son</option></select></td>";
}
else {
  tr_str += "<td align='center'>"+
"<select class='form-control'  id='position_"+id+"'>"+
"<option value='' ></option>"+
"<option value='Father' >Father</option>"+
"<option value='Mother' >Mother</option>"+
"<option value='Daughter' >Daughter</option>"+
"<option value='Son' selected>Son</option></select></td>";
}
tr_str += "<td align='center'><input class='form-control' type='text' id='status_"+id+"' value='"+Status+"' /></td>"; 
if(Profession=='' || Profession==null){
tr_str += "<td align='center'>"+
"<select class='form-control'  id='profession_"+id+"'>"+
"<option value='' selected ></option>"+
"<option value='School' >School</option>"+
"<option value='Work'>Work</option>"+
"<option value='Other'>Other</option></select></td>";
}
else if(Profession=='School'){
tr_str += "<td align='center'>"+
"<select class='form-control'  id='profession_"+id+"'>"+
"<option value='' ></option>"+
"<option value='School' selected>School</option>"+
"<option value='Work'>Work</option>"+
"<option value='Other'>Other</option></select></td>";
}
else if(Profession=='Work'){
tr_str += "<td align='center'>"+
"<select class='form-control' id='profession_"+id+"'>"+
"<option value='' ></option>"+
"<option value='School' >School</option>"+
"<option value='Work' selected>Work</option>"+
"<option value='Other' >Other</option></select></td>";
} else{
  tr_str += "<td align='center'>"+
"<select class='form-control' id='profession_"+id+"'>"+
"<option value='' ></option>"+
"<option value='School' >School</option>"+
"<option value='Work' >Work</option>"+
"<option value='Other' selected>Other</option></select></td>";
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

          '<button type="button"  data-id="'+id+'" data-toggle="tooltip" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 UpdateMember " data-original-title="edit"><i class="fa fa-edit"></i> Update</button>'+
            
            '<button type="button" data-id="'+id+'"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 DeleteMember" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>'+
              '</div>'+
              '</div>'+
         
         
         '</td>' +
          '</tr>';

          $("#membertable tbody").append(tr_str);

        }
        var tr_str = "<tr>" +
          "<td align='center'><input type='text'  id='Name' value='' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='DateOfBirth' value='' /></td>" + 
          "<td align='center'><select class='form-control' type='text' id='Position' ><option value=''></option><option value='Father'>Father</option><option value='Mother'>Mother</option><option value='Daughter'>Daughter</option><option value='Son'>Son</option></select></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Status' value='' /></td>" + 
          "<td align='center'><select class='form-control' type='text' id='Profession' ><option value=''></option><option value='School'>School</option><option value='Work'>Work</option><option value='Other'>Other</option></select></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Description' value=''/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          '<button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddMember" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>'+
         '</td>' +
          '</tr>';
          $("#membertable tbody").append(tr_str);
      }else{
        var tr_str = "<tr>" +
          "<td align='center'><input type='text'  id='Name' value='' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='DateOfBirth' value='' /></td>" + 
          "<td align='center'><select class='form-control' type='text' id='Position' ><option value=''></option><option value='Father'>Father</option><option value='Mother'>Mother</option><option value='Daughter'>Daughter</option><option value='Son'>Son</option></select></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Status' value='' /></td>" + 
          "<td align='center'><select class='form-control' type='text' id='Profession' ><option value=''></option><option value='School'>School</option><option value='Work'>Work</option><option value='Other'>Other</option></select></td>" + 
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

function fetchRecords1(){
  $.ajax({
    url: '/getMembers',
    type: 'GET',
    data: {'action':2,'id':$('input[name=family_id]').val()},
    dataType: 'JSON',
   
    success: function(response){

      var len = 0;
      $('#membertable1 tbody tr:not(:first)').empty();
       // Empty <tbody>
       $('#member-rows1').empty();
       
      if(response['data'] != null){
    
        len = response['data'].length;
      
      }

      if(len > 0){
        for(var i=0; i<len; i++){

          var id = response['data'][i].id;
          var Name = response['data'][i].Name;
          var DOB = response['data'][i].DateOfBirth;
         
          var Status = response['data'][i].Status;
          var Profession = response['data'][i].Profession;
          var Description = response['data'][i].Description;
          var Position = response['data'][i].Position;
          var tr_str = "<tr>" +
          "<td align='center'><input type='text' id='name_"+id+"' value='"+Name+"' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='dob_"+id+"' value='"+DOB.split(' ')[0]+"' /></td>" +
          "<td align='center'><input class='form-control' type='text' id='position_"+id+"' value='"+Position+"' /></td>" ; 
      
tr_str +="<td align='center'><input class='form-control' type='text' id='status_"+id+"' value='"+Status+"' /></td>"; 
if(Profession=='School'){
tr_str += "<td align='center'>"+
"<select class='form-control'  id='profession_"+id+"'>"+
"<option value='School' selected>School</option>"+
"<option value='Work'>Work</option>"+
"<option value='Other'>Other</option></select></td>";
}
else if(Profession=='Work'){
tr_str += "<td align='center'>"+
"<select class='form-control' id='profession_"+id+"'>"+
"<option value='School' >School</option>"+
"<option value='Work' selected>Work</option>"+
"<option value='Other'>Other</option></select></td>";
}else{
  tr_str += "<td align='center'>"+
"<select class='form-control' id='profession_"+id+"'>"+
"<option value='School' >School</option>"+
"<option value='Work' >Work</option>"+
"<option value='Other' selected>Other</option></select></td>";
}
tr_str += "<td align='center'><input class='form-control' type='text' id='description_"+id+"' value='"+Description+"'/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          ' <div class="dropdown">'+
          '<a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '<i class="fa fa-ellipsis-h text-muted"></i>'+
          '</a>'+                           
          '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center">'+
          '<a href="/familymembers/'+id+'/edit" data-id="'+id+'"  data-toggle="tooltip" title="Info" style="width:80%" class="btn btn-icon btn-outline-warning btn-sm m-1-1 mb-1" data-original-title="Info"><i class="fa fa-list"></i> Member Info</a>'+
         // '<div class="dropdown-divider"></div>'+
          '<button type="button"  data-id="'+id+'" data-toggle="tooltip" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 UpdateMember1" data-original-title="edit"><i class="fa fa-edit"></i> Update</button>'+
            
            '<button type="button" data-id="'+id+'"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 DeleteMember1" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>'+
              '</div>'+
              '</div>'+
         
         
         '</td>' +
          '</tr>';

          $("#membertable1 tbody").append(tr_str);

        }
        var tr_str = "<tr>" +
          "<td align='center'><input type='text'  id='Name1' value='' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='DateOfBirth1' value='' /></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Position1' /></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Status1' value='' /></td>" + 
          "<td align='center'><select class='form-control' type='text' id='Profession1' ><option value='School'>School</option><option value='Work'>Work</option><option value='Other'>Other</option></select></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Description1' value=''/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          '<button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddMember1" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>'+
         '</td>' +
          '</tr>';
          $("#membertable1 tbody").append(tr_str);
      }else{
        var tr_str = "<tr>" +
          "<td align='center'><input type='text'  id='Name1' value='' class='form-control' /></td>" +
          "<td align='center'><input class='form-control' type='date' id='DateOfBirth1' value='' /></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Position1' /></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Status1' value='' /></td>" + 
          "<td align='center'><select class='form-control' type='text' id='Profession1' ><option value='School'>School</option><option value='Work'>Work</option><option value='Other'>Other</option></select></td>" + 
          "<td align='center'><input class='form-control' type='text' id='Description1' value=''/></td>" + 
          '<td class="text-center border-right-0 border-bottom-0">' +
          '<button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-outline-success btn-md m-1 AddMember1" data-original-title="Add"><i class="fa fa-plus"></i> Add</button>'+
         '</td>' +
          '</tr>';
        tr_str += "<tr class='norecord'>" +
        "<td align='center' colspan='6'>No record found.</td>" +
        "</tr>";

        $("#membertable1 tbody").append(tr_str);
      }

    }
  });
}

  </script>
@endsection

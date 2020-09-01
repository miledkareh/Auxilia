@extends('layouts.welcome')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content m-2">
    <form action="{{ isset($family) ? route('mothersinfo.update', $family[0]['id']) : ''}}" method="POST">
            @csrf

            @if(isset($family))
            @method('PUT')
          @endif
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
      <!-------------------------- Home - Information ---------------------------->

      <div class="col-4">
         
         <!-- /.card -->
         <div class="card">
           <div class="card-header">
           <h2 class="float-left">
          Home - Information
           </h2>
            
           </div> 
        
           <div class="card-body">
        
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                        <label for="HomeProperty">Home Property</label>
                        <select  class="form-control"  name="HomeProperty" id="HomeProperty" >
                         <option value="Owner"
                          @if(isset($family))
                               @if($family[0]['HomeProperty'] === 'Owner')
                               selected
                               @endif
                             @endif>Owner</option>
                             <option value="Rent"
                          @if(isset($family))
                               @if($family[0]['HomeProperty'] === 'Rent')
                               selected
                               @endif
                             @endif>Rent</option>
        
        
                         </select>
                          </div>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                     
                      <div class="col-md-6">
                        <label for="NumberOfRooms">Number of rooms</label>
                        <input  class="form-control" type="text" name="NumberOfRooms" id="NumberOfRooms" value="{{ isset($family) ? $family[0]['NumberOfRooms'] : old('NumberOfRooms') }}" />
                      </div>
                      <div class="col-md-6">
                        <label for="LivingRoom">Living Room</label>
                        <input  class="form-control" type="text" name="LivingRoom" id="LivingRoom" value="{{ isset($family) ? $family[0]['LivingRoom'] : old('LivingRoom') }}" />
                          </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                        <label for="Kitchen">Kitchen</label>
                        <input  class="form-control" type="text" name="Kitchen" id="Kitchen" value="{{ isset($family) ? $family[0]['Kitchen'] : old('Kitchen') }}" />
                          </div>
                          <div class="col-md-6">
                        <label for="Bathroom">Bathroom</label>
                        <input  class="form-control" type="text" name="Bathroom" id="Bathroom" value="{{ isset($family) ? $family[0]['Bathroom'] : old('Bathroom') }}" />
                          </div>
                    </div>
                  </div>
                
                
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                        <label for="State">State</label>
                        <select  class="form-control"  name="State" id="State" >
                         <option value="Good"
                          @if(isset($family))
                               @if($family[0]['State'] === 'Good')
                               selected
                               @endif
                             @endif>Good</option>
                             <option value="Normal"
                          @if(isset($family))
                               @if($family[0]['State'] === 'Normal')
                               selected
                               @endif
                             @endif>Normal</option>
        
                             <option value="Not Acceptable"
                          @if(isset($family))
                               @if($family[0]['Not Acceptable'] === 'Not Acceptable')
                               selected
                               @endif
                             @endif>Not Acceptable</option>
                         </select>
                          </div>

                    </div>
                  </div>
        
        
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="Remarks">Remarks</label>
                        <textarea  class="form-control" type="text" name="Remarks" id="Remarks" >{{ isset($family) ? $family[0]['Remarks'] : old('Remarks') }}</textarea>
                          </div>
                    </div>
                  </div>
        
                  
                  
                  
                  </div>
           
           <!-- /.card-body -->
             </div>
         <!-- /.card -->
       </div>

       <!----------------------- End Home- Informarion ------------------------->

<!--------------------------- WORK INFORMATION --------------------------------->
        <div class="col-4">
         
         <!-- /.card -->
         <div class="card">
           <div class="card-header">
           <h2 class="float-left">
          Work - Information
           </h2>
            
           </div> 
        
           <div class="card-body">
        
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="CompanyName">Company Name</label>
                        <input  class="form-control" type="text" name="CompanyName" id="CompanyName" value="{{ isset($family) ? $family[0]['CompanyName'] : old('CompanyName') }}" />
                      </div>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                     
                      <div class="col-md-12">
                        <label for="CompanyLocation">Location</label>
                        <input  class="form-control" type="text" name="CompanyLocation" id="CompanyLocation" value="{{ isset($family) ? $family[0]['CompanyLocation'] : old('CompanyLocation') }}" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="PaymentMode">Payment Mode</label>
                        <select  class="form-control"  name="PaymentMode" id="PaymentMode" value="{{ isset($family) ? $family[0]['PaymentMode'] : old('PaymentMode') }}">
                         <option value="Daily"
                          @if(isset($family))
                               @if($family[0]['PaymentMode'] === 'Daily')
                               selected
                               @endif
                             @endif>Daily</option>
                             <option value="Monthly"
                          @if(isset($family))
                               @if($family[0]['PaymentMode'] === 'Monthly')
                               selected
                               @endif
                             @endif>Monthly</option>
        
        
                         </select>
                          </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="HealthCare">Health Care</label>
                        <select  class="form-control"  name="HealthCare" id="HealthCare" value="{{ isset($family) ? $family[0]['PaymentMode'] : old('PaymentMode') }}">
                         <option value="CNSS"
                          @if(isset($family))
                               @if($family[0]['HealthCare'] === 'CNSS')
                               selected
                               @endif
                             @endif>CNSS</option>
                             <option value="Insurance"
                          @if(isset($family))
                               @if($family[0]['HealthCare'] === 'Insurance')
                               selected
                               @endif
                             @endif>Insurance</option>
        
        
                         </select>
                          </div>
                    </div>
                  </div>
                     
            
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="CNSSNumber">CNSS Number</label>
                        <input  class="form-control" type="text" name="CNSSNumber" id="CNSSNumber" value="{{ isset($family) ? $family[0]['CNSSNumber'] : old('CNSSNumber') }}" />
                        </div>
                        
                    </div>
                  </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
            <div class="icheck-success d-inline">
                             <input type="checkbox" name="Valid" id="Valid" value="1" 
                             @if(isset($family))
                             @if($family[0]['Valid'] === 1)
                             checked
                             @endif
                             @endif>
                             <label for="Valid">
                             Valid
                             </label>
                           </div>
            </div>
          </div>
        </div>
                
        
                  
                  
                   
                  </div>
           
           <!-- /.card-body -->
             </div>
         <!-- /.card -->
       </div>
        <!-- /.col -->
     
      <!----------------- END of work information ---------------->
<!----------------- Mother Information -------------------->

<div class="col-4">
         
         <!-- /.card -->
         <div class="card">
           <div class="card-header">
           <h2 class="float-left">
           @if(isset($family)) {{$family[0]['MotherName']}} @else '' @endif - Information
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
         
@if(isset($family))
         <input type="hidden" name="family_id" value="{{ $family[0]['id'] }}" />
         @else
         <input type="hidden" name="family_id" value="0" />
           @endif

           <div class="form-group">
             <div class="row">
               <div class="col-md-12">
                 <label for="LevelOfStudy">Level of study</label>
                 <select  class="form-control"  name="LevelOfStudy" id="LevelOfStudy" value="{{ isset($family) ? $family[0]['LevelOfStudy'] : old('LevelOfStudy') }}">
                 <option value="Illiterate"
                  @if(isset($family))
                       @if($family[0]['LevelOfStudy'] === 'Illiterate')
                       selected
                       @endif
                     @endif>Illiterate</option>
                     <option value="Primary"
                  @if(isset($family))
                       @if($family[0]['LevelOfStudy'] === 'Primary')
                       selected
                       @endif
                     @endif>Primary</option>

                     <option value="Complementary"
                  @if(isset($family))
                       @if($family[0]['LevelOfStudy'] === 'Complementary')
                       selected
                       @endif
                     @endif>Complementary</option>

                     <option value="Secondary"
                  @if(isset($family))
                       @if($family[0]['LevelOfStudy'] === 'Secondary')
                       selected
                       @endif
                     @endif>Secondary</option>

                     <option value="University"
                  @if(isset($family))
                       @if($family[0]['LevelOfStudy'] === 'University')
                       selected
                       @endif
                     @endif>University</option>

                     <option value="Technical"
                  @if(isset($family))
                       @if($family[0]['LevelOfStudy'] === 'Technical')
                       selected
                       @endif
                     @endif>Technical</option>

                 </select>
               </div>
             
             </div>
           </div>
           <div class="form-group">
             <div class="row">
                 <div class="col-md-12">
                           <div class="icheck-success d-inline">
                             <input type="checkbox" name="DrivingLicense" id="DrivingLicense" value="1" 
                             @if(isset($family))
                             @if($family[0]['DrivingLicense'] === 1)
                             checked
                             @endif
                             @endif>
                             <label for="DrivingLicense">
                             Driving license
                             </label>
                           </div>
                           <div class="icheck-success d-inline">
                             <input type="checkbox" id="Car" name="Car" value="1"
                              @if(isset($family))
                             @if($family[0]['Car'] === 1)
                             checked
                             @endif
                              @endif>
                             <label for="Car">
                             Car
                             </label>
                           </div>
                   </div>
             </div>
           </div>
         
           </div>
           
           <!-- /.card-body -->
         </div>
         <!-- /.card -->
       </div>
    <!------------- End Mother Information ---------------------->
        <!-- /.col -->
      </div>
      <div class="form-group">
                
                <button type="submit" class="btn btn-success float-right">Save</button>
                <a href="{{ route('families.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
      </div>
      </form>
    </section>
    <br><br>
    <section class="content">

    <div class="row">
    <div class="col-12">
         
         <!-- /.card -->
         <div class="card">
           <div class="card-header">
           <h2 class="float-left">
           Psychological follow-up
           </h2>
           <div class="row" >
            <div class="col-md-12 float-right ">
                  <button class="btn btn-info btn-md float-right m-2 " data-toggle="modal" data-target="#myModal" id="Add" >Add Follow-up </button>
                  </div>
                  </div>
           </div> 
        
           <div class="card-body">
          
        
           <div class="row">
                  <div class="col-sm-12 mb-4">
               
                       <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                           <table class="table table-bordered" id="followuptable">
                               <thead class="thead-light">
                                   <tr>
                                      
                                           <th class="text-left border-right-0 border-bottom-0" style="width:15%">Problems</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10" style="width:10%"># Visits</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10" style="width:20%">Solutions</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10" style="width:10%">End Of Therapy</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10" style="width:15%">Family Therapy</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10" style="width:10%">End Of Therapy</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10" style="width:20%">Psychologist</th>
                                           <th class="text-center border-right-0 border-bottom-0">Action</th>
                                      
                                   </tr>
                               </thead>
                               <tbody id="followup-rows">
                               @foreach($followups as $followup)
                                      <tr>
   
          <td align='center'> {{$followup->Problem}}</td>
          <td align='center'>{{$followup->NumberOfVisits}}</td> 
            <td align='center'>{{$followup->Solution}}</td> 
            <td>{{($followup->EndOfTherapy!='' || $followup->EndOfTherapy!=null) ? Carbon\Carbon::parse($followup->EndOfTherapy)->format('Y-m-d') : ''}}</td>
          <td align='center'> {{$followup->FamilyTherapy}}</option></td>
          <td>{{($followup->EndOfFamilyTherapy!='' || $followup->EndOfFamilyTherapy!=null) ? Carbon\Carbon::parse($followup->EndOfFamilyTherapy)->format('Y-m-d') : ''}}</td>
          <td align='center'>{{$followup->Psychologist}}</td> 
          
        
          <td class="text-center border-right-0 border-bottom-0">
           <div class="dropdown ">
          <a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-ellipsis-h text-muted"></i>
          </a>                      
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center" >
         
          <button type="button"  data-id="{{$followup->id}}"  data-toggle="modal" data-target="#myModal" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 UpdateFollowUp" data-original-title="edit"><i class="fa fa-edit"></i> Update</button>
            
            <button type="button" data-id="{{$followup->id}}"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 DeleteFollowUp" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>
              </div>
              </div>
         
         
         </td>
         
          </tr>
                                      @endforeach 
                               </tbody>
                             
                           </table>
                       </div>
                   </div>
                   </div>
           
         
           </div>
           
           <!-- /.card-body -->
         </div>
         <!-- /.card -->
       </div>
    </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title " id="title" align="left">Add</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
    <label>Problem</label> <input class='form-control' type='text'  id='Problem' value=''/>
                                  <label >Number Of Visits</label><input class='form-control' type='text' id='NumberOfVisits'  value=''/>
                                  <label>Solution</label><textarea class='form-control' type='text' id='Solution' rows="1"></textarea>
                                  <label>EndOfTherapy</label><input class='form-control' type='Date' id='EndOfTherapy'  value=''/>
                                <label>Family Therapy</label>
                                      <select class='form-control'  id='FamilyTherapy'>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                      </select>
                                 
                                  <label>End Of Family Therapy</label><input class='form-control' type='Date' id='EndOfFamilyTherapy'  value=''/>
                                  <label>Psychologist</label><input class='form-control' type='text' id='Psychologist'  value=''/>
      </div>
      <div class="modal-footer">
      <button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-success AddFollowUp" data-original-title="Add"> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <script>
  
 
    $(document).ready(function(){
     var ID=0;
  setTimeout(() => {
    $("div.alert").remove();
  }, 1000);
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //  fetchRecords();
     // fetchRecords1();

      //======================= Add Member ===============================
      $(document).on("click", ".AddResource" , function() {
    
        
      $.ajax({
        url: '/addDetail',
        type: "GET",
        data: {'family_id':$('input[name=family_id]').val(),'Type':1,'Name':$('#Name').val(),'Member':$('#Member').val(),'Currency':$('#Currency').val(),'Amount':$('#Amount').val(),'Period':$('#Period').val(), '_token':CSRF_TOKEN},
        dataType: 'JSON',
        success: function (data) {
          Swal.fire({
  position: 'top-end',
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
$(document).on("click", ".AddFollowUp" , function() {
  
      if(ID==0)  
    $.ajax({
      url: '/addFollowup',
      type: "GET",
      data: {'family_id':$('input[name=family_id]').val(),'Problem':$('#Problem').val(),'NumberOfVisits':$('#NumberOfVisits').val(),'Solution':$('#Solution').val(),'EndOfTherapy':$('#EndOfTherapy').val(),'FamilyTherapy':$('#FamilyTherapy').val(),'EndOfFamilyTherapy':$('#EndOfFamilyTherapy').val(),'Psychologist':$('#Psychologist').val(), '_token':CSRF_TOKEN},
      dataType: 'JSON',
      success: function (data) {
        Swal.fire({
position: 'top-end',
icon: 'success',
title: 'Added Successfully !',
showConfirmButton: false,
timer: 1500
});
setTimeout(() => {
  location.reload();
}, 1000);
       
        // this is good
      }
    });
else
$.ajax({
  url: '/updateFollowup',
  type: 'POST',
  data: {'_token': CSRF_TOKEN,
  'id': ID,
  'Problem':$('#Problem').val(),'NumberOfVisits':$('#NumberOfVisits').val(),'Solution':$('#Solution').val(),'EndOfTherapy':$('#EndOfTherapy').val(),'FamilyTherapy':$('#FamilyTherapy').val(),'EndOfFamilyTherapy':$('#EndOfFamilyTherapy').val(),'Psychologist':$('#Psychologist').val()},
 
  success: function(response){
    Swal.fire({
position: 'top-end',
icon: 'success',
title: response,
showConfirmButton: false,
timer: 1500
});
setTimeout(() => {
location.reload();
}, 1000);
  }
});

    });
      //=========================Delete Member ================================
      $(document).on("click", ".DeleteFollowUp" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteFollowup/'+ID,
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
$(document).on("click", "#Add" , function() {
  ID=0;
  $('#title').html('Add');
});

      //============= Update Followup ======================
      $(document).on("click", ".UpdateFollowUp" , function() {
       
   ID = $(this).data('id');
   $('#title').html('Edit');
  var el = this;

  $.ajax({
    url: '/getFollowup',
    type: 'GET',
    data: {'action':1,'id':ID},
    dataType: 'JSON',
   
    success: function(response){

      var len = 0;

   $('#Problem').val(response['data'][0].Problem);
   $('#NumberOfVisits').val(response['data'][0].NumberOfVisits);
   $('#Solution').val(response['data'][0].Solution);
   if(response['data'][0].EndOfTherapy!=null)
   $('#EndOfTherapy').val(response['data'][0].EndOfTherapy.split(' ')[0]);
   $('#FamilyTherapy').val(response['data'][0].FamilyTherapy);
   if(response['data'][0].EndOfFamilyTherapy!=null)
   $('#EndOfFamilyTherapy').val(response['data'][0].EndOfFamilyTherapy.split(' ')[0]);
   $('#Psychologist').val(response['data'][0].Psychologist);
    }
  });
 
});



  });
 
 
  </script>
@endsection

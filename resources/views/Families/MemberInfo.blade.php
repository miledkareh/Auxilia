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
                              selected
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
                              selected
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
                     
            
        
        
                
        
                  
                  
                   
                  </div>
           
           <!-- /.card-body -->
             </div>
         <!-- /.card -->
       </div>
        <!-- /.col -->
     
      <!----------------- END of work information ---------------->

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
        <!-- /.col -->
      </div>
      <div class="form-group">
                
                <button type="submit" class="btn btn-success float-right">Save</button>
                <a href="{{ route('families.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
                </div>
      </form>
    </section>
    
   
  <script>
 

  </script>
@endsection

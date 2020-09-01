@extends('layouts.welcome')

@section('content')

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h2 class="float-left">
              {{isset($user) ? 'Edit Employee' : 'Create Employee'}}
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
            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($user))
            @method('PUT')
            @endif
            <div class="form-group">
          
             <input type="file" class="form-control" style="display:none"  name="image" id="image" >
             <img class="user-image" src='{{ isset($user) ? asset("storage/".$user->image) : "" }}' id='img' alt="user image" style="cursor:pointer;" width="170" height="170" onclick="document.getElementById('image').click()" />
             </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="{{ isset($user) ? $user->name : old('name') }}">
                </div>
                <div class="col-md-6">
                    <label for="Phone">Mobile</label>
                    <input type="text" class="form-control" placeholder="+961 70 000 000" name="Phone" id="Phone" value="{{ isset($user) ? $user->Phone : old('Phone') }}">
                </div>
              </div>
             </div>
             <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{  isset($user) ? $user->email : old('email') }}">
                </div>
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="{{ isset($user) ? $user->password : old('password') }}">
                </div>
              </div>
             </div>
            
             <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                    <label for="CNSS_StartDate">CNSS Start Date</label>
                    <input type="date" class="form-control"  name="CNSS_StartDate" id="CNSS_StartDate" value="{{  isset($user) ? Carbon\Carbon::parse($user->CNSS_StartDate)->format('Y-m-d') : old('CNSS_StartDate') }}">
                </div>
                <div class="col-md-6">
                    <label for="CNSS_EndDate">CNSS End Date</label>
                    <input type="date" class="form-control"  name="CNSS_EndDate" id="CNSS_EndDate" value="{{ isset($user) ? Carbon\Carbon::parse($user->CNSS_EndDate)->format('Y-m-d') : old('CNSS_EndDate') }}">
                </div>
              </div>
             </div>
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('users.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
             </div>
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      </div>
      <!-- /.row -->
    </section>



    <script>
   $(document).ready(function() {
    $("#image").change(function(){
	
  var files = $("#image")[0].files;
  var result = "";
  
  for (var i = 0; i < files.length; i++)
  {
   result =result +files[i].name;
   if (i<files.length-1){
     result =result +","; 
   }
  }
  
  // document.getElementById("formimage1").action="upload1.php?x="+ID+"&y=1";
  // document.getElementById("formimage1").submit();
  image1=result;
    //OpenUserEdit(Id);
  });	
  function showImage(src,target) {
    var fr=new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function(e) { target.src = this.result; };
    src.addEventListener("change",function() {
      // fill fr with image data    
      fr.readAsDataURL(src.files[0]);
    });
  }
  
  var src1 = document.getElementById("image");
  var target1 = document.getElementById("img");
  showImage(src1,target1);

   });
    </script>

@endsection

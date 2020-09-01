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
            {{isset($salarybreakdown) ? 'Edit Donation' : 'Create Donation'}}
            </h2>
             
            </div> 
         <!-- Check if there is any error and display it -->
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
            <form action="{{ isset($salarybreakdown) ? route('salarybreakdowns.update', $salarybreakdown->id) : route('salarybreakdowns.store')}}" method="POST">
            @csrf
<!--  on update @method('PUT') is must  -->
            @if(isset($salarybreakdown))
            @method('PUT')
            @endif

<input type="hidden" name="user_id" value="{{ $_GET['id'] }}">
            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="Description">Description *</label>
                       <input type="text" class="form-control"  name="Description" id="Description" value="{{ isset($salarybreakdown) ? $salarybreakdown->Description : old('Description') }}" Required />
                    
                  </div>
                  <div class="col-md-6">
                       <label for="Amount">Amount *</label>
                       <input type="text" class="form-control"  name="Amount" id="Amount" value="{{ isset($salarybreakdown) ? $salarybreakdown->Amount : old('Amount') }}" required>
                      
                  </div>
              </div>
            </div>


             
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('salarybreakdowns.show',$_GET['id']) }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
    

@endsection

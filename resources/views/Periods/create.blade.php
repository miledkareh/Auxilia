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
            {{isset($period) ? 'Edit period' : 'Create period'}}
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
            <form action="{{ isset($period) ? route('periods.update', $period->id) : route('periods.store')}}" method="POST">
            @csrf

            @if(isset($period))
            @method('PUT')
            @endif
            <div class="form-group">
             <label for="name">Name *</label>
             <input type="text" class="form-control" placeholder="" name="Name" id="Name" value="{{ isset($period) ? $period->Name : old('Name') }}" required>
             </div>
            
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('periods.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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

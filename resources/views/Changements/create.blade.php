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
            {{isset($changement) ? 'Edit changement' : 'Create changement'}}
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
            <form action="{{ isset($changement) ? route('changements.update', $changement->id) : route('changements.store')}}" method="POST">
            @csrf

            @if(isset($changement))
            @method('PUT')
            @endif
            <div class="form-group">
             <label for="name">Name *</label>
             <input type="text" class="form-control" placeholder="" name="Name" id="Name" value="{{ isset($changement) ? $changement->Name : old('Name') }}" required>
             </div>
            
           <div class="form-group">
           <label for="Group1">Group *</label>
           <input type="text" class="form-control"  name="Group1" id="Group1" value="{{ isset($changement) ? $changement->Group1 : old('Group1') }}" required list="groupp">
           <datalist id="groupp">
                       @foreach($groups as $group)
                       <option value="{{$group->group1}}"
                  
                       >{{$group->group1}}</option>
                       @endforeach
                       </datalist>
           </div>
         
          

             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('changements.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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

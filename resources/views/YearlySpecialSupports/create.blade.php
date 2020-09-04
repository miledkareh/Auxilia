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
            {{isset($YearlySpecialSupport) ? 'Edit ' : 'Create '}}
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
            <form action="{{ isset($YearlySpecialSupport) ? route('YearlySpecialSupports.update', $YearlySpecialSupport->id) : route('YearlySpecialSupports.store')}}" method="POST">
            @csrf

            @if(isset($YearlySpecialSupport))
            @method('PUT')
            @endif
            <div class="form-group">
             <label for="Yearr">Year *</label>
             <input type="text" class="form-control" placeholder="" name="Yearr" id="Yearr" value="{{ isset($YearlySpecialSupport) ? $YearlySpecialSupport->Yearr : old('Yearr') }}" required>
             </div>
             <div class="form-group">
             <label for="Amount">Amount</label>
             <input type="text" class="form-control" placeholder="" name="Amount" id="Amount" value="{{ isset($YearlySpecialSupport) ? $YearlySpecialSupport->Amount : old('Amount') }}" required>
             </div>
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('YearlySpecialSupports.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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

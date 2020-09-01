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
            {{isset($exchange) ? 'Edit Currency Exchange' : 'Create Currency Exchange'}}
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
            <form action="{{ isset($exchange) ? route('exchanges.update', $exchange->id) : route('exchanges.store')}}" method="POST">
            @csrf
<!--  on update @method('PUT') is must  -->
            @if(isset($exchange))
            @method('PUT')
            @endif


            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="Dat">Date *</label>
                       <input type="date" class="form-control"  name="Dat" id="Dat" value="{{ isset($exchange) ? Carbon\Carbon::parse($exchange->Dat)->format('Y-m-d') : old('Dat') }}" Required />
                    
                  </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="FromCurrency">From Currency *</label>
                       <select type="text" class="form-control"  name="FromCurrency" id="FromCurrency" required>
                       @foreach($currencies as $currency)
                       <option value="{{$currency->id}}"
                       
                       @if(isset($exchange))
                        @if($exchange->FromCurrency === $currency->id)
                        selected
                        @endif
                      @endif
                       >{{$currency->symbol}}</option>
                       @endforeach
                       </select>
                  </div>

                  <div class="col-md-6">
                       <label for="ToCurrency">To Currency *</label>
                       <select type="text" class="form-control"  name="ToCurrency" id="ToCurrency" required >
                       @foreach($currencies as $currency)
                       <option value="{{$currency->id}}" 
                      @if(isset($exchange)) 
                        @if($exchange->ToCurrency === $currency->id)
                        selected
                        @endif
                      @endif
                      >
                      {{$currency->symbol}}
                      
                      </option>
                       @endforeach
                       </select>
                   </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="FromAmount">From Amount *</label>
                       <input type="text" class="form-control"  name="FromAmount" id="FromAmount" value="{{ isset($exchange) ? $exchange->FromAmount : old('FromAmount') }}" required/>
                    
                  </div>

                  <div class="col-md-6">
                       <label for="ToAmount">To Amount *</label>
                       <input type="text" class="form-control"  name="ToAmount" id="ToAmount"  value="{{ isset($exchange) ? $exchange->ToAmount : old('ToAmount') }}" required/>
                   </div>
              </div>
            </div>
             
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('exchanges.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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

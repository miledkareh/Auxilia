@extends('layouts.welcome')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
     <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
            {{isset($account) ? 'Edit Donation' : 'Create Donation'}}
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
            <form action="{{ isset($account) ? route('accounts.update', $account->id) : route('accounts.store')}}" method="POST">
            @csrf
<!--  on update @method('PUT') is must  -->
            @if(isset($account))
            @method('PUT')
            @endif

<input type="hidden" name="sponsor_id" value="{{ $_GET['id'] }}">
<div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="Ref">Ref *</label>
                       <input type="text" class="form-control"  name="Ref" id="Ref" value="{{ isset($account) ? $account->Ref: old('Ref') }}" Required />
                    
                  </div>
               </div>
</div>
            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="Dat">Date *</label>
                       <input type="date" class="form-control"  name="Dat" id="Dat" value="{{ isset($account) ? Carbon\Carbon::parse($account->Dat)->format('Y-m-d') : old('Dat') }}" Required />
                    
                  </div>
                  <div class="col-md-6">
                       <label for="Currency">Currency *</label>
                       <select type="text" class="form-control"  name="Currency" id="Currency" required>
                       @foreach($currencies as $currency)
                       <option value="{{$currency->id}}"
                       
                       @if(isset($account))
                        @if($account->currency_id === $currency->id)
                        selected
                        @endif
                      @endif
                       >{{$currency->symbol}}</option>
                       @endforeach
                       </select>
                  </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
      
                  <div class="col-md-3">
                       <label for="Allocation">Allocation</label>
                       <input type="number" class="form-control amount"  name="Allocation" id="Allocation" value="{{ isset($account) ? $account->Allocation : old('Allocation') }}">
                  </div>
                  <div class="col-md-3">
                       <label for="Allocation">Médicale</label>
                       <input type="number" class="form-control amount"  name="Medicale" id="Medicale" value="{{ isset($account) ? $account->Medicale : old('Medicale') }}">
                  </div>
                  <div class="col-md-3">
                       <label for="Scolaire">Scolaire</label>
                       <input type="number" class="form-control amount"  name="Scolaire" id="Scolaire" value="{{ isset($account) ? $account->Scolaire : old('Scolaire') }}">
                  </div>
                  <div class="col-md-3">
                       <label for="Divers">Divers</label> 
                       <input type="number" class="form-control amount"  name="Divers" id="Divers" value="{{ isset($account) ? $account->Divers : old('Divers') }}">
                  </div>

              </div>
            </div>

            <div class="form-group">
              <div class="row">
      
                  <div class="col-md-4">
                       <label for="PaymentMode">Payment Mode</label>
                       <select type="text" class="form-control"  name="PaymentMode" id="PaymentMode" required>
                       <option 
                       @if(isset($account))
                        @if($account->PaymentMode === 'Cash')
                        selected
                        @endif
                      @endif
                       >Cash</option>
                       <option
                       @if(isset($account))
                        @if($account->PaymentMode === 'Cheque')
                        selected
                        @endif
                      @endif
                       >Cheque</option>
                       </select>
                  </div>
                  <div class="col-md-4">
                       <label for="Bank">Bank</label>
                       <input type="text" class="form-control"  name="Bank" id="Bank" value="{{ isset($account) ? $account->Bank : old('Bank') }}">
                  </div>
                  <div class="col-md-4">
                       <label for="Total">Total</label>
                       <input type="number" class="form-control"  name="Total" id="Total" value="{{ isset($account) ? $account->Debit : old('Debit') }}">
                  </div>
                
              </div>
            </div>

            <div class="form-group">
              <div class="row">
      
                  <div class="col-md-12">
                       <label for="Notes">Notes</label>
                       <textarea type="text" class="form-control"  name="Notes" id="Notes" row="3">{{ isset($account) ? $account->Notes : old('Notes') }}</textarea>                   
                  </div>
                
              </div>
            </div>

           
             
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('accounts.show',$_GET['id']) }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
    $('.amount').change(function() {
         document.getElementById('Total').value=Number($('#Allocation').val())+Number($('#Medicale').val())+Number($('#Scolaire').val())+Number($('#Divers').val())
    });
    </script>

@endsection

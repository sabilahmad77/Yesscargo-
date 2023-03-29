@extends('layouts.yes-cargo')
@section('title','Dashboard')
@section('content')
    
  <div class="row">

    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-body">
                 <h5 class="card-title mb-0 mt-2 mb-2"> Current Rate: {{ $weightPrice[0]->price }}</h5>
                <!-- <small>Current Shipment Rate Per Kg</small>  -->
                <form action="{{ url('shipment-weight-price') }}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-6 mb-sm-0 mb-4">
                        <label for="">Current Shipment Rate Per Kg</label> 
                        <input type="number" step="any" name="price"  class="form-control" value="{{ $weightPrice[0]->price }}" />
                        
                    </div>

                    <div class="col-6 mb-sm-0  mb-4">
                         
                            <label for="">Old Shipment Rate Per Kg</label>
                        <input type="number" step="any" name="price"  class="form-control" value="{{ $weightPrice[1]->price }}" disabled readonly/>
                        
                    </div>
                    <div class="col-12 mb-sm-0 mb-4">
                        <button type="submit" class="btn btn-primary btn-block mt-3 form-control">Update</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    
    </div>

    
  </div>

      
@endsection
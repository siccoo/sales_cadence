@extends('frontend.layout.app')


@section('content')
<div class="container">


<div class="row mt-5">
<div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Add Cadence</strong>
                                    </div>
                                    <div class="card-body">
                                    <form action="{{route('add.cadence')}}" method="post">
                                        @csrf
                                        <input type="text" required name="name" class="form-control">
                                        <br/>
                                        <input type="submit" class="btn btn-success" value="Create Cadence">
                                    </form>
             
                                    </div>
                                </div>
                            </div>
</div>

</div>
@stop

@section('script')

@stop
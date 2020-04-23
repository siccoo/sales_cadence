@extends('frontend.layout.app')
@section('content')
    <div class="col-lg-8 lead-form">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2 card-header">Add Lead</h3>
                </div>
                <hr>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">First Name</label>
                        <input type="text" name="first_name" class="form-control"
                               value="{{old("first_name")}}">
                    </div>
                    <div class="form-group has-success">
                        <label for="cc-name" class="control-label mb-1">Last Name</label>
                        <input type="text" name="last_name" class="form-control"
                               value="{{old("last_name")}}">
                    </div>
                    <div class="form-group">
                        <label for="cc-number" class="control-label mb-1">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{old("email")}}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                       value="{{old("company_name")}}">
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Designation</label>
                            <div class="input-group">
                                <input type="text" name="designation" class="form-control"
                                       value="{{old("designation")}}">
                            </div>
                        </div>


                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Phone</label>
                            <div class="input-group">
                                <input type="text" name="phone" class="form-control"
                                       value="{{old("phone")}}"></div>
                        </div>

                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Category</label>
                            <select name="selectSm" id="SelectLm" class="form-control">
                                <option value="0">Please select</option>
                                <option value="1">Option #1</option>
                                <option value="2">Option #2</option>
                                <option value="3">Option #3</option>
                                <option value="4">Option #4</option>
                                <option value="5">Option #5</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

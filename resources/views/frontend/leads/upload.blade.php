@extends('.frontend.layout.app')
@section('content')
    <div class="col-lg-8 lead-form">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2 card-header">Your leads are in a spreadsheet?</h3>
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

                <form action="{{ route('leads.upload.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row lead-upload">
                        <div class="card">
                            <div class="text-center">
                                Import them all into Leads Management
                            </div>
                            <div class="text-center"><span class="zmdi zmdi-file-plus"></span></div>
                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <input type="file" name="file" class="form-control"/>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

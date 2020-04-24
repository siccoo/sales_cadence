@extends('frontend.layout.app')


@section('content')
<div class="container">


<div class="row mt-5">
<div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Email Template</strong>
                                    </div>
                                    <div class="card-body">
                                    <form action="{{route('email-template')}}" method="post">
                                    @csrf
                                        <div class="mx-auto d-block">
                                        <div class="mb-5">
                                        <label for="">Template Name</label>
                                        <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="mb-5">
                                        <label for="">Subject</label>
                                        <input type="text" name="subject" class="form-control">
                                        </div>
                                        <label for="">Message Body</label>
                                        <div class="" style="border:1px solid">
                                        <textarea name="body" id="message"></textarea>
                                        </div>

                                        </div>
                                        <div class="card-foot mt-5">
                                        <button type="reset" class="btn btn-danger">Reset Name & Subject</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>
                                      
             
                                    </div>
                                </div>
                            </div>
</div>

</div>
@stop

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
    <script>
       ClassicEditor
    .create( document.querySelector( '#message' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    </script>
@stop
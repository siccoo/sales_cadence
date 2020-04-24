@extends('frontend.layout.app')


@section('content')
<div class="container">


<div class="row mt-5">
<div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Email Template List</strong>
                                    </div>
                                    <div class="card-body">
                                    <table class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Template Name</th>
                                              <th>Template Subject</th>
                                              <th>Template Body</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse($template as $temp)
                                          <tr>
                                              <td>{{$temp->name}}</td>
                                              <td>{{$temp->subject}}</td>
                                              <td>{!!$temp->body!!}</td>
                                              <td><a href="" class="btn btn-primary">Preview template</a></td>
                                          </tr>
                                          @empty
                                          @endforelse

                                      </tbody>
</table>
             
                                    </div>
                                </div>
                            </div>
</div>

</div>
@stop

@section('script')

@stop
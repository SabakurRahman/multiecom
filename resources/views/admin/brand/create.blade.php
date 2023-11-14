@extends('admin.dashboard')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-4">
                        <div class="card-body">
                         {!! Form::open(['route'=>'brand.store', 'method'=>'post','files'=>true]) !!}
                                @include('admin.brand.form')
                             <div class="row justify-content-center">
                                <div class="col-md-3">
                                 <div class="d-grid">
                                      {!! Form::button('Create Brand ', ['class' => 'btn btn-primary mt-4', 'type'=>'submit']) !!}
                                 </div>
                             </div>
                           </div>

                      {!! Form::close() !!}
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>



@endsection

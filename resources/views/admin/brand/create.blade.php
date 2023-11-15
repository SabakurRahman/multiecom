@extends('admin.dashboard')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Brand </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Brand </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->

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

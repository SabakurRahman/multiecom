@extends('admin.dashboard')
@section('admin')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Brand</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Brand</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a type="button" href="{{route('brand.create')}}" class="btn btn-primary">Add Brand</a>


                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Brand Name </th>
                            <th>Brand Image </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $key => $item)
                            <tr>
                                <td> {{ $key+1 }} </td>
                                <td>{{ $item->brand_name }}</td>
                                <td> <img src="{{ asset(App\Models\Brand::BRAND_PHOTO_UPLOAD_PATH.$item->brand_image) }}" style="width: 70px; height:40px;" >  </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('brand.edit',$item->id) }}">
                                            <button class="btn btn-sm btn-warning mx-1">Edit</button>
                                        </a>
                                        {!! Form::open(['route'=> ['brand.destroy',  $item->id], 'method'=>'delete']) !!}
                                        {!! Form::button('delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Brand Name </th>
                            <th>Brand Image </th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>




@endsection
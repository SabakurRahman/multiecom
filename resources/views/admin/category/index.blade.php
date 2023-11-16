@extends('admin.dashboard')
@section('admin')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a type="button" href="{{route('category.create')}}" class="btn btn-primary">Add Category</a>


                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr/>
        <div class="row">
            <div class="col-xl-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $item)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$item->name}}</td>
                                    <td> <img src="{{ asset(App\Models\Category::CATEGORY_IMAGE_PATH.$item->image) }}" style="width: 70px; height:40px;" >  </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('category.edit',$item->id) }}">
                                                <button class="btn btn-sm btn-warning mx-1">Edit</button>
                                            </a>
                                            {!! Form::open(['route'=> ['category.destroy',  $item->id], 'method'=>'delete']) !!}
                                            {!! Form::button('delete', ['class' => 'btn btn-sm btn-danger delete-button', 'type' => 'submit']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>



                    </div>
                    {{ $categories->links() }}

                </div>

            </div>
        </div>






@endsection
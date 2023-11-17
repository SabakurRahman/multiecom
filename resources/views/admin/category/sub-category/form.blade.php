<!-- Enter Brand Name -->
<div class="form-group row mt-2 mb-2">
    {{ Form::label('subcategory_name', 'Enter Category Name', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'subcategory_name', 'placeholder' => 'Enter Your Name']) }}
    </div>
</div>

<div class="form-group row mt-2 mb-2">
    {{ Form::label('category_id', 'Category', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::select('category_id',$category , null, ['class' => 'form-select', 'placeholder' => 'Select Category']) }}
    </div>
</div>
<div class="form-group row mt-2 mb-2">
    {{ Form::label('status', 'Status', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::select('status',App\Models\SubCategory::STATUS_LIST ,null, ['class' => 'form-select', 'placeholder' => 'Select Status']) }}
    </div>
</div>

{{--<div class="form-group row mt-2 mb-2">--}}
{{--    <label for="category_id" class="col-sm-3 col-form-label">Category</label>--}}
{{--    <div class="col-sm-9">--}}
{{--        <select name="category_id" class="form-select" id="category_id" placeholder="Select type">--}}
{{--            <option value="" disabled selected>Select type</option>--}}
{{--            @foreach($category as $categoryId => $categoryName)--}}
{{--                <option value="{{ $categoryId }}">{{ $categoryName }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}









<!-- Enter Brand Name -->
<div class="form-group row mt-2 mb-2">
    {{ Form::label('inputEnterYourName', 'Shop Name Name', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::text('shop_name', null, ['class' => 'form-control', 'id' => 'inputEnterYourName', 'placeholder' => 'Enter Shop Name ' ,'readonly']) }}
    </div>
</div>
<div class="form-group row mt-2 mb-2">
    {{ Form::label('inputEnterYourName', 'Shop Address', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'inputEnterYourName', 'placeholder' => 'Shop address ' ,'readonly']) }}
    </div>
</div>

<!-- Status -->
<div class="form-group row mt-2 mb-2">
    {{ Form::label('status', 'Status', ['class' => 'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{ Form::select('status', \App\Models\User::STATUS_LIST, isset($vendor) ? $vendor->user->status : null, ['class' => 'form-select', 'placeholder' => 'Select type']) }}

    </div>
</div>



<!-- Photo -->
{{--<div class="form-group row">--}}
{{--    {{ Form::label('Shop Logo', 'Shop Logo', ['class' => 'col-sm-3']) }}--}}
{{--    <div class="col-sm-9 text-secondary">--}}
{{--        {{ Form::file('shop_logo', ['class' => 'form-control', 'id' => 'image']) }}--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Image Preview -->
<div class="form-group row mt-2 mb-2">
    <div class="col-sm-3">
        <h6 class="mb-0"></h6>
    </div>
    <div class="col-sm-9 text-secondary">
        <img id="showImage" src="{{ isset($vendor->shop_logo)?url(App\Models\Vendor::SHOP_PHOTO_UPLOAD_PATH.$vendor->shop_logo) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" height="100px" width="100px">
    </div>
</div>

<script>
    $(document).ready(function() {
        // Listen for changes in the file input field with id "image"
        $("#image").change(function() {
            // Get the selected file
            var file = this.files[0];

            if (file) {
                // Create a FileReader to read the selected file
                var reader = new FileReader();

                // Set up the FileReader to display the image when it's loaded
                reader.onload = function(e) {
                    $("#showImage").attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            }
        });
    });
</script>


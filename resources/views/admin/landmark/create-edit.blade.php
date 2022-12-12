<x-admin-layout title="Landmark Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $landmark ? 'Edit' : 'Add' }} Landmark">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('landmarks.index') }}" value="Landmark List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $landmark ? 'Edit' : 'Add' }} Landmark" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
        <!--begin::Form-->
        {!! Form::model($landmark, ['route' => isset($landmark) ? ['landmarks.update', $landmark->id] : ['landmarks.store'], 'id' => isset($landmark) ? 'landMarkEdit' : 'landMark', 'method' => 'post', 'class' => 'kt-form kt-form--label-right', 'files' => true]) !!}
        @if (isset($landmark))
            @method('PUT')
        @endif
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label class="label-required">Title</label>
                    {{ Form::text('title',null,$attributes = ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control','placeholder' => 'Title']) }}
                    {{-- @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                </div>
                <div class="col-lg-6 form-group">
                    <label class="label-required">Latitude</label>
                    {{ Form::text('lat',null,$attributes = ['class' => $errors->has('lat') ? 'form-control is-invalid' : 'form-control','placeholder' => 'Latitude']) }}
                    {{-- @error('lat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                </div>
                <div class="col-lg-6 form-group">
                    <label class="label-required">Longitude</label>
                    {{ Form::text('lng',null,$attributes = ['class' => $errors->has('lng') ? 'form-control is-invalid' : 'form-control','placeholder' => 'Longitude']) }}
                    {{-- @error('lng')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                </div>
                <div class="col-lg-6 form-group">
                    <label class="label-required">Address</label>
                    {{ Form::textarea('address',null,$attributes = ['class' => $errors->has('address') ? 'form-control is-invalid' : 'form-control','rows' => 3,'placeholder' => 'Address']) }}
                    {{-- @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                </div>
                <div class="col-lg-6 form-group">
                    <label class="label-required">Content</label>
                    {{ Form::textarea('content',null,$attributes = ['class' => $errors->has('content') ? 'form-control is-invalid' : 'form-control','rows' => 3,'placeholder' => 'Content']) }}
                    {{-- @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                </div>
                <div class="{{ isset($landmark->audio) ? 'col-lg-2' : 'col-lg-6' }} form-group">
                    <label class="label-required">Audio</label>
                    {{ Form::file('audio',null,$attributes = ['class' => $errors->has('audio') ? 'form-control is-invalid' : 'form-control' ]) }}
                    {{-- @if (isset($landmark))
                        @error('audio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @endif --}}
                </div>
                @if (isset($landmark->audio))
                    <div class="col-lg-4 form-group">
                        <label class=""></label>
                        <audio controls>
                            <source src="{{ url('upload/landmark/' . $landmark->audio) }}" type="audio/mp3">
                        </audio>
                    </div>
                @endif
                <div class="col-lg-12 form-group">
                    <label>Citation Information</label>
                    {{ Form::textarea('citation_info',null,$attributes = ['class' => $errors->has('citation_info') ? 'form-control is-invalid summernote' : 'form-control','rows' => 5,'placeholder' => 'Citation Information']) }}
                </div>

                <input type="hidden" name="remove_img" class="remove_img">
                <div class="col-lg-12 form-group">
                    <label class="label-required">Images (You can uploaded multiple images)</label>
                    {{ Form::file('images[]',$attributes = ['class' => $errors->has('is_featured') ? 'form-control is-invalid' : 'form-control','multiple', 'id'=> 'image', 'accept' => 'image/*']) }}
                    <div id="previous_frames">
                        @if (isset($landmark))
                            @foreach ($landmark_imgs as $landmark_img)
                                <div class="img_content"><input type="radio" name="is_featured"
                                        value="{{ $landmark_img->image }}"
                                        {{ $landmark_img->is_featured == 1 ? 'checked' : '' }}
                                        class="radio_btn"><img
                                        src="{{ url('upload/landmark/' . $landmark_img->image) }}" height="100px"
                                        class="image" /><a data-id="{{ $landmark_img->id }}"
                                        data-info="previous_img" class="remove-image galleryImg">&#215;</a></div>
                            @endforeach
                        @endif
                    </div>
                    <div id="frames">
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit"
                            class="btn btn-primary">{{ isset($landmark) ? 'Update' : 'Save' }}</button>
                        <a href="{{ route('landmarks.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
        <!--end::Form-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                $("#frames").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#frames").append(
                        '<div class ="img_content"><input type="radio" name="is_featured" value="' +
                        this.files[i].name + '" class="radio_btn"><img src="' + window.URL
                        .createObjectURL(this.files[i]) +
                        '"height="100px" class="image"/><a class="remove-image">&#215;</a></div>');
                }
            });
            var remove_ids = [];
            $(document).on("click", ".remove-image", function() {
                if ($(this).data('info') == "previous_img") {
                    remove_ids.push($(this).data('id'));
                }
                $(this).parent().remove();
                $('.remove_img').val(remove_ids);
            });

            $('.summernote').summernote({
                height: 150
            });
        });
        $(document).ready(function() {
            $("#landMark").validate({
                rules: {
                    title: {
                        required: true
                    },
                    audio: {
                        required: true
                    },
                    lat: {
                        required: true,
                        number: true
                    },
                    lng: {
                        required: true,
                        number: true
                    },
                    address: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                    is_featured: {
                        required: true
                    },
                    "images[]": {
                        required: true,
                        extension: "jpg|jpeg|png"
                    },
                },
                messages: {
                    title: {
                        required: "The title field is required",
                    },
                    audio: {
                        required: "The audio field is required",
                    },
                    lat: {
                        required: "The latitude field is required",
                    },
                    lng: {
                        required: "The longitude field is required",
                    },
                    address: {
                        required: "The address field is required",
                    },
                    content: {
                        required: "The content field is required",
                    },
                    is_featured: {
                        required: "The featured image field is required",
                    },
                    "images[]": {
                        required: "The image field is required",
                        extension: "Please upload file in these format only (jpg, jpeg, png)."
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
        $(document).ready(function(){
            $('#landMarkEdit').validate({
                  rules: {
                    title: {
                        required: true
                    },
                    audio: {
                        required: false
                    },
                    lat: {
                        required: true,
                        number: true
                    },
                    lng: {
                        required: true,
                        number: true
                    },
                    address: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                    is_featured: {
                        required: true
                    },

                },
                messages: {
                    title: {
                        required: "The title field is required",
                    },
                    audio: {
                        required: "The audio field is required",
                    },
                    lat: {
                        required: "The latitude field is required",
                    },
                    lng: {
                        required: "The longitude field is required",
                    },
                    address: {
                        required: "The address field is required",
                    },
                    content: {
                        required: "The content field is required",
                    },
                    is_featured: {
                        required: "The featured image field is required",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</x-admin-layout>

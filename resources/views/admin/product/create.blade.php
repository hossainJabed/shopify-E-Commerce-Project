@extends('master')

@section('style-lib')
    <link href="{{url('admin')}}/assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">
    <!-- This Page CSS -->
{{--    <link rel="stylesheet" href="{{url('admin')}}/assets/node_modules/summernote/dist/summernote-bs4.css">--}}
    <!-- Custom CSS -->
@endsection

@push('custom-css')
    <style type="text/css">

    </style>
@endpush

@section('body')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-secondary text-white"><span  class="text-dark fs-3">Create Product Form</span><a href="{{route('product.show')}}"  class="btn-sm btn-success float-end text-white" style="text-decoration: none !important;">Show List</a>                </div>
                    <hr/>
                    <form class="form-horizontal p-t-20" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Category Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id" id="categoryId">
                                    <option value="" disabled selected>--select Category---</option>
                                    @foreach($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Sub category Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="sub_category_id" id="subCategoryId">
                                    <option value="" disabled selected>--select SubCategory---</option>
                                    @foreach($subcategory as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Brand Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="brand_id">
                                    <option value="" disabled selected>--select Brand---</option>
                                    @foreach($brand as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Unit Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="unit_id">
                                    <option value="" disabled selected>--select Unit---</option>
                                    @foreach($unit as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputuname1" name="name" placeholder="Product Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Code <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputuname2" name="code" placeholder="Product Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Model <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputuname3" name="model" placeholder="Product Model">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Stock Amount <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                    <input type="number" class="form-control" id="exampleInputuname4" name="stock_amount" placeholder="Product Stock Amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Product Price<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="exampleInputuname4" name="regular_price" placeholder="Regular Price">
                                    <input type="number" class="form-control" id="exampleInputuname5" name="selling_price" placeholder="Selling Price">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Short Description<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea  class="form-control" id="exampleInputuname6" name="short_description" placeholder="Short Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Long Description<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea id="myTextarea" name="long_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Feature Image<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" id="input-file-now" name="image" class="dropify" accept="image/*"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Other Image<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" id="input-file-now" multiple name="other_image[]" class="dropify" accept="image/*" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">Publication Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <label class="me-3"><input type="radio" name="status" value="1" checked> Published </label>
                                <label><input type="radio" name="status" value="0"> Unpublished </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">Create New Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script-lib')

    <script src="{{url('admin')}}/assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/aioov6vhaaopv1bq5rcdn4vxudv4bamdekiu2y32i5xhtx1s/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
{{--    <script src="{{url('admin')}}/assets/node_modules/summernote/dist/summernote-bs4.min.js"></script>--}}

@endsection


@push('custom-js')
    <script>
        $(document).ready(function() {
            // $('.summernote').summernote({
            //     height: 350, // set editor height
            //     minHeight: null, // set minimum height of editor
            //     maxHeight: null, // set maximum height of editor
            //     focus: false // set focus to editable area after initializing summernote
            // });
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <script>
        $(function () {
            $(document).on('change','#categoryId',function () {
                var categoryId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('product.get-subcategory-by-category')}}",
                    data: {id:categoryId},
                    dataType: "JSON",
                    success: function (response) {
                      var option = '';

                      option += ' <option value="" disabled selected>--select SubCategory---</option>';
                      $.each(response,function (key,value) {
                          option += ' <option value="'+value.id+'"> '+value.name+'</option>';

                      });
                  var subCategoryId = $('#subCategoryId');
                  subCategoryId.empty();
                  subCategoryId.append(option);
                    }
                });

            });

        })
    </script>
    <script>
        tinymce.init({
            selector: '#myTextarea',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                title: 'My page 1',
                value: 'https://www.reflexsoftbd.com'
            },
                {
                    title: 'My page 2',
                    value: 'https://www.reflexsoftbd.com'
                }
            ],
            image_list: [{
                title: 'My page 1',
                value: 'https://www.reflexsoftbd.com'
            },
                {
                    title: 'My page 2',
                    value: 'https://www.reflexsoftbd.com'
                }
            ],
            image_class_list: [{
                title: 'None',
                value: ''
            },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                title: 'New Table',
                description: 'creates a new table',
                content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
            },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>

@endpush


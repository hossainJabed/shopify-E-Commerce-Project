@extends('master')

@section('style-lib')
    <link href="{{url('admin')}}/assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">
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
                    <div class="card-header bg-secondary text-white"><span  class="text-dark fs-3">Brand Form</span><a href="{{route('brand.show')}}"  class="btn-sm btn-success float-end text-white" style="text-decoration: none !important;">Show List</a>                    </div>
                    <hr/>
                    <form class="form-horizontal p-t-20" action="{{route('brand.update',$item->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputuname3" value="{{$item->name}}" name="name" placeholder="Brand Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">Brand Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="exampleInputuname3" name="description" placeholder="Brand Description">{{$item->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputuname3" class="col-sm-3 control-label">Brand Image <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" id="input-file-now" name="image" class="dropify" />
                                <img src="{{asset('uploded/Brand-file/'.$item->image)}}" alt="" style="height: 100px"></td>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail3" class="col-sm-3 control-label">Publication Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <label class="me-3"><input type="radio" name="status" {{$item->status == 1 ? 'checked' : ''}} value="1" checked> Published </label>
                                <label><input type="radio" name="status" {{$item->status == 0 ? 'checked' : ''}} value="0"> Unpublished </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">Update New Brand</button>
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

@endsection


@push('custom-js')
    <script>
        $(document).ready(function() {
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

@endpush



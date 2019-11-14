@extends('layout.main')

@section('title', 'Categories')

@section('styles')
<!-- Datatables -->
<link rel="stylesheet" href="{{url('datatables/jquery.dataTables.css')}}" type="text/css" />
@endsection

@section('main')

<div class="modal fade add-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-plus"></i> Create New Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="addCategoryForm" novalidate="">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Category Name<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" required="" class="form-control validate[required]" data-errormessage-value-missing="Category Name is required!" name="name" id="inputName" placeholder="Category Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-7">
                            <textarea required="" class="form-control " name="description" id="inputDescription" placeholder="Category Description"></textarea>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="button" id="saveCategory" class="btn btn-primary waves-effect waves-light mr-1">
                                Save
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-edit"></i> Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="loader-cat" style="display: none">
                    <center>
                        <img src="{{url('assets/images/loader.gif')}}" />
                    </center>
                </div>

                <div id="editor-cat"></div>

            </div>
        </div>
    </div><!-- /.modal-content -->
</div>
<div class="row">
    <div class="col-8">
        <div class="page-title-box">
            <div class="page-title-right">
                <button class="btn btn-primary waves-effect waves-light" data-plugin="custommodal" data-overlaycolor="#38414a data-animation=" fadein" data-toggle="modal" data-target=".add-modal"><i class="fa fa-plus"></i> Add Category</button>
            </div>
            <h4 class="page-title"><i class="fa fa-th"></i> Categories</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8">

        @include('partials._error')
        @include('partials._success')

        <div class="card">
            <div class="card-body">
                <table id="dataTb" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php $categories = \App\Category::orderBy('id', 'DESC')->get();
                        $i = 1; ?>
                        @foreach($categories as $c)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->description}}</td>
                            <td>{!! hca($c->created_at) !!}</td>
                            <td>{!! hs($c->active ) !!}</td>
                            <td>
                                <p>
                                    <span style="cursor: pointer" route="{{route('app.categories.edit', $c->id)}}" data-toggle="modal" data-target=".edit-modal" class="editCategory">
                                        <i class="fa fa-edit" data-toggle="tooltip" title="Edit Category"></i>
                                    </span>
                                    <span style="padding-left: 12px; cursor: pointer" route="{{route('app.categories.delete', $c->id)}}" class="deleteCategory">
                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete Category"></i>
                                    </span>
                                    <span data-toggle="tooltip" tip="{{$c->active == 1 ? 'Block Category' : 'Activate Category'}}" title="{{$c->active == 1 ? 'Block Category' : 'Activate Category'}}" style="padding-left: 12px; cursor: pointer" route="{{route('app.categories.change.status', $c->id)}}" class="activateCategory">
                                        <i class="fa fa-{{$c->active == 1 ? 'unlock' : 'lock'}}"></i>
                                    </span>
                                </p>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div>
    </div>
</div>
@endsection

@section('scripts')




<script src="{{url('datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('datatables/dataTables.bootstrap4.js')}}"></script>

<script>
    $(function() {
        $('#dataTb').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        $('body').on('click', '#saveCategory', function() {
            var valid = $("#addCategoryForm").validationEngine('validate');
            if (valid) {
                $('#addCategoryForm').css('opacity', 0.2);
                var data = $('#addCategoryForm').serializeArray();
                Biggo.talkToServer('{{route("app.categories.save")}}', data, false).then(function(res) {
                    $('#addCategoryForm').css('opacity', 1);
                    if (res.error) {
                        Biggo.showFeedBack(addCategoryForm, res.msg, res.error);
                    } else {
                        window.location = "{{route('app.redirectWith')}}";
                    }
                });
            }
        });

        $('body').on('click', '.deleteCategory', function() {
            var route = $(this).attr('route');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {

                if (result.value) {
                    $.post(route, {
                        _token: '{{csrf_token()}}'
                    }, function() {
                        if (result.value) {
                            window.location = "{{route('app.redirectWith.delete')}}";
                        }
                    });
                }

            });
        });

        $('body').on('click', '.editCategory', function() {
            var route = $(this).attr('route');
            $('#editor-cat').html('');
            $('#loader-cat').css('display', 'block');
            $.get(route, function(view) {
                $('#loader-cat').css('display', 'none');
                $('#editor-cat').html(view);
            });
        });

        $('body').on('click', '#updateCategory', function() {
            var valid = $("#updateCategoryForm").validationEngine('validate');
            if (valid) {
                $('#updateCategoryForm').css('opacity', 0.2);
                var data = $('#updateCategoryForm').serializeArray();
                Biggo.talkToServer('{{route("app.categories.update")}}', data, false).then(function(res) {
                    $('#updateCategoryForm').css('opacity', 1);
                    if (res.error) {
                        Biggo.showFeedBack(addCategoryForm, res.msg, res.error);
                    } else {
                        window.location = "{{route('app.redirectWith')}}";
                    }
                });
            }
        });

        $('body').on('click', '.activateCategory', function() {
            var route = $(this).attr('route');
            var title = $(this).attr('tip');

            Swal.fire({
                title: 'Are you sure?',
                text: "You will " + title,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: title
            }).then(function(result) {

                if (result.value) {
                    $.post(route, {
                        _token: '{{csrf_token()}}',
                        title: title
                    }, function() {
                        if (result.value) {
                            window.location = "{{route('app.redirectWith')}}";
                        }
                    });
                }

            });
        });

    });
</script>
@endsection
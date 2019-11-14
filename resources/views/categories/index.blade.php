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
                <form role="form" novalidate="">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Category Name<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" required="" class="form-control " id="inputName" placeholder="Category Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-7">
                            <textarea required="" class="form-control " id="inputDescription" placeholder="Category Description"></textarea>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
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
    });
</script>
@endsection
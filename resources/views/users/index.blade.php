@extends('layout.main')

@section('title', 'Users')

@section('styles')
<!-- Datatables -->
<link rel="stylesheet" href="{{url('datatables/jquery.dataTables.css')}}" type="text/css" />
@endsection

@section('main')

<div class="modal fade edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-edit"></i> Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div id="loader" style="display: none">
                        <center>
                            <img src="{{url('assets/images/loader.gif')}}" />
                        </center>
                    </div>

                    <div id="editor"></div>
                </div>
            </div>


            </form>

        </div>
    </div>
</div>

<div class="modal fade change-user-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-key"></i> Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div id="loader-pass" style="display: none">
                        <center>
                            <img src="{{url('assets/images/loader.gif')}}" />
                        </center>
                    </div>

                    <div id="editor-pass"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade add-user-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-plus"></i> Create New User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="addUserForm" novalidate="">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Name<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" required="" class="form-control validate[required]" data-errormessage-value-missing="Name is required!" name="name" id="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" required="" class="form-control validate[required,custom[email]]" data-errormessage-value-missing="Email is required!" name="email" id="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Role<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select class="form-control validate[required]" data-errormessage-value-missing="Role is required!" name="role" id="role">
                                <option value="">--SELECT ROLE--</option>
                                <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                                <option value="END_USER">END-USER</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="password" required="" class="form-control validate[required]" data-errormessage-value-missing="Password is required!" name="upassword" id="upassword" placeholder="Enter New Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cpassword" class="col-sm-4 col-form-label">Confirm Password<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="password" required="" class="form-control validate[required,equals[upassword]]" data-errormessage-value-missing="Confirm Password is required!" name="ucpassword" id="ucpassword" placeholder="Enter Confirm Password">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="button" id="saveUser" class="btn btn-primary waves-effect waves-light mr-1">
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
                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".add-user-modal"><i class="fa fa-plus"></i> Add User</button>
            </div>
            <h4 class="page-title"><i class="fa fa-users"></i> Users</h4>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php $users = \App\User::orderBy('id', 'DESC')->where('id', '!=', auth()->user()->id)->get();
                        $i = 1; ?>
                        @foreach($users as $u)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>
                                @if($u->role == \App\User::ADMINISTRATOR)
                                <label class="badge badge-success">{{$u->role}}</label>
                                @else
                                <label class="badge badge-primary">{{$u->role}}</label>
                                @endif
                            </td>
                            <td>{!! hca($u->created_at) !!}</td>
                            <td>{!! hs($u->active ) !!}</td>
                            <td>
                                <p>
                                    <span style="cursor: pointer" route="{{route('app.users.edit', $u->id)}}" data-toggle="modal" data-target=".edit-modal" class="editUser">
                                        <i class="fa fa-edit" data-toggle="tooltip" title="Edit User"></i>
                                    </span>
                                    <span style="padding-left: 12px; cursor: pointer" route="{{route('app.users.delete', $u->id)}}" class="deleteUser">
                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete User"></i>
                                    </span>
                                    <span data-toggle="tooltip" tip="{{$u->active == 1 ? 'Block User' : 'Activate User'}}" title="{{$u->active == 1 ? 'Block User' : 'Activate User'}}" style="padding-left: 12px; cursor: pointer" route="{{route('app.users.change.status', $u->id)}}" class="activateUser">
                                        <i class="fa fa-{{$u->active == 1 ? 'unlock' : 'lock'}}"></i>
                                    </span>
                                    <span data-toggle="tooltip" title="Change Password" style="padding-left: 12px; cursor: pointer" route="{{route('app.users.change.password', $u->id)}}" class="changeUserPassword">
                                        <i data-toggle="modal" data-target=".change-user-password" class="fa fa-key"></i>
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
    });

    $('body').on('click', '#saveUser', function() {
        var valid = $("#addUserForm").validationEngine('validate');
        if (valid) {
            $('#addUserForm').css('opacity', 0.2);
            var data = $('#addUserForm').serializeArray();
            Biggo.talkToServer('{{route("app.users.save")}}', data, false).then(function(res) {
                $('#addUserForm').css('opacity', 1);
                if (res.error) {
                    Biggo.showFeedBack(addUserForm, res.msg, res.error);
                } else {
                    window.location = "{{route('app.redirectWith')}}";
                }
            });
        }
    });

    $('body').on('click', '.activateUser', function() {
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

    $('body').on('click', '#saveUserPassword', function() {
        var valid = $("#passwordUserChangeForm").validationEngine('validate');
        if (valid) {
            // change the personal info now!!
            $('#passwordUserChangeForm').css('opacity', 0.2);

            var data = Biggo.serializeData(passwordUserChangeForm);

            Biggo.talkToServer('{{route("app.users.change.password.save")}}', data, false).then(function(res) {
                $('#passwordUserChangeForm').css('opacity', 1);
                if (res.error) {
                    Biggo.showFeedBack(passwordUserChangeForm, res.msg, res.error);
                } else {
                    window.location = "{{route('app.redirectWith')}}";
                }

            });
        }
    });

    $('body').on('click', '.changeUserPassword', function() {
        $('#loader-pass').css('display', 'block');
        var route = $(this).attr('route');
        $.get(route, function(res) {
            $('#loader-pass').css('display', 'none');
            $('#editor-pass').html(res);
        });
    });

    $('body').on('click', '#updateUser', function() {
        var valid = $("#updateUserForm").validationEngine('validate');
        if (valid) {
            // change the personal info now!!
            $('#updateUserForm').css('opacity', 0.2);

            var data = $('#updateUserForm').serializeArray();

            Biggo.talkToServer('{{route("app.users.update")}}', data, false).then(function(res) {
                $('#updateUserForm').css('opacity', 1);
                if (res.error) {
                    Biggo.showFeedBack(updateUserForm, res.msg, res.error);
                } else {
                    window.location = "{{route('app.redirectWith')}}";
                }

            });
        }
    });

    $('body').on('click', '.editUser', function() {
        var route = $(this).attr('route');
        $('#editor').html('');
        $('#loader').css('display', 'block');
        $.get(route, function(view) {
            $('#loader').css('display', 'none');
            $('#editor').html(view);
        });
    });

    $('body').on('click', '.deleteUser', function() {
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
</script>
@endsection
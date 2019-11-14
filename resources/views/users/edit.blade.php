<form data-parsley-validate class="form-horizontal form-label-left" id="updateUserForm">

    {{csrf_field()}}

    <input type="hidden" id="id" name="id" value="{{$user->id}}" />

    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Name<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" required="" value="{{$user->name}}" class="form-control validate[required]" data-errormessage-value-missing="Name is required!" name="name" id="name" placeholder="Enter Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" required="" value="{{$user->email}}" class="form-control validate[required,custom[email]]" data-errormessage-value-missing="Email is required!" name="email" id="email" placeholder="Enter Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Role<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <select class="form-control validate[required]" data-errormessage-value-missing="Role is required!" name="role" id="role">
                @if($user->role == \App\User::ADMINISTRATOR)
                <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                <option value="END_USER">END-USER</option>
                @else
                <option value="END_USER">END-USER</option>
                <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                @endif
            </select>
        </div>
    </div>

    <div class="ln_solid"></div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="updateUser" class="btn btn-primary">Save changes</button>
    </div>


</form>
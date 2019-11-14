<form role="form" id="passwordUserChangeForm">

    <input type="hidden" name="userId" id="userId" value="{{$id}}" />

    {{csrf_field()}}

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="validate[required] form-control" data-errormessage-value-missing="Password is required!" id="cupassword" value="" name="password" placeholder="Enter Password">
    </div>
    <div class="form-group">
        <label for="cpassword">Confirm Password:</label>
        <input type="password" class="validate[required,equals[cupassword]] form-control" data-errormessage-value-missing="Confirm password is required!" id="cucpassword" value="" name="cpassword" placeholder="Enter Confirm Password">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="saveUserPassword" class="btn btn-primary">Save changes</button>
    </div>

</form>
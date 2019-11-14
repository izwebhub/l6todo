<form role="form" id="updateCategoryForm" novalidate="">
    {{csrf_field()}}

    <input type="hidden" name="catId" value="{{$category->id}}" />

    <div class="form-group row">
        <label for="inputName" class="col-sm-4 col-form-label">Category Name<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" required="" value="{{$category->name}}" class="form-control validate[required]" data-errormessage-value-missing="Category Name is required!" name="name" id="inputName" placeholder="Category Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDescription" class="col-sm-4 col-form-label">Description</label>
        <div class="col-sm-7">
            <textarea required="" value="" class="form-control " name="description" id="inputDescription" placeholder="Category Description">{{$category->description}}</textarea>
        </div>
    </div>
    <hr />
    <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
            <button type="button" id="updateCategory" class="btn btn-primary waves-effect waves-light mr-1">
                Save
            </button>
            <button type="reset" class="btn btn-secondary waves-effect waves-light">
                Cancel
            </button>
        </div>
    </div>
</form>
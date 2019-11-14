<form role="form" id="updateTodoForm" novalidate="">
    {{csrf_field()}}

    <input type="hidden" id="todo_id"  name="todo_id" value="{{$todo->id}}" />

    <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label">Title<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" value="{{$todo->title}}" required="" class="form-control validate[required]" data-errormessage-value-missing="Title is required!" name="title" id="title" placeholder="Enter Title">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-4 col-form-label">Description</label>
        <div class="col-sm-7">
            <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{$todo->description}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Category<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <select class="form-control validate[required]" data-errormessage-value-missing="Category is required!" name="category" id="category">
                <option value="{{$todo->category_id}}">{{\App\Category::find($todo->category_id)->name}}</option>
                @foreach(\App\Category::where('active', 1)->where('id', '!=', $todo->category_id)->get() as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label">Start Date<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <div class="input-group">
                <input type="text" value="{{$todo->start_date}}" class="form-control validate[required]" data-errormessage-value-missing="Start Date is required!" id="startDate" name="startDate" data-provide="datepicker" data-date-autoclose="true">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="ti-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label ">End Date<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <div class="input-group">
                <input type="text" value="{{$todo->due_date}}" class="form-control validate[required]" id="endDate" data-errormessage-value-missing="End Date is required!" name="endDate" data-provide="datepicker" data-date-autoclose="true">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="ti-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>

    <hr />
    <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
            <button type="button" id="updateTodo" class="btn btn-primary waves-effect waves-light mr-1">
                Save
            </button>
            <button type="reset" class="btn btn-secondary waves-effect waves-light">
                Cancel
            </button>
        </div>
    </div>
</form>
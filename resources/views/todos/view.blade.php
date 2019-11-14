<form role="form" id="addTodoForm" novalidate="">
    {{csrf_field()}}
    <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label">Title<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <p>{{$todo->title}}</p>
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-4 col-form-label">Description</label>
        <div class="col-sm-7">
            <p>{{$todo->description}}</p>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Category<span class="text-danger">*</span></label>
        <div class="col-sm-7">

            <p> {{ \App\Category::find($todo->category_id)->name }} </p>

        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label">Start Date<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <div class="input-group">
                <p>{{$todo->start_date}}</p>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label ">End Date<span class="text-danger">*</span></label>
        <div class="col-sm-7">
            <div class="input-group">
                <p>{{$todo->due_date}}</p>
            </div>
        </div>
    </div>

    <hr />
    
</form>
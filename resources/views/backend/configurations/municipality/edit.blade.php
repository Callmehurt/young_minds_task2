<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Edit </h3>

    </div>
    <div class="box-body">
        {!! Form::model($edits,['method'=>'PUT','route'=>['municipality.update',$edits->id],'enctype'=>'multipart/form-data']) !!}
        <div class="form-group {{ ($errors->has('district_id'))?'has-error':'' }}">
            <label>District Name</label>
            {{Form::select('district_id',$district->pluck('nepali_name','id'),Request::get('district_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'district_id','placeholder'=>
            'Select District Name'])}}
            {!! $errors->first('district_id', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('muni_type_id'))?'has-error':'' }}">
            <label>Municipality Type Name</label>
            {{Form::select('muni_type_id',$muniType->pluck('muni_type_name','id'),Request::get('muni_type_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'muni_type_id','placeholder'=>
            'Select Municipality Type Name'])}}
            {!! $errors->first('muni_type_id', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('muni_code'))?'has-error':'' }}">
            <label>Municipality Code
            </label>
        {!! Form::text('muni_code',null,['class'=>'form-control','placeholder' => 'Example:001']) !!}
        {!! $errors->first('muni_code', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>

        <div class="form-group {{ ($errors->has('muni_name'))?'has-error':'' }}">
            <label>Municipality Name
            </label>
        {!! Form::text('muni_name',null,['class'=>'form-control','placeholder' => 'Example:Balaju']) !!}
        {!! $errors->first('muni_name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>

        <div class="form-group {{ ($errors->has('muni_name_en'))?'has-error':'' }}">
            <label>Municipality English Name
            </label>
        {!! Form::text('muni_name_en',null,['class'=>'form-control','placeholder' => 'Example:Balaju']) !!}
        {!! $errors->first('muni_name_en', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>

        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Update</button>
                {{--<button type="submit" class="btn btn-default bg-green">Save & Add New</button>--}}

            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>
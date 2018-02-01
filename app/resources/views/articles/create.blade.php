@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6 ">
                <form method="POST" action="/articles" id="edit-article" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group  {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                               value="{{ old('title') ? old('title') : '' }}">
                        @if ($errors->has('title'))
                            <span class="error help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group  {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" placeholder="Enter description"
                                  name="description"
                                  rows="15">{{ old('description') ? old('description') : '' }}</textarea>
                        @if ($errors->has('description'))
                            <span class="error help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group  {{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date">Date:</label>

                        <div class='input-group date' id='datetimepicker1'>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                            <input name="date" type="text" id="datetimepicker" class="form-control"
                                   value="{{ old('date') ? old('date') : '' }}"/>
                        </div>

                        @if ($errors->has('date'))
                            <span class="error help-block">{{ old('date') ? old('date') : $errors->first('date') }}</span>
                        @endif
                    </div>

                    <div class="form-group  {{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="url">Original Source:</label>
                        <input type="text" class="form-control" id="description" placeholder="Enter Original Source URL"
                               name="url" value="{{ old('url') ? old('url') : '' }}">
                        @if ($errors->has('url'))
                            <span class="error help-block">{{ $errors->first('url') }}</span>
                        @endif
                    </div>


                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="edit-image">Image</label>
                        <div>
                            <label class="btn-bs-file btn btn-default">
                                <input name="image" type="file" accept=".jpg, .jpeg, .png">
                            </label>
                        </div>
                        @if ($errors->has('image'))
                            <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="col-xs-12 text-right">
                        <button type="reset" class="btn btn-md btn-default" id="cancel">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-md btn-primary" id="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
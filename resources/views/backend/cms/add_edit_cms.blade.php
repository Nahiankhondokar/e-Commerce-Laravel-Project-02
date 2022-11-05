@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inventory Features</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CMS Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('cms.add.edit', @$edit_data -> id ?? '') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label>CMS Page Title</label><br>
                        <input type="text" class="form-control" placeholder="CMS Page Title" name="title" @if(@$edit_data -> title) value="{{$edit_data -> title}}" @endif>
                        @error('title')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>CMS Page Description</label><br>
                        <textarea placeholder="CMS Page Description" name="desc" style="width: 100%" >{{ @$edit_data -> desc }}</textarea>
                        @error('desc')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>CMS Page URL</label><br>
                        <input type="text" class="form-control" placeholder="CMS Page URL" name="url" @if(@$edit_data -> url) value="{{$edit_data -> url}}" @endif>
                        @error('url')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                 
                </div>
                
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Meta Title</label><br>
                        <input type="text" class="form-control" placeholder="CMS Page Description" name="meta_title" @if(@$edit_data -> title) value="{{$edit_data -> title}}" @endif>
                        @error('meta_title')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label><br>
                        <input type="text" class="form-control" placeholder="CMS Page Description" name="meta_desc" @if(@$edit_data -> desc) value="{{$edit_data -> desc}}" @endif>
                        @error('meta_desc')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Meta Keyword</label><br>
                        <input type="text" class="form-control" placeholder="CMS Page Description" name="meta_keyword" @if(@$edit_data -> url) value="{{$edit_data -> url}}" @endif>
                        @error('meta_keyword')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                 
                </div>

                <button type="submit" class="btn btn-primary">{{ (@$edit_data) ? "Update" : "Submit" }}</button>

              </div>
              <!-- /.row -->
            </form>
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
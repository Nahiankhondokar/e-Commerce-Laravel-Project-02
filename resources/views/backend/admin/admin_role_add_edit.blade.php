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
              <li class="breadcrumb-item active">Admin or Sub-Admin</li>
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
            <form action="{{ route('admin.role.add.edit', $edit -> id ?? '') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Admin Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" @if(!empty(@$edit -> name)) value="{{ $edit -> name }}" @else value="{{ old('name') }}" @endif>

                    @error('name')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Admin Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone" @if(!empty(@$edit -> phone)) value="{{ $edit -> phone }}" @else value="{{ old('phone') }}" @endif>

                    @error('phone')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Admin Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password">

                    @error('password')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  

                </div>
                <!-- /.col -->
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" @if(!empty(@$edit -> email)) value="{{ $edit -> email }}" @else value="{{ old('email') }}" @endif @if(@$edit -> email) readonly @endif>
    
                        @error('email')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                  <div class="form-group">
                    <label>Admin Type Select</label>
                    <select class="form-control" style="width: 100%;" name="type" @if(@$edit -> type) disabled @else required @endif>
                      <option value="" selected > -Select- </option>
                      <option value="admin" @if(@$edit -> type == 'admin') selected @endif> Admin</option>
                      <option value="subadmin" @if(@$edit -> type == 'subadmin') selected @endif> Sub Admin</option>
                      <option value="modarator" @if(@$edit -> type == 'modarator') selected @endif> Modarator</option>
                    </select>
                    @error('type')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="exampleInputFile">Admin Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="main_image" name="photo">
                        <label class="custom-file-label" for="main_image">Choose file</label>
                      </div>
                      
                      <input type="hidden" name="old_img" @if(!empty(@$edit -> profile_photo_path)) value="{{ $edit -> profile_photo_path }}" @endif> 
                    </div>
                  </div>
                  
                  <!-- /.form-group -->

                  
                </div>
                <!-- /.col -->
                <button type="submit" class="btn btn-primary">{{ ($edit) ? "Update" : "Submit" }}</button>

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
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
              <li class="breadcrumb-item active">Category</li>
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
            <h3 class="card-title">Add Category</h3>

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
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Category">
                    @error('category_name')
                      <span class="text-danger">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <!-- /.form-group -->
                  <div id="appendCategoriesLavel">
                    @include('backend.category.append_category_view')
                   </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Category Discount</label>
                    <input type="text" class="form-control" name="category_discount" placeholder="Category Discount">
                  </div>
                  <div class="form-group">
                    <label>Category Discription</label><br>
                    <textarea name="description" id="" style="width: 100%;" rows="2" placeholder="Description. . ."></textarea>
                  </div>
                  <div class="form-group">
                    <label>Meta Keywords</label><br>
                    <textarea name="meta_keyword" id="" style="width: 100%;" rows="2" placeholder="Description. . ."></textarea>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select Sections</label>
                    <select id="categorySection" class="form-control select2" style="width: 100%;" name="section_id">
                      <option value="" selected > -Select- </option>
                      @foreach($sections as $item)
                      <option value="{{ $item -> id }}">{{ ucwords($item -> name) }}</option>
                      @endforeach
                    </select>
                    @error('section_id')
                      <span class="text-danger">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="exampleInputFile">Categroy Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="category_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Category URL</label>
                    <input type="text" class="form-control" name="url" placeholder="url">
                  </div>
                  <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" placeholder="meta_title">
                  </div>
                  <div class="form-group">
                    <label>Meta Description</label><br>
                    <textarea name="meta_description" id="" style="width: 100%;" rows="2" placeholder="Description. . ."></textarea>
                  </div>
                  
                </div>
                <!-- /.col -->
                <button type="submit" class="btn btn-primary">Submit</button>

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
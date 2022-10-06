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
              <li class="breadcrumb-item active">Product</li>
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
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" placeholder="product">
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Product Price</label>
                    <input type="text" class="form-control" name="product_discount" placeholder="product Discount">
                  </div>
                  <div class="form-group">
                    <label>Product Discount (%)</label>
                    <input type="text" class="form-control" name="product_discount" placeholder="product Discount">
                  </div>
                  <div class="form-group">
                    <label>Product Color</label>
                    <input type="text" class="form-control" name="product_discount" placeholder="product Discount">
                  </div>
                  
                  <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" placeholder="meta_title">
                  </div>

                  <div class="form-group">
                    <label>Product Fabric</label>
                    <select id="" class="form-control select2" style="width: 100%;" name="fabric">
                      <option value="" selected > -Select- </option>
                      @foreach($fabricArr as $item)
                      <option value="{{ $item }}">{{ ucwords($item) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Product Fit</label>
                    <select id="" class="form-control select2" style="width: 100%;" name="fit">
                        <option value="" selected > -Select- </option>
                        @foreach($fitArr as $item)
                        <option value="{{ $item }}">{{ ucwords($item) }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label>Product Discription </label><br>
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
                    <label>Select Category</label>
                    <select id="productSection" class="form-control select2" style="width: 100%;" name="section_id">
                      <option value="" selected > -Select- </option>
                      @foreach($section as $item)
                      <optgroup label="{{ ucwords($item -> name) }}"></optgroup>
                            @foreach($item['getCategory'] as $cat)
                            <option value="{{ $cat -> id }}"> &nbsp; -- &nbsp; {{ ucwords($cat -> category_name) }}</option>
                                @foreach($cat['subcategories'] as $subcat)
                                    <option value="{{ $subcat -> id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- &nbsp;{{ ucwords($subcat -> category_name) }}</option>
                                @endforeach
                            @endforeach
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="product_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="product_video">Product Video</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_video" name="product_video">
                        <label class="custom-file-label" for="product_video">Choose Video</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <!-- /.form-group -->

                  <div class="form-group">
                    <label>Product Weight</label>
                    <input type="text" class="form-control" name="product_discount" placeholder="product Discount">
                  </div>

                  <div class="form-group">
                    <label>Product Pattern</label>
                    <select id="" class="form-control select2" style="width: 100%;" name="fabric">
                        <option value="" selected > -Select- </option>
                        @foreach($patternArr as $item)
                        <option value="{{ $item }}">{{ ucwords($item) }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Product Ocassion</label>
                    <select id="" class="form-control select2" style="width: 100%;" name="ocassion">
                        <option value="" selected > -Select- </option>
                        @foreach($ocassionArr as $item)
                        <option value="{{ $item }}">{{ ucwords($item) }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label>Product Wash</label>
                    <textarea name="wash_care" id="" style="width: 100%;" rows="2" placeholder="product wash. . ."></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label>Meta Description</label><br>
                    <textarea name="meta_description" id="" style="width: 100%;" rows="2" placeholder="Description. . ."></textarea>
                  </div>

                  <div class="form-group">
                    <label>Featured Item</label><br>
                    <input type="checkbox" id="is_featured" name="is_featured" class="form-control-checkbox" value="1">
                    <label for="is_featured">Featured Product</label>
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
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
              <li class="breadcrumb-item active">Product Galllery</li>
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
            <h3 class="card-title">Product Galllery</h3>

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
            <form action="{{ route('product.gallery.add', $product -> id ?? '') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Product Name : <strong>{{ $product -> product_name }}</strong> </label>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Product Price : <strong>{{ $product -> product_price }}</strong> </label>
                  </div>
                  
                  <div class="form-group">
                    <label>Product Color : <strong>{{ $product -> product_color }}</strong> </label>
                  </div>
                  
                  <div class="form-group">
                    <label>Product Code : <strong>{{ $product -> product_code }}</strong> </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="form-group">
                    <div class="input-group">

                        @if(@$product -> main_image)
                        <img src="{{ URL::to('')}}/media/backend/product/large/{{ $product -> main_image }}" alt="" style="width: 150px; height: 150px;" class="shadow"> 
                        @else
                        <img src="{{ URL::to('')}}/media/no_image.jpg" alt="" style="width: 150px; height: 150px;" class="shadow">
                        @endif
                    </div>
                  </div>
                  
                  
                </div>
                <!-- /.col -->
               

              </div>
              <!-- /.row 1 -->

              <div class="row">
                <div class="col-md-4">
                  <label for="">Add Galllery Images</label>
                  <input multiple type="file" name="gallery[]" class="form-control">
                </div>
              </div>

              <br>
              <button type="submit" class="btn btn-primary">Add Galllery</button>

            </form>
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>

        <!-- show product Galllerys -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Product Galllery Images</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="category" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Gallery Images</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($product -> getProductGallery as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>
                        <img style="width: 60px;" src="{{URL::to('')}}/media/backend/product/gallery/{{ $item -> images }}" alt="" />
                      </td>
                      <td>

                        @if($item -> status == 1)
                        <div class="productGallActiveInactive" id="product_gall-{{$item -> id}}" product_gall="{{ $item -> id }}">
                          <a id="product_gall_active-btn-{{$item -> id}}" class="badge badge-success" href="javascript:void(0)">Active</a>
                        </div>
                        @else 
                        <div class="productGallActiveInactive" id="product_gall-{{$item -> id}}" product_gall="{{ $item -> id }}">
                          <a id="product_gall_inactive-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)">Inactive</a>
                        </div>
                        @endif

                      </td>

                      <td>
                        <a id="delete" href="{{ route('product.gallery.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                      </td>

                    </tr>
                  @endforeach
                  </tbody>
                </table>

              </div>
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>

@endsection
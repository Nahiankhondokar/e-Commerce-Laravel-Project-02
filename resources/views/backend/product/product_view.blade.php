@extends('backend.admin_master')

@section('admin')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invertory Features</h1>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Product</h3>
                <a href="{{ route('product.add.edit') }}" class="btn btn-info float-right">Add Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="category" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Color</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($product as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ ucwords($item -> product_name) }}</td>
                      <td>{{ ucwords($item -> product_code) }}</td>
                      <td>{{ ucwords($item -> product_color) }}</td>
                      <td>{{ ucwords($item -> getCategory -> category_name) }}</td>
                      <td>{{ ucwords($item -> getSection -> name) }}</td>

                      @php
                          $image_path = "media/product/large/".$item -> main_image;
                      @endphp

                      <td>
                        @if(!empty($item -> main_image))

                          <img style="width: 40px" src="{{URL::to('')}}/media/backend/product/large/{{$item -> main_image}}" alt="">

                        @elseif(empty(file_exists("{{ URL::to('') }}/media/backend/product/large/{{ $item -> main_image }}")))
                          <img style="width: 40px" src="{{URL::to('')}}/media/no_image.jpg" alt="">
                        @elseif(empty($item -> main_image))
                          <img style="width: 40px" src="{{URL::to('')}}/media/no_image.jpg" alt="">
                        @endif
                      </td>

                      
                      <td>
                        @if($productModule['edit_access'] == 1 || $productModule['full_access'] == 1)
                          @if($item -> status == 1)
                          <div class="productActiveInactive" id="product-{{$item -> id}}" product_id="{{ $item -> id }}">
                            <a id="product_active-btn-{{$item -> id}}" class="badge badge-success" href="javascript:void(0)">Active</a>
                          </div>
                          @else 
                          <div class="productActiveInactive" id="product-{{$item -> id}}" product_id="{{ $item -> id }}">
                            <a id="product_inactive-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)">Inactive</a>
                          </div>
                          @endif
                        @else 
                          <span style="color: red">No Access</span>

                        @endif

                      </td>

                      <td width="140px">
                        @if($productModule['edit_access'] == 1 || $productModule['full_access'] == 1)
                          <a title="Product Attribute" href="{{ route('product.add.edit.attr', $item -> id) }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></a>

                          <a title="Add Gallery" href="{{ route('product.gallery.add', $item -> id) }}" class="btn btn-sm btn-primary"><i class="fa fa-image"></i></a>

                          <a title="Edit" href="{{ route('product.add.edit', $item -> id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

                          @if($productModule['full_access'] == 1)
                          <a title="Delete" id="delete" href="{{ route('category.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          @endif

                        @else 
                          <span style="color: red">No Access</span>
                        @endif
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
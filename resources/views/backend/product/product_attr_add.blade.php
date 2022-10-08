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
              <li class="breadcrumb-item active">Product Attribute</li>
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
            <h3 class="card-title">Product Attribute</h3>

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
            <form action="{{ route('product.add.edit.attr', $edit_product -> id ?? '') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Product Name : <strong>{{ $edit_product -> product_name }}</strong> </label>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Product Price : <strong>{{ $edit_product -> product_price }}</strong> </label>
                  </div>
                  
                  <div class="form-group">
                    <label>Product Color : <strong>{{ $edit_product -> product_color }}</strong> </label>
                  </div>
                  
                  <div class="form-group">
                    <label>Product Code : <strong>{{ $edit_product -> product_code }}</strong> </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="form-group">
                    <div class="input-group">

                        @if(@$edit_product -> main_image)
                        <img src="{{ URL::to('')}}/media/backend/product/large/{{ $edit_product -> main_image }}" alt="" style="width: 150px; height: 150px;" class="shadow"> 
                        @else
                        <img src="{{ URL::to('')}}/media/no_image.jpg" alt="" style="width: 150px; height: 150px;" class="shadow">
                        @endif
                    </div>
                  </div>
                  
                  
                </div>
                <!-- /.col -->
               

              </div>
              <!-- /.row 1 -->

              <!-- Add new item by jQuery -->
              <div class="row">
                <div class="col-lg-6 m-auto">
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="text" name="size[]" class="form-control m-input" placeholder="Size" autocomplete="off">
                            <input type="number" name="price[]" class="form-control m-input" placeholder="Price" autocomplete="off">
                            <input type="number" name="stock[]" class="form-control m-input" placeholder="Stock" autocomplete="off">
                            <input type="text" name="sku[]" class="form-control m-input" placeholder="SKU" autocomplete="off">
                            <div class="input-group-append">
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>
        
                    <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                </div>
              </div>
              <!-- /.row 2 -->
              <br>
              <button type="submit" class="btn btn-primary">Add Attribute</button>

            </form>
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>

        <!-- show product attributes -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Product Attributes</h3>
              
              </div>
              <!-- /.card-header -->
              <form action="{{ route('product.attr.update') }}" method="POST">
                @csrf
                <div class="card-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>SR</th>
                      <th>Size</th>
                      <th>Stock</th>
                      <th>Price</th>
                      <th>SKU</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($edit_product -> getProductAttr as $key => $item)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ ucwords($item -> size) }}</td>
                        <td>
                          <input type="hidden" name="attrId[]" value="{{ $item -> id}}">
                          <input type="number" name="stock[]" value="{{ $item -> stock}}">
                        </td>
                        <td>
                          <input type="number" name="price[]" value="{{ $item -> price }}">
                        </td>
                        <td>{{ $item -> sku }}</td>
  
                        
                        <td>
                          @if($item -> status == 1)
                          <div class="productAttrActiveInactive" id="product_attr-{{$item -> id}}" product_attr="{{ $item -> id }}">
                            <a id="product_attr_active-btn-{{$item -> id}}" class="badge badge-success" href="javascript:void(0)">Active</a>
                          </div>
                          @else 
                          <div class="productAttrActiveInactive" id="product_attr-{{$item -> id}}" product_attr="{{ $item -> id }}">
                            <a id="product_attr_inactive-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)">Inactive</a>
                          </div>
                          @endif
  
                        </td>
  
                        <td>
                          <a id="delete" href="{{ route('product.attr.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
  
                      </tr>
                    @endforeach
                    </tbody>
                  </table>

                  <button type="submit" class="btn btn-info">Update Attribute</button>

                </div>
              </form>
              
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
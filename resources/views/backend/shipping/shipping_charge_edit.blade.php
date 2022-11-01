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
              <li class="breadcrumb-item active">Shipping</li>
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
            <h3 class="card-title">Shipping Details Update</h3>

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
            <form action="{{ route('shipping.update', $edit['id'] ) }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country Name</label><br>
                  <input type="text" class="form-control" value="{{ $edit['country'] }}" readonly>
                    <br>
                    @error('country')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
              
                  <div class="form-group">
                    <label>Shipping Charge(0 to 500g)$</label><br>
                    <input type="text" class="form-control" name="0_500g" value="{{ $edit['0_500g'] }}" > 
                    <br>
                    @error('0_500g')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Shipping Charge(501 to 1000g)$</label><br>
                    <input type="text" class="form-control" name="501_1000g" value="{{ $edit['501_1000g'] }}" > 
                    <br>
                    @error('501_1000g')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Shipping Charge(1001to 2000g)$</label><br>
                  <input type="text" class="form-control" name="1001_2000g" value="{{ $edit['1001_2000g'] }}" > 
                  <br>
                  @error('1001_2000g')
                      <span class="text-danger">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Shipping Charge(2001 to 5000g)$</label><br>
                  <input type="text" class="form-control" name="2001_5000g" value="{{ $edit['2001_5000g'] }}" > 
                  <br>
                  @error('2001_5000g')
                      <span class="text-danger">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Shipping Charge(Above to 5000g)$</label><br>
                  <input type="text" class="form-control" name="above_5000g" value="{{ $edit['above_5000g'] }}" > 
                  <br>
                  @error('above_5000g')
                      <span class="text-danger">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              </div>

                <button type="submit" class="btn btn-primary">Update</button>
              <!-- /.row -->
            </form>
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
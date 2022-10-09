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
              <li class="breadcrumb-item active">Brand</li>
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
                <h3 class="card-title">All Product Brand</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#productBrandAdd">Add Brand</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Brand</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="allBrand">
                  
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



  <!-- Add Modal -->
  <div class="modal fade" id="productBrandAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Brand Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="productBrandAdd" method="POST">
            @csrf
            <input type="text" id="brand_name" name="brand" class="form-control" placeholder="Brand"> <br>
            <button type="submit" class="btn btn-info" >Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  <div class="modal fade" id="productBrandEdit" tabindex="-1" role="dialog"    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Brand Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="productBrandUpdate" method="POST">
            @csrf
            <input type="text" id="brand_name" name="brand" class="form-control" placeholder="Brand"> <br>
            <input type="hidden" id="edit_id" name="edit_id"> 
            <button type="submit" class="btn btn-info" >Update</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>

@endsection
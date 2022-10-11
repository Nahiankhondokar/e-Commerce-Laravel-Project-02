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
              <li class="breadcrumb-item active">Banner</li>
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
                <h3 class="card-title">All Banners</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#bannerAdd">Add Banner</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Banner</th>
                    <th>Tittle</th>
                    <th>Link</th>
                    <th>Alt</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="allBanner">
                  
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
  <div class="modal fade" id="bannerAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Banner Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="bannerStore" method="POST">
            @csrf 
            <label for="">Banner Title</label>
            <input type="text" name="tittle" class="form-control" placeholder="tittle"> 
            <label for="">Banner Link</label>
            <input type="text" name="link" class="form-control" placeholder="link"> 
            <label for="">Banner Alt Tag</label>
            <input type="text" name="alt" class="form-control" placeholder="alt">
            <label for="">Banner Images</label><br>
            <input type="file" id="image" name="image" class="form-control" style="display: none"> 
            <label for="image">
                <img src="{{URL::to('')}}/media/img.png" alt="" style="width : 40px">
                <img src="" id="imgPriview" alt="" style="width : 60px">
            </label>
            @error('image')
            <span class="text-danger">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <button type="submit" class="btn btn-info" >Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  <div class="modal fade" id="BannerEdit" tabindex="-1" role="dialog"    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Banner Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="BannerUpdate" method="POST">
            @csrf
            <label for="">Banner Title</label>
            <input type="text" id="tittle" name="tittle" class="form-control" placeholder="tittle"> 
            @error('tittle')
            <span class="text-danger">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="">Banner Link</label>
            <input type="text" id="link" name="link" class="form-control" placeholder="link"> 
            <input type="hidden" id="update_id" name="update_id"> 
            <label for="">Banner Alt Tag</label>
            <input type="text" id="alt" name="alt" class="form-control" placeholder="alt">

            <label for="">Banner Images</label><br>
            <input type="file" id="editImage" name="image" style="display: none">
            <label for="editImage">
                <img src="{{URL::to('')}}/media/img.png" alt="" style="width : 40px">
                <img src="" id="editImgPreview" alt="" style="width : 60px">
            </label>
            <img src="" alt="" style="width : 60px" class="edit_img">
            <input type="hidden" id="old_image" name="old_image" class="form-control"> 
            @error('image')
            <span class="text-danger">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <button type="submit" class="btn btn-info" >Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>

@endsection
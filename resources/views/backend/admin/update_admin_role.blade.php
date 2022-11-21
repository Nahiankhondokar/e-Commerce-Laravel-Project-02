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
            <form action="{{ route('role.add.edit', $admin_id) }}" method="POST" enctype="multipart/form-data">
              @csrf

              {{-- Categories permission checking --}}
              @foreach(@$adminRoles as $item)
                    @if($item['module'] == 'categories')
                      @if($item['view_access'] == 1)
                      @php $catView = "checked"; @endphp
                      @else 
                      @php $catView = ''; @endphp
                      @endif 

                      @if($item['edit_access'] == 1)
                      @php $catEdit = "checked"; @endphp
                      @else 
                      @php $catEdit = ''; @endphp
                      @endif

                      @if($item['full_access'] == 1)
                      @php $catFull = "checked"; @endphp
                      @else 
                      @php $catFull = ''; @endphp
                      @endif
                    @endif
              @endforeach

              <div class="form-group">
                <label for="">Categories</label><br>
                <input type="checkbox" id="catview" {{@$catView}} name="categories[view]" value="1">
                <label for="catview">View Access</label>
                <input type="checkbox" id="catedit" {{@$catEdit}} name="categories[edit]" value="1">
                <label for="catedit">Edit Access</label>
                <input type="checkbox" id="catfull" {{@$catFull}} name="categories[full]" value="1">
                <label for="catfull">Full Access</label>
              </div>

              {{-- Product permission checking --}}
              @foreach(@$adminRoles as $item)
                    @if($item['module'] == 'product')
                      @if($item['view_access'] == 1)
                      @php $proView = "checked"; @endphp
                      @else 
                      @php $proView = ''; @endphp
                      @endif 

                      @if($item['edit_access'] == 1)
                      @php $proEdit = "checked"; @endphp
                      @else 
                      @php $proEdit = ''; @endphp
                      @endif

                      @if($item['full_access'] == 1)
                      @php $proFull = "checked"; @endphp
                      @else 
                      @php $proFull = ''; @endphp
                      @endif
                    @endif
              @endforeach

              <div class="form-group">
                <label for="">Product</label><br>
                <input type="checkbox" id="proview" {{@$proView}} name="product[view]" value="1">
                <label for="proview">View Access</label>
                <input type="checkbox" id="proedit" {{@$proEdit}} name="product[edit]" value="1">
                <label for="proedit">View/Edit Access</label>''
                <input type="checkbox" id="profull" {{@$proFull}} name="product[full]" value="1">
                <label for="profull">Full Access</label>
              </div>

              {{-- Coupon permission checking --}}
              @foreach(@$adminRoles as $item)
                    @if($item['module'] == 'coupon')
                      @if($item['view_access'] == 1)
                      @php $couponView = "checked"; @endphp
                      @else 
                      @php $couponView = ''; @endphp
                      @endif 

                      @if($item['edit_access'] == 1)
                      @php $couponEdit = "checked"; @endphp
                      @else 
                      @php $couponEdit = ''; @endphp
                      @endif

                      @if($item['full_access'] == 1)
                      @php $couponFull = "checked"; @endphp
                      @else 
                      @php $couponFull = ''; @endphp
                      @endif
                    @endif
              @endforeach

              <div class="form-group">
                <label for="">Coupon</label><br>
                <input type="checkbox" id="couview" {{@$couponView}} name="coupon[view]" value="1">
                <label for="couview">View Access</label>
                <input type="checkbox" id="couedit" {{@$couponEdit}} name="coupon[edit]" value="1">
                <label for="couedit">View/Edit Access</label>
                <input type="checkbox" id="coufull" {{@$couponFull}} name="coupon[full]" value="1">
                <label for="coufull">Full Access</label>
              </div>


              {{-- order permission checking --}}
              @foreach(@$adminRoles as $item)
                    @if($item['module'] == 'order')
                      @if($item['view_access'] == 1)
                      @php $orderView = "checked"; @endphp
                      @else 
                      @php $orderView = ''; @endphp
                      @endif 

                      @if($item['edit_access'] == 1)
                      @php $orderEdit = "checked"; @endphp
                      @else 
                      @php $orderEdit = ''; @endphp
                      @endif

                      @if($item['full_access'] == 1)
                      @php $orderFull = "checked"; @endphp
                      @else 
                      @php $orderFull = ''; @endphp
                      @endif
                    @endif
              @endforeach
              
              <div class="form-group">
                <label for="">Order</label><br>
                <input type="checkbox" id="orderview" {{@$orderView}} name="order[view]" value="1">
                <label for="orderview">View Access</label>
                <input type="checkbox" id="orderedit" {{@$orderEdit}} name="order[edit]" value="1">
                <label for="orderedit">View/Edit Access</label>
                <input type="checkbox" id="orderfull" {{@$orderFull}} name="order[full]" value="1">
                <label for="orderfull">Full Access</label>
              </div>


              <button type="submit" class="btn btn-primary">Update</button>

            </form>
          </div>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
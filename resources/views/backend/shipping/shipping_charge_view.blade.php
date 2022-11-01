@extends('backend.admin_master')

@section('admin')   

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Shipping Charges</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Shipping Charges</li>
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
            <table id="category" class="table table-striped table-bordered" style="background: white; padding: 15px">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Country</th>
                    <th scope="col">0 to 500g</th>
                    <th scope="col">501 to 1000g</th>
                    <th scope="col">1001 to 2000g</th>
                    <th scope="col">2001g to 5000g</th>
                    <th scope="col">Above 5000g</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
        
                  @foreach($shippingCharge as $item)
                    <tr>
                        <th scope="row">{{ $item['id'] }}</th>
                        <td>
                            {{ $item['country'] }}
                        </td>
                        <td>
                            ${{ $item['0_500g'] }}
                        </td>
                        <td>
                          ${{ $item['501_1000g'] }}
                        </td>
                        <td>
                          ${{ $item['1001_2000g'] }}
                        </td>
                        <td>
                          ${{ $item['2001_5000g'] }}
                        </td>
                        <td>
                          ${{ $item['above_5000g'] }}
                        </td>
                        <td>
                          @if($item['status'] == 1)
                          <div class="shippeActiveInactive" id="shippe-{{$item['id']}}" shippe_id="{{ $item['id'] }}">
                          <a id="shippe_active-btn-{{$item['id']}}" class="badge badge-success" href="javascript:void(0)">Active</a>
                          </div>
                          @else 
                          <div class="shippeActiveInactive" id="shippe-{{$item['id']}}" shippe_id="{{ $item['id'] }}">
                          <a id="shippe_inactive-btn-{{$item['id']}}" class="badge badge-danger" href="javascript:void(0)">Inactive</a>
                          </div>
                          @endif
                        </td>
                        <td>

                          <a title="Edit" href="{{route('shipping.edit', $item['id'])}}" class="btn btn-sm btn-info"><i class="fa fa-edit" aria-hidden="true"></i>
                          </a>

                        </td>
                        </tr>
                  @endforeach
                    
                </tbody>
            </table>
                
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
        
        <!--/ wrapper -->

@endsection



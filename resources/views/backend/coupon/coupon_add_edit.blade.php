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
              <li class="breadcrumb-item active">Coupon</li>
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
            <form action="{{ route('coupon.edit.add', @$edit_data -> id ?? '') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <div class="col-md-6">

                  @if(empty(@$edit_data -> coupon_option))
                    <div class="form-group">
                      <label>Coupon Option</label><br>
                      <input type="radio" name="coupon_option" id="Manual" value="Manual" @if(@$edit_data -> coupon_option == 'Manual') checked  @endif> <label for="Manual">Manual</label>
                      <input type="radio" name="coupon_option" id="Automatic" value="Automatic" @if(@$edit_data -> coupon_option == 'Automatic') checked  @endif> <label for="Automatic">Automatic</label>
                      <br>
                      @error('coupon_option')
                          <span class="text-danger">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <!-- /.form-group -->
                    <div class="form-group" style="display: none" id="couponFeild">
                      <label>Coupon Code</label>
                      <input type="text" class="form-control" name="coupon_code" placeholder="coupon_code" @if(@$edit_data -> coupon_code) value="{{ @$edit_data -> coupon_code }}"  @endif>
                      <br>
                    </div>

                  @else
                    <input type="hidden" name="coupon_option" value="{{@$edit_data -> coupon_option}}">
                    <input type="hidden" name="coupon_code" value="{{@$edit_data -> coupon_code}}">
                    <div class="form-group">
                      <label>Coupon Code : </label> <h3>{{ @$edit_data -> coupon_code }}</h3>
                    </div>

                  @endif


                  <div class="form-group">
                    <label >Coupon Type</label> <br>
                    <input type="radio" name="coupon_type" id="Multiple" value="Multiple" @if(@$edit_data -> coupon_type == 'Multiple') checked  @endif> <label for="Multiple">Multiple Times</label>
                    <input type="radio" name="coupon_type" id="Single" value="Single" @if(@$edit_data -> coupon_type == 'Single') checked  @endif> <label for="Single">Single Times</label>
                    <br>
                    @error('coupon_type')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Amount Type</label> <br>
                    <input type="radio" name="amount_type" id="Percentage" value="Percentage" @if(@$edit_data -> amount_type == 'Percentage') checked  @endif> <label for="Percentage">Percentage (%)</label>
                    <input type="radio" name="amount_type" id="Fixed" value="Fixed" @if(@$edit_data -> amount_type == 'Fixed') checked  @endif> <label for="Fixed">Fixed ($)</label>
                    <br>
                    @error('amount_type')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Amount</label> <br>
                    <input type="text" name="amount" placeholder="Amount" class="form-control" value="{{ @$edit_data -> amount }}">

                    @error('amount')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Select Categories</label>
                    <select id="" class="form-control select2" name="categories[]" multiple >
                        <option value="" disabled > -Select- </option>
                        @foreach($section as $item)
                        <optgroup label="{{ ucwords($item -> name) }}"></optgroup>
  
                              @foreach($item['getCategory'] as $cat)
                              {{-- {{ in_array($cat->id,$allCat)}}  --}}
                              <option value="{{ $cat -> id }}" @if(in_array($cat -> id, @$allCat)) selected="" @endif> &nbsp; -- &nbsp; {{ ucwords($cat -> category_name) }}</option>
  
                                @foreach($cat['subcategories'] as $subcat)
                                    <option value="{{ $subcat -> id }}" @if(in_array($subcat -> id, @$allCat)) selected="" @endif >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- &nbsp;{{ ucwords($subcat -> category_name) }}</option>
                                @endforeach
  
                              @endforeach
  
                        @endforeach
                      </select>

                    @error('categories')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Select Users</label>
                    <select id="" class="form-control select2" name="users[]" multiple >
                        <option value="" disabled > -Select- </option>
                        @foreach($users as $item)
                        <option value="{{ $item -> email }}" @if(in_array($item -> email, @$allUser)) selected="" @endif>{{ $item -> email }}</option>
                        @endforeach
                      </select>

                    @error('users')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label> Expire Date </label>
                    <input id="datemask" type="text" class="form-control" name="expire_date" placeholder="Expire Date" data-inputmask-alias="datetime"
                    data-inputmask-inputformat="yyyy/mm/dd"
                    data-mask value="{{ @$edit_data -> expire_date }}">

                    @error('expire_date')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  

                  <button type="submit" class="btn btn-primary">{{ (@$edit_data) ? "Update" : "Submit" }}</button>
                </div>
                
                

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
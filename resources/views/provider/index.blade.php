<?php 
use App\Models\ProvidersEmployee;
use App\Models\ProviderProduct;

?>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Provider Name : {!! $provider->name !!} - {!! $provider->id !!}</h3>

            <div class="box-tools">

            </div>
        </div>

            <div class="box-body">

                <div class="fields-group">

                    <div class="col-md-12">
                        <div class="col-md-6">

                        <div class="form-group ">
                            <label class="col-sm-0  control-label"></label>
                            <div class="col-sm-12">
                                <h3>Provider Detalis</h3>
                            </div>
                        </div>
                        <div class="form-group detalissssss">
                            <label class="col-sm-0  control-label"></label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"></h3>

                                                <div class="box-tools">

                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <div class="form-horizontal">

                                                <div class="box-body">

                                                    <div class="fields-group">

                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Email</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->email !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">City</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->city->name !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Contact name</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->contact_name !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Contact phone</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->contact_phone !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                         
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Contact mobile</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->contact_mobile !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Is on top
                                                                search</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->is_on_top_search?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-close text-red"></i>' !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Rate</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->rate !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="col-sm-0  control-label"></label>
                            <div class="col-sm-12">
                                <h3>Address Info</h3>
                            </div>
                        </div>
  

                        <div class="form-group infoooooo">
                            <label class="col-sm-0  control-label"></label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"></h3>

                                                <div class="box-tools">

                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <div class="form-horizontal">

                                                <div class="box-body">

                                                    <div class="fields-group">
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Address line 1</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->address_line_1 !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Address line 2</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->address_line_2 !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Location</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->location_lat !!},{!! $provider->location_lng !!}
                                                                                                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="form-group ">
                                                            <label class="col-sm-2 control-label">Has branches</label>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="box box-solid box-default no-margin box-show">
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        {!! $provider->has_branches?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-close text-red"></i>' !!}
                                                                    </div><!-- /.box-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                        
                                                    </div>

                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group ">   
                            
                            <label class="col-sm-0  control-label"></label>
                            <div class="col-sm-12">
                                <div class="row">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box grid-box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"> My Employees</h3>
                                                <div class="pull-right">
                                                    <div class="btn-group pull-right grid-create-btn"
                                                        style="margin-right: 10px">
                                                        <a 
                                                            href="<?=route('admin.employees.create', ['provider_id'=>$provider->id])?>"
                                                            class="btn btn-sm btn-success" title="New">
                                                            <i class="fa fa-plus"></i><span
                                                                class="hidden-xs">&nbsp;&nbsp;New</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        
                                            <!-- /.box-header -->
                                            <div class="box-body table-responsive no-padding">
                                                <table class="table table-hover grid-table"
                                                    id="grid-table62aca6bc8a142">
                                                    <thead>
                                                        <tr>
                                            
                                                            <th class="column-id">Id</th>
                                                            <th class="column-full_name">Name</th>
                                                            <th class="column-phone_number">Phone number</th>
                                                            <th class="column-status">Status</th>
                                                            <th class="column-type">Type</th>
                                                            <th class="column-created_at">Created at</th>
                                                            <th class="column-__actions__">Action</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>

                                                        @foreach ($provider->providersEmployees as $employees)

                                                        <tr data-key="1">
                                                         
                                                            <td class="column-id">
                                                                {{$employees->id}}
                                                            </td>
                                                            <td class="column-full_name">
                                                                {{$employees->full_name}}
                                                            </td>
                                                            <td class="column-phone_number">
                                                                {{$employees->phone_number}}

                                                            </td>
                                                            <td class="column-status">
                                                                {!! $employees->status?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-close text-red"></i>' !!}

                                                            </td>
                                                            <td class="column-type">
                                                                {{ProvidersEmployee::TYPE[$employees->type]}}
                                                            </td>
                                                            <td class="column-created_at">
                                                                {{date('d-m-Y H:i:s', strtotime($employees->created_at))}}
                                                            </td>
                                                            <td class="column-__actions__ ">
                                                       

                                                                <div class='btn-group'>
                                                                    <a class='btn btn-sm btn-primary' style='margin-right: 10px;' href='<?= route('admin.employees.show', [$employees->id]) ?>' > <i class='fa fa-eye'></i><span class='hidden-xs'> View</span></a>
                                                                    <a class='btn btn-sm btn-primary' style='margin-right: 10px;' href='<?= route('admin.employees.edit', [$employees->id]) ?>'><i class='fa fa-edit'></i><span class='hidden-xs'> Edit</span></a> 
                                                        
                                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger employee-delete" data-id="{{$employees->id}}" title="Delete">
                                                                        <i class="fa fa-trash"></i><span class="hidden-xs">  Delete</span>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>



                                                </table>

                                            </div>



                                            
                                            <!-- /.box-body -->
                                        </div>


                                        <div class="box grid-box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"> My Product</h3>
                                                <div class="pull-right">
                                                    <div class="btn-group pull-right grid-create-btn"
                                                        style="margin-right: 10px">
                                                        <a href="<?=route('admin.provider-products.create', ['provider_id'=>$provider->id])?>"
                                                            class="btn btn-sm btn-success" title="New">
                                                            <i class="fa fa-plus"></i><span
                                                                class="hidden-xs">&nbsp;&nbsp;New</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        
                                            <!-- /.box-header -->
                                            <div class="box-body table-responsive no-padding">
                                                <table class="table table-hover grid-table ">
                                                    <thead>
                                                        <tr>
                                            
                                                            <th class="column-provider_product_id">Id</th>
                                                            <th class="column-provider_Icon">Icon</th>
                                                            <th class="column-provider_product_name">Product</th>
                                                            <th class="column-is_active">Is active</th>
                                                            <th class="column-price">Price</th>
                                                            <th class="column-discount">Discount</th>

                                                            <th class="column-created_at">Created at</th>
                                                            <th class="column-__actions__ ">Action</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>

                                                        @foreach ($provider->providerProducts as $product)

                                                        <tr data-key="1">
                                                         
                                                            <td class="column-id">
                                                                {{$product->provider_product_id}}
                                                            </td>
                                                            <td class="column-icon">
                                                                <img src="{{Storage::url($product->icon_path)}}" style="max-width:50px;max-height:50px" class="img img-thumbnail">
                                                            </td>
                                                            <td class="column-full_name">
                                                                {{$product->provider_product_name}}
                                                            </td>
                                                            <td class="column-type">
                                                                {{ProviderProduct::ACTIVE[$product->is_active]}}
                                                            </td>
                                         
                                                            <td class="column-price">
                                                                {{$product->price}}

                                                            </td>
                                                            <td class="column-discount">
                                                                {{$product->discount}}

                                                            </td>
                                                            <td class="column-created_at">
                                                                {{date('d-m-Y H:i:s', strtotime($product->created_at))}}
                                                            </td>
                                                            <td class="column-__actions__ ">
                                                        

                                                                <div class='btn-group'>
                                                                    <a class='btn btn-sm btn-primary' style='margin-right: 10px;' href='<?= route('admin.provider-products.show', [$product->provider_product_id]) ?>' > <i class='fa fa-eye'></i><span class='hidden-xs'> View</span></a>
                                                                    <a class='btn btn-sm btn-primary' style='margin-right: 10px;'  href='<?= route('admin.provider-products.edit', [$product->provider_product_id]) ?>'><i class='fa fa-edit'></i><span class='hidden-xs'> Edit</span></a> 
                                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger product-delete" data-id="{{$product->provider_product_id}}" title="Delete">
                                                                        <i class="fa fa-trash"></i><span class="hidden-xs">  Delete</span>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>



                                                </table>

                                            </div>



                                            
                                            <!-- /.box-body -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        <!-- /.box-footer -->

    </div>

<script >

var trans = [];
trans["delete_confirm"]= "{{app('translator')->get('admin.delete_confirm')}}";
trans["confirm"]= "{{app('translator')->get('admin.confirm')}}";
trans["cancel"]= "{{app('translator')->get('admin.cancel')}}";
trans["delete"]= "{{app('translator')->get('admin.delete')}}";

$('.employee-delete').unbind('click').click(function() {

var id = $(this).data('id');

swal({
    title: trans['delete_confirm'],
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: trans['confirm'],
    showLoaderOnConfirm: true,
    cancelButtonText: trans['cancel'],
    preConfirm: function() {
        return new Promise(function(resolve) {
            $.ajax({
                method: 'DELETE',
                url: '/admin/employees/' + id,
                data: {
                    _method:'delete',
                    _token:"{{ csrf_token()."" }}",
                },
                success: function (data) {
                    $.pjax.reload('#pjax-container');

                    resolve(data);
                }
            });
        });
    }
}).then(function(result) {
    var data = result.value;
    if (typeof data === 'object') {
        if (data.status) {
            swal(data.message, '', 'success');
        } else {
            swal(data.message, '', 'error');
        }
    }
});
});

$('.product-delete').unbind('click').click(function() {

var id = $(this).data('id');

swal({
    title: trans['delete_confirm'],
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: trans['confirm'],
    showLoaderOnConfirm: true,
    cancelButtonText: trans['cancel'],
    preConfirm: function() {
        return new Promise(function(resolve) {
            $.ajax({
                method: 'DELETE',
                url: '/admin/provider-products/' + id,
                data: {
                    _method:'delete',
                    _token:"{{ csrf_token()."" }}",
                },
                success: function (data) {
                    $.pjax.reload('#pjax-container');

                    resolve(data);
                }
            });
        });
    }
}).then(function(result) {
    var data = result.value;
    if (typeof data === 'object') {
        if (data.status) {
            swal(data.message, '', 'success');
        } else {
            swal(data.message, '', 'error');
        }
    }
});
});


</script>
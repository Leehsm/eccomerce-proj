@extends('admin.admin_master_stock')
@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">           
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            Stock List
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 100px"><span class="text-white">Image</span></th>
                                        <th style="min-width: 150px"><span class="text-white">Category</span></th>
                                        <th style="min-width: 150px"><span class="text-white">Name</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Size</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Color</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Quantity</span></th>
                                        <th style="min-width: 120px"><span class="text-white">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($stocks as $item)
                                        <tr>
                                            <td>
                                                <span>
                                                    <img src="{{ asset($item->image) }}" style="width: 100px; height: 100px;">
                                                </span>
                                            </td>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="text-fade d-block">{{ $item->category }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->size }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->color }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->quantity }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->category == 'Bag')
                                                    <a href="{{ route('bag.edit',$item->id) }}" class="waves-effect waves-light btn btn-info btn-circle mx-5" title="Edit Data"><span class="fa fa-eye"></span></a>
                                                @elseif($item->category == 'Clothing')
                                                    <a href="{{ route('cloth.edit',$item->id) }}" class="waves-effect waves-light btn btn-info btn-circle mx-5" title="Edit Data"><span class="fa fa-eye"></span></a>
                                                @elseif($item->category == 'Wallet')
                                                    <a href="{{ route('wallet.edit',$item->id) }}" class="waves-effect waves-light btn btn-info btn-circle mx-5" title="Edit Data"><span class="fa fa-eye"></span></a>
                                                @else
                                                    <a href="{{ route('skincare.edit',$item->id) }}" class="waves-effect waves-light btn btn-info btn-circle mx-5" title="Edit Data"><span class="fa fa-eye"></span></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach	
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection

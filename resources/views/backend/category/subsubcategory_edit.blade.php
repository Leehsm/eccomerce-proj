@extends('admin.admin_master')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

    <!-- Main content -->
    <section class="content">
    <div class="row"> 

        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Edit Sub Sub Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('subsubcategory.update') }}" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $subsubcategory->id }}">

                            <div class="form-group">
								<h5>Category <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" id="category_id" class="form-control" >
										<option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category)
                                            {{-- <option value="{{ $category->id }}">{{ $category->category_name_en }}</option> --}}
                                            <option value="{{ $category->id }}" {{ $category->id == $subsubcategory->category_id ? 'selected':'' }} >{{ $category->category_name_en }}</option>
                                        @endforeach										
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
								<div class="help-block"></div></div>
							</div>
                            <div class="form-group">
								<h5>Sub Category <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" id="subcategory_id" class="form-control" >
										<option value="" selected="" disabled="">Select Sub Category</option>
                                        @foreach ($subcategories as $subsub)
                                            {{-- <option value="{{ $category->id }}">{{ $category->subcategory_name_en }}</option> --}}
                                            <option value="{{ $subsub->id }}" {{ $subsub->id == $subsubcategory->subcategory_id ? 'selected':'' }} >{{ $subsub->subcategory_name_en }}</option>
                                        @endforeach										
									</select>
                                    @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
							    <div class="help-block"></div></div>
							</div>
                            <div class="form-group">
                                <h5>Sub Sub Category Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="subsubcategory_name_en" id="subsubcategory_name_en" class="form-control" value="{{ $subsubcategory->subsubcategory_name_en }}"> 
                                    @error('subsubcategory_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Sub Sub Category Name Malay <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="subsubcategory_name_my" id="subsubcategory_name_my" class="form-control" value="{{ $subsubcategory->subsubcategory_name_my }}"> 
                                    @error('subsubcategory_name_my')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


@endsection
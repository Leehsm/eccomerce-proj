@extends('admin.admin_master')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
        <h4 class="box-title">Add Product</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="row">
            <div class="col">
                <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">						
                            {{-- 1ST ROW --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select Brand<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" id="brand_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" >{{ $brand->brand_name_en }}</option>
                                                @endforeach										
                                            </select>
                                            @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" id="category_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" >{{ $category->category_name_en }}</option>
                                                @endforeach										
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select Sub Category<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" id="subcategory_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select Sub Category</option>
                                                                                
                                            </select>
                                            @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>
                                </div>
                            </div>

                            {{-- 2ND ROW --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select Sub Sub Category<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subsubcategory_id" id="subsubcategory_id" class="form-control">
                                                <option value="" selected="" disabled="">Select Sub Sub Category</option>
                                                                                    
                                            </select>
                                            @error('subsubcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_en" class="form-control" required=""> 
                                            @error('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_code" class="form-control" required=""> 
                                            @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>

                            {{-- 3RD ROW --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product size English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_en" class="form-control"  data-role="tagsinput" value="One size"> 
                                            @error('product_size_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_qty" class="form-control" data-role="tagsinput" required=""> 
                                            @error('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Color <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_en" class="form-control"  data-role="tagsinput" > 
                                            @error('product_color_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>

                            {{-- 4TH ROW --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product tag English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_en" class="form-control"  data-role="tagsinput" > 
                                            @error('product_tags_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>                                       
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product tag Malay <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_my" class="form-control"  data-role="tagsinput" > 
                                            @error('product_tags_my')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>

                            {{-- 6TH ROW --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="selling_price" class="form-control" required=""> 
                                            @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Discount Price <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="discount_price" class="form-control" > 
                                            @error('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>
                            
                            {{-- 7TH ROW --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Main Thumbnail <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_thambnail" class="form-control" onchange="mainThumUrl(this)" required="">
                                            @error('product_thambnail') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <img src="" id="mainThumb">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Multiple Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" required="">
                                            @error('multi_img') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="row" id="preview_img"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Size Chart <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="file" name="size_chart" class="form-control" onchange="sizeChart(this)">
                                            @error('size_chart') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <img src="" id="sizeChart">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 8TH ROW --}}
                            <div class="row"> 
                                <div class="col-md-6">                
                                    <div class="form-group">
                                        <h5>Short Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_desc_en" id="textarea" class="form-control" required placeholder="Textarea text" required=""></textarea>     
                                        </div>
                                    </div>
                                </div> 
                            </div> 

                            {{-- 9TH ROW --}}
                            <div class="row"> 
                                <div class="col-md-6">                
                                    <div class="form-group">
                                        <h5>Long Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="long_desc_en" name="long_desc_en" rows="10" cols="80" required="">
                                                Long Description 
                                            </textarea>     
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_2"  name="hot_deals" value="1">
                                                <label for="checkbox_2">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                                <label for="checkbox_3">Featured</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_6" name="new_arrival" value="1">
                                                <label for="checkbox_6">New Arrival</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                                                <label for="checkbox_4">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
                                                <label for="checkbox_5">Special Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_7" name="best_seller" value="1">
                                                <label for="checkbox_7">Best Seller</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
                            </div>
                        </div>
                    </div>                
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    </section>
    <!-- /.content -->
    
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    $('select[name="subsubcategory_id"]').html('');
                    var d =$('select[name="subcategory_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });

    $('select[name="subcategory_id"]').on('change', function(){
        var subcategory_id = $(this).val();
        if(subcategory_id) {
            $.ajax({
                url: "{{  url('/category/subsubcategory/ajax') }}/"+subcategory_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    var d =$('select[name="subsubcategory_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
  });
  </script>

<script type="text/javascript">
    function mainThumUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader()
            reader.onload = function(e){
                $('#mainThumb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>

<script type="text/javascript">
    function sizeChart(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader()
            reader.onload = function(e){
                $('#sizeChart').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{-- ---------------------------Show Multi Image JavaScript Code ------------------------ --}}

<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>
{{-- ================================= End Show Multi Image JavaScript Code. ==================== --}}


@endsection
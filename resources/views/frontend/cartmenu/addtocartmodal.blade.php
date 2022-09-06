{{-- @php
$stock = DB::table('products')->where('product_color_en', NULL)->get();
@endphp --}}

<!-- Add to Cart Product Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <strong><span id="pname"></span></strong> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel"><span aria-hidden="true">&times;</span></button>
          </h5>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="card" style="width: 18rem;">
                <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px;" id="pimage" >
              </div>
            </div><!-- // end col md -->
            <br>

            <div class="col-md-4">
              <ul class="list-group">
                <li class="list-group-item">Product Price: <strong class="text-danger">RM<span id="pprice"></span></strong>
                  <del id="oldprice">RM</del>
                </li>
                <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                <li class="list-group-item">Stock: 
                  <span class="badge badge-pill badge-success" id="available" style="background: green; color: white;"></span> 
                  <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;"></span> 
                </li>
              </ul>
            </div><!-- // end col md -->

            <div class="col-md-4">
              <div class="form-group">
                <label for="color">Choose Color</label>
                <select class="form-control" id="color" name="color">
                  <select class="form-control" id="exampleFormControlSelect1" name="color">
                </select>
              </div>  <!-- // end form group -->
              <div class="form-group" id="sizeArea">
                <label for="size">Choose Size</label>
                <select class="form-control" id="size" name="size">
                  <select class="form-control" id="exampleFormControlSelect1" name="color">
                  {{-- <option>1</option> --}}
                </select>
              </div>  <!-- // end form group -->
              
              <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" class="form-control" id="qty" value="1" min="1" >
              </div> <!-- // end form group -->
              <input type="hidden" id="product_id">
              <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>
            </div><!-- // end col md -->

          </div> <!-- // end row -->
        </div> <!-- // end modal Body -->
        
      </div>
    </div>
  </div>
  <!-- End Add to Cart Product Modal -->  
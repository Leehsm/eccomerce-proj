@php
    // $color = DB::table('products')->get('product_color_en');
    $colors = App\Models\Product::groupBy('product_color_en')->select('product_color_en')->get();
@endphp

<!-- ============================================== COLOR============================================== -->
<div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
        <h4 class="widget-title">Colors</h4>
    </div>
    <div class="sidebar-widget-body">
        <ul class="list">
            @foreach($colors as $color)
                <li><a href="{{ url('product/color/'.$color->product_color_en) }}">{{ str_replace(',',' ',$color->product_color_en)  }}</a></li>
            @endforeach
        </ul>
    </div>
  <!-- /.sidebar-widget-body --> 
</div>
<!-- /.sidebar-widget --> 
<!-- ============================================== COLOR: END ============================================== -->
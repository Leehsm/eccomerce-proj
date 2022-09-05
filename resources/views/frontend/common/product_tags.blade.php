@csrf
@php
    $tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tags_my = App\Models\Product::groupBy('product_tags_my')->select('product_tags_my')->get();
@endphp     

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs"> 
        <div class="tag-list"> 
            
            @csrf
            @foreach($tags_en as $tag)
                <a class="item active"  href="{{ url('product/tag/'.$tag->product_tags_en) }}">
                    {{ str_replace(',',' ',$tag->product_tags_en)  }}
                </a> 
            @endforeach
                
            {{-- @if(session()->get('language') == 'malay') 
                @foreach($tags_my as $tag)
                    <a class="item active" href="{{ url('product/tag/'.$tag->product_tags_my) }}">
                        {{ str_replace(',',' ',$tag->product_tags_my)  }}
                    </a> 
                @endforeach
            @else 
                @foreach($tags_en as $tag)
                    <a class="item active"  href="{{ url('product/tag/'.$tag->product_tags_en) }}">
                        {{ str_replace(',',' ',$tag->product_tags_en)  }}
                    </a> 
                @endforeach
            @endif --}}
        </div>
        <!-- /.tag-list --> 
    </div>
    <!-- /.sidebar-widget-body --> 
</div>
<!-- /.sidebar-widget -->  
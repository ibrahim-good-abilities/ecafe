
<div class="products-list style-1">
   @foreach($item_groups as $key => $items)
   <div class="products-box style-1 row {{ $key == $categories[0]->id? 'active':'' }}" category="{{ $key }}" >
   @foreach($items as $item)
         <div class="animate fadeUp product-box col s6 m4">
            <div class="card" style=" background-image: url({{asset('public'.$item->src)}}">
               <span class="overlay"></span>
               <div class="card-content" >
                  <div class="row center-align">
                        <h3 class="product-name">{{ $item->name }}</h3>
                        <h6 class="col s12 m12 l8 mt-3 rtl">{{ number_format($item->price,2) }}<sup>ج</sup> </h6>
                  </div>
                  <button class="btn-floating mb-1 waves-effect waves-light product"  price="{{ $item->price }}" p-id="{{ $item->id }}">
                        <i class="material-icons">add</i>
                  </button>
               </div>
            </div>
         </div>
      @endforeach
   </div>
   @endforeach
</div>



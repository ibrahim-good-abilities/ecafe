<div class="categories-box">
            @foreach($categories as $category)
            <div class="card animate fadeUp category-box col s6 m4 l3 "  style=" background-image: url({{asset('public'.$category->src)}}">     
                        <div class="category-content" >
                                 <h3 class="category-name">{{ $category->category_name }}<h3>
                        </div>
                      
                     </div>
                    
             @endforeach
<!-- <div class="categories col-12">
   @foreach($categories as $category)
    <button class="waves-effect waves-light  btn box-shadow-none border-round category ml-5px {{ $loop->iteration == 1? 'active':'' }}"  target="{{ $category->id }}">{{ $category->category_name }}</button>
   @endforeach
</div>  -->
</div>
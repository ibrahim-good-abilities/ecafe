<div class="categories-box style-1">
   @foreach($categories as $category)
      <div class="card animate fadeUp category-box {{ $loop->iteration == 1? 'active':'' }}"  target="{{ $category->id }}" style=" background-image: url({{asset('public'.$category->src)}}" >     
         <div class="category-content" >
                  <h3 class="category-name">{{ $category->category_name }}<h3>
         </div>
         
      </div>   
   @endforeach
</div>
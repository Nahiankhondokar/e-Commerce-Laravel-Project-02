
<div class="form-group">
    <label>Category Level </label> 
    <select id="categoryLevelShow" class="form-control" style="width: 100%;" name="parent_id">
      <option value="" @if(isset($category -> parent_id) && $category -> parent_id == 0) selected  @endif > -Select- </option>

        @if(!empty($category_level))
          @foreach($category_level as $item)
            <option value="{{ $item -> id }}" @if(isset($category -> parent_id) && $category -> parent_id == $item -> id) selected  @endif  > {{ ucwords($item -> category_name) }}</option>
              @if(!empty($item -> subcategories ))
                @foreach($item -> subcategories as $item)
                  <option value="{{ $item -> id }}" >&nbsp;> {{ ucwords($item -> category_name) }}</option>
                @endforeach
              @endif
          @endforeach
        @endif
    </select>
</div>

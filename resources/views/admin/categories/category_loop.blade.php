<tr class="bg-category-step{{$category->step}}">
    <td>
        <label>
            <input class="category_check" name="checked_category[]" type="checkbox" value="{{$category->id}}"/>
            #{{$category->id}}
        </label>
    </td>
    <td>
        <p class="m-0 d-flex">

            @for($i = 0; $i<=$category->step; $i++)
                <span class="category-loop-icon">
                    @if( ! $category->step)
                        @if($category->icon_class)
                            <i class="las {{$category->icon_class}}" data-toggle="tooltip" title="Top Category"></i>
                        @else
                            <i class="las la-arrow-circle-up" data-toggle="tooltip" title="Top Category"></i>
                        @endif
                    @endif
                    @if( $category->step == 1 && $i == 1)
                        <i class="las la-chevron-circle-right"></i>
                    @endif
                    @if( $category->step == 2 && $i == 2)
                        <i class="las la-tag" data-toggle="tooltip" title="Topic"></i>
                    @endif
                </span>
            @endfor

            <span>{!! $category->name !!}</span>
        </p>
    </td>
    <td>
        <img src="{{ $category->cover }}" alt="" class="img-thumbnail img-50X50"/>
    </td>
    <td>
        <a href="{{route('admin.categories.edit', $category)}}" class="btn btn-primary btn-sm">
            <i class="la la-pencil"></i>
        </a>
        <a href="{{route('admin.categories.show', $category)}}" class="btn btn-outline-info btn-sm"
           target="_blank">
            <i class="las la-eye"></i>
        </a>
    </td>
</tr>

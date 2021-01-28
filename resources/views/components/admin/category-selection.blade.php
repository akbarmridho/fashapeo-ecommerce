<select
    name="category"
    class="select"
    id="category"
    height="50px"
    required
>
    @foreach($categories as $parent)
    <optgroup label="{{ $parent->name }}">
        @foreach($parent->children as $child)
        <option value="{{ $child->id }}">{{ $child->name }}</option>
        @endforeach
    </optgroup>
    @endforeach
</select>

    <div class="form-outline mb-3">
        <input 
            name="name"
            type="text"
            id="name"
            class="form-control"
            value="{{ $editCategory->name }}"
            required/>
        <label class="form-label" for="name">Name</label>
    </div>
    <div class="form-outline mb-3">
        <input 
            name="description" 
            type="text" 
            id="desc" 
            class="form-control" 
            value="{{ $editCategory->description }}"
            />
        <label class="form-label" for="desc">Description</label>
    </div>
    <div class="mb-3">
        <select 
            name="parent" 
            id="" 
            class="form-select">
            <option value="" selected>Select Parent Category</option>
            @foreach($categories as $category)
                @if($category->parent_id === null && $editCategory->id !== $category->id)
                    <option 
                        value="{{ $category->id }}"
                        @if($editCategory->parent_id === $category->id)
                        selected
                        @endif
                        >
                        {{ $category->name }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    
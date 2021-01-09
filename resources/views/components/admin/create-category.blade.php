<form action="{{ route('admin.categories.store') }}" method="POST" class="my-3">
    @csrf
    <div class="form-outline mb-3">
        <input 
            name="name"
            type="text"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            required/>
        <label class="form-label" for="name">Name</label>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-outline mb-3">
        <input 
            name="description" 
            type="text" 
            id="desc" 
            class="form-control @error('description') is-invalid @enderror" />
        <label class="form-label" for="desc">Description</label>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-3">
        <select 
            name="parent" 
            id="" 
            class="form-select @error('parent') is-invalid @enderror">
            <option value="" selected>Select Parent Category</option>
            @foreach($categories as $category)
                @if($category->parent_id === null)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        @error('parent')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
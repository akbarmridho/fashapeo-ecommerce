<form action="{{ route('admin.variants.update', ['id' => $variation->id ]) }}" method="POST" class="my-3">
@csrf
@method('put')
    <div class="modal-body">
        <div class="form-outline mb-3">
        <input 
            name="name"
            type="text"
            id="name"
            class="form-control"
            value="{{ $variation->name }}"
            required/>
        <label class="form-label" for="name">Name</label>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
            Close
        </button>
        <button type="submit" class="btn btn-outline-secondary">Update</button>
    </div>
</form>
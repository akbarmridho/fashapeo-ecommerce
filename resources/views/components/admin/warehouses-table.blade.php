<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Address</th>
      <th scope="col" style="min-width: 125px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if($warehouses->isEmpty())
    <tr>
      <td colspan="5">
        <h4>No warehouse found</h4>
      </td>
    </tr>
    @else
      @foreach($warehouses as $index => $warehouse)
        <tr class="
        @if($warehouse->main)
        table-primary
        @endif
        ">
          <th scope="row">{{ $index + 1 }}</th>
          <td>{{ $warehouse->name }}</td>
          <td>{{ $warehouse->description }}</td>
          <td>
            {{ $warehouse->address->name . ', ' . $warehouse->address->phone}} <br>
            {{ $warehouse->address->delivery_address . ' ' . $warehouse->address->district . ', ' . $warehouse->address->postal_code }} <br>
            {{ $warehouse->address->city . ', ' . $warehouse->address->province }}
          </td>
          <td>
            <div class="d-flex">
              <a href="{{ route('admin.warehouse.show', ['warehouse' => $warehouse->id]) }}" class="btn btn-sm btn-info shadow-0 px-2 mx-1"><i class="far fa-edit"></i></a>
              <form action="{{ route('admin.warehouse.delete', ['warehouse' => $warehouse->id]) }}" method="POST">
                @csrf
                @method('delete')  
                <button class="btn btn-sm btn-danger shadow-0 px-2 need-confirm mx-1" type="submit"><i class="far fa-trash-alt"></i></button>
              </form>
              @if($warehouse->main)
              <button class="btn btn-sm btn-light shadow-0 px-2 mx-1" disabled><i class="fas fa-star"></i></button>
              @else
              <form action="{{ route('admin.warehouse.main', ['warehouse' => $warehouse->id]) }}" method="POST">
                @csrf
                @method('put')
                <button class="btn btn-sm btn-light shadow-0 px-2 mx-1 need-confirm" type="submit"><i class="far fa-star"></i></button>
              </form>
              @endif
            </div>
        </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
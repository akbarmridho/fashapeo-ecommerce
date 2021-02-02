<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Label</th>
      <th scope="col">Address</th>
      <th scope="col" style="min-width: 100px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if($addresses->isEmpty())
    <tr>
      <td colspan="4">
        <h4>No address found</h4>
      </td>
    </tr>
    @else
      @foreach($addresses as $index => $address)
        <tr class="table-primary">
          <th scope="row">{{ $index + 1 }}</th>
          <td>{{ $address->label }}</td>
          <td>
            {{ $address->name . ', ' . $address->phone}} <br>
            {{ $address->delivery_address . ' ' . $address->district . ', ' . $address->postal_code }} <br>
            {{ $address->city . ', ' . $address->province }}
          </td>
          <td>
            <a href="{{ route('customer.address.show', ['address' => $address->id]) }}" class="btn btn-sm btn-info shadow-0 px-2"><i class="far fa-edit"></i></a>
            <form action="?k=yea">  
              <button class="btn btn-sm btn-danger shadow-0 px-2 need-confirm" type="submit"><i class="far fa-trash-alt"></i></button>
            </form>
        </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
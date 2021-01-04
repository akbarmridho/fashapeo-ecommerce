@extends('customer.layouts.main')

@section('title')
Shipment Options
@endsection

@section('content')
<main>
    <div class="container">
        <div class="col-12 col-md-10 col-lg-8 mt-5 p-5 mx-auto bg-light">
            <x-customer.order-progress /> 
            <x-customer.shipment-options />
        </div>

    </div>
 <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/css/default/tail.select-light.css"
    /> 
   <script src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript">
    tail.select(".select-description", {
      // search: true,
      descriptions: true,
    });
  </script>
</main>
@endsection
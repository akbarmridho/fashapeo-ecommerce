 @extends('layouts.main')

 @section('title')
     My Account
 @endsection

 @section('additional-script')
     <script src="{{ mix('/js/pages/notification.js') }}" defer></script>
 @endsection

 @section('content')
     <main>
         <div class="container">
             <div class="row mt-5">
                 <div class="col-12 col-md-3 me-4">
                     @include('customer.includes.my-account-nav');
                 </div>
                 <div class="col-12 col-md-8 p-4 shadow-1">
                     <div class="d-flex justify-content-between">
                         <p class="h5">Notifications</p>
                         <form action="{{ route('notification.all') }}" method="post">
                             @csrf
                             <button class="shadow-0 link-dark" type="submit">Mark All as Read</button>
                         </form>
                         {{-- atau ajax! --}}
                     </div>
                     <hr>
                     @if ($notifications->isEmpty())
                         <div>
                             <h4>No Notification</h4>
                         </div>
                     @else
                         @foreach ($notifications as $notification)
                             <x-main.notifications :notification="$notification" />
                         @endforeach
                         <div class="float-end">
                             {{ $notifications->links() }}
                         </div>
                     @endif
                 </div>
             </div>
         </div>
     </main>
 @endsection

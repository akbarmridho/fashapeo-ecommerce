@extends('layouts.main')

@section('title')
    Contact Us
@endsection

@section('content')
    <main>
        <div class="container p-5">
            <div class="row shadow">
                <div class="col-12 col-md-8 p-4">
                    <x-admin.session-alert />
                    <h3 class="mb-4"><i class="fas fa-envelope me-2"></i>Write to Us</h3>
                    <x-main.contact />
                </div>
                <div class="col-12 col-md-4 p-4" style="background-color: #01579B">
                    <h3 class="text-center text-light">Contact Information:</h3>
                    <ul class="list-unstyled my-5 mx-4">
                        @if (setting('contact.email'))
                            <li class="mb-3">
                                <a href="{{ 'mailto:' . setting('contact.email') }}" class="text-light"><i
                                        class="fas fa-envelope me-2"></i>{{ setting('contact.email') }}</a>
                            </li>
                        @endif
                        @if (setting('contact.whatsapp'))
                            <li>
                                <a href="{{ 'https://wa.me/' . setting('contact.whatsapp') }}" class="text-light"><i
                                        class="fab fa-whatsapp me-2"></i>{{ '+' . setting('contact.whatsapp') }}</a>
                            </li>
                        @endif
                    </ul>
                    <hr class="divider" style="height: 3px;">
                    <div class="text-center">
                        @if (setting('contact.instagram'))
                            <a href="{{ 'https://instagram.com/' . setting('contact.instagram') }}" role="button"
                                style="color: white" class="mx-1"><i class="fab fa-instagram fa-lg"></i></a>
                        @endif
                        @if (setting('contact.facebook'))
                            <a href="{{ 'https://facebook.com/' . setting('contact.facebook') }}" role="button"
                                style="color: white" class="mx-1"><i class="fab fa-facebook-f fa-lg"></i></a>
                        @endif
                        @if (setting('contact.twitter'))
                            <a href="{{ 'https://twitter.com/' . setting('contact.twitter') }}" role="button"
                                style="color: white" class="mx-1"><i class="fab fa-twitter fa-lg"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

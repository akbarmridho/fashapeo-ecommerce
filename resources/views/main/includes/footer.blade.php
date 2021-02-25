<footer class="bg-dark text-light text-center text-lg-start mt-5 small">
    <div class="container px-4 pt-5 mb-5">

        <div class="row">

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">More about us</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-light">Profile</a>
                    </li>
                    <li>
                        <a href="#!" class="text-light">Testimonials</a>
                    </li>
                    <li>
                        <a href="#!" class="text-light">Career</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">FAQ</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-light">Common Questions</a>
                    </li>
                    <li>
                        <a href="#!" class="text-light">Payment Method</a>
                    </li>
                    <li>
                        <a href="#!" class="text-light">Payment Confirmation</a>
                    </li>
                    <li>
                        <a href="#!" class="text-light">Shipping & Return</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contact Us</h5>

                <ul class="list-unstyled mb-0">
                    @if (setting('contact.email'))
                        <li>
                            <a href="{{ 'mailto:' . setting('contact.email') }}" class="text-light"><i
                                    class="far fa-envelope me-2"></i>Email</a>
                        </li>
                    @endif
                    @if (setting('contact.facebook'))
                        <li>
                            <a href="{{ 'https://facebook.com/' . setting('contact.facebook') }}"
                                class="text-light"><i class="fab fa-facebook-square me-2"></i>Facebook</a>
                        </li>
                    @endif
                    @if (setting('contact.twitter'))
                        <li>
                            <a href="{{ 'https://twitter.com/' . setting('contact.twitter') }}" class="text-light"><i
                                    class="fab fa-twitter-square me-2"></i>Twitter</a>
                        </li>
                    @endif
                    @if (setting('contact.whatsapp'))
                        <li>
                            <a href="{{ 'https://wa.me/' . setting('contact.whatsapp') }}" class="text-light"><i
                                    class="fab fa-whatsapp me-2"></i>Whatsapp</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Payment Support</h5>

                {{-- <img src="/img/ATM-1400x514.png" alt="" class="img-fluid" /> --}}
            </div>
        </div>
    </div>

    <div class="text-center p-3">© {{ date('Y') }} Copyright: Fashapeo</div>
</footer>

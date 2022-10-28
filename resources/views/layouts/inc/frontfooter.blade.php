<footer class="footer ">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo-footer">
                            {{-- <i class="fa-solid fa-hat-wizard fa-2x"></i><span class="logo">{{App\Models\Company::find(1)->name}}</span> --}}
                            <img src="{{asset('assets/logo/'. App\Models\Company::find(1)->logo)}}" alt="{{App\Models\Company::find(1)->name}}" style="width:40%">
                        </div>
                        <p class="text">{{App\Models\Company::find(1)->description}}.</p>
                        <p class="call">Got Question? Call us 24/7<span><a href="tel: {{App\Models\Company::find(1)->phone }} ">{{App\Models\Company::find(1)->phone}}</a></span></p>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Get In Touch</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>{{App\Models\Company::find(1)->address}}</li>
                                <li>Indonesia.</li>
                                <li>{{App\Models\Company::find(1)->email}}</li>
                                <li>{{App\Models\Company::find(1)->phone}}</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <ul>
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-flickr"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="copyright-inner border-top">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>Copyright © 2021 -
                                All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right pull-right">
                            <ul class="payment-cards">
                                <li><i class="fa fa-cc-paypal"></i></li>
                                <li><i class="fa fa-cc-amex"></i></li>
                                <li><i class="fa fa-cc-mastercard"></i></li>
                                <li><i class="fa fa-cc-stripe"></i></li>
                                <li><i class="fa fa-cc-visa"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
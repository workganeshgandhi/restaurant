    <!-- start of footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{-- {{ $properties['native'] }} --}}
                        <img style="width: 20px ; height: 20px;"
                            src="{{ asset($properties['native'] == 'English' ? 'web_files/assets/img/english.png' : 'web_files/assets/img/arabic.png') }}"
                            alt="">
                    </a>
                @endforeach
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>@lang('trans.app name')
                        </h6>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam illo unde corrupti, eligendi
                            fugit minima soluta ipsa qui mollitia
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            @lang('trans.services')
                        </h6>
                        <p>
                            <a href="{{ route('newOrder') }}" class="text-reset">@lang('trans.new order')</a>
                        </p>
                        <p>
                            <a href="{{route('contact')}}" class="text-reset">@lang('trans.contact')</a>
                        </p>
                        <p>
                            <a href="#" class="text-reset">@lang('trans.new order')</a>
                        </p>
                        <p>
                            <a href="{{route('about')}}" class="text-reset">@lang('trans.about us')</a>
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Branches
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Cairo</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Alex</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Cairo</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Alex</a>
                        </p>
                    </div>


                </div>
            </div>
        </section>

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="#">MOHAMED HELMY</a>
        </div>
    </footer>
    <!-- end of footer -->

  <footer id="footer-area">
      <div class="container pb-3">
          <div class="row">
              <div class="col-6 footer-widget pe-5">
                  <h4>@lang('helal.about-sarc')</h4>
                  <p> {{ $components['target'] }}</p>
                  {{-- <p> {{ $components['about'] }}</p> --}}
              </div>
              <div class="col-6 footer-widget pe-5 about">
                  <h4>@lang('helal.about')</h4>
                  <ul class="p-0">
                      <li><a href="show/1">@lang('helal.about')</a></li>
                      <li><a href="tel: {{ $components['phone'] }}">@lang('helal.contact')</a></li>
                      <li><a href="mailto: {{ $components['mail'] }}">@lang('helal.mailus')</a> </li>
                      {{-- <li><a href="#">@lang('helal.Partnership')</a></li> --}}
                  </ul>
              </div>
          </div>
          <div class="col-md-6 footer-widget mt-3">
              <div class="pe-5">
                  <h4>@lang('helal.follow') </h4>
                  <ul class="d-flex gap-2 text-white p-0">
                      <li><a href="{{ $components['facebook'] }}"><i class="fab fa-facebook"></i></a></li>
                      <li><a href="{{ $components['X-twitter'] }}"><i class="fab fa-x-twitter"></i></a></li>
                      <li><a href="{{ $components['instagram'] }}"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="{{ $components['linked-in'] }}"><i class="fab fa-linkedin"></i></a></li>
                      <li><a href="{{ $components['youtube'] }}"><i class="fab fa-youtube"></i></a></li>
                      <li><a href="{{ $components['telegram'] }}"><i class="fab fa-telegram-plane"></i></a></li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="footer-copyright py-4 ps-3">
          <div> SARC © 2024 </div>
      </div>
  </footer>

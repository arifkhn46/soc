@extends('layouts.app')

@section('content')
<section class="hero is-blue is-bold">
  <div class="hero-body">
    <div class="container">
      <div class="columns has-text-centered">
        <div class="column">
          <img class="wow rollIn merg-img" data-wow-delay=".4s" src="{{ asset('images/a-z/M.png') }}" />
          <h5 class="title is-5">Mathematics</h5>
        </div>
        <div class="column">
          <img class="wow rollIn merg-img" data-wow-delay=".4s" src="{{ asset('images/a-z/E.png') }}" />
          <h5 class="title is-5">English</h5>
        </div>
        <div class="column">
          <img class="wow rollIn merg-img" data-wow-delay=".4s" src="{{ asset('images/a-z/R.png') }}" />
          <h5 class="title is-5">Reasoning</h5>
        </div>
        <div class="column">
          <img class="wow rollIn merg-img" data-wow-delay=".4s" src="{{ asset('images/a-z/G.png') }}" />
          <h5 class="title is-5">General Knowledge</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="hero">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column has-text-centered">
          <h4 class="title is-4 has-text-grey">Online Training & Preparation For Competitive Exams in India</h4>
          <p class="subheading has-no-padding mb-1">Boost your exam preparation with SSCONLINECOACHING.COM</p>
        </div>
      </div>
      <div class="columns">
        <div class="column is-3">
          <div class="card">  
            <div class="card-content">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title is-4">SSC CGL</p>
                </div>
              </div>

              <div class="content">
                Description goes here.
              </div>
            </div>
          </div>
        </div>
        <div class="column is-3">
          <div class="card">  
            <div class="card-content">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title is-4">CHSL</p>
                </div>
              </div>

              <div class="content">
                Description goes here.
              </div>
            </div>
          </div>
        </div>
        <div class="column is-3">
          <div class="card">  
            <div class="card-content">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title is-4">Bank PO</p>
                </div>
              </div>

              <div class="content">
                Description goes here.
              </div>
            </div>
          </div>
        </div>
        <div class="column is-3">
          <div class="card">  
            <div class="card-content">
              <div class="media">
                <div class="media-content has-text-centered">
                  <p class="title is-4">UPSC</p>
                </div>
              </div>

              <div class="content">
                Description goes here.
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="columns">
        <div class="column">
          <div class="carousel">
            <div class="carousel-cell">A</div>
            <div class="carousel-cell">B</div>
            <div class="carousel-cell">B</div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</section>
<section class="testimonials is-medium is-white pt-2 pb-2">
  <div class="container">
    <div class="columns has-text-centered-tablet">
      <div class="column  is-offset-3-widescreen is-6-tablet is-offset-3-tablet is-vertically-centered">
        <div>
          <div class="wow bounceInRight ml-1">
            <h4 class="title is-4 mb-1 has-text-grey" >
              Thousands of students crack exams with SSCONLINECOACHING.COM
            </h4>
            <p class="subheading has-no-padding mb-1">
              “Why should I join SSCONLINECOACHING.COM?” It's a fair enough question! Would
              hundreds upon hundreds of glowing endorsements help?
            </p> 
            <a href="/testimonials" class="button is-primary is-medium is-padded">
              Testimonials
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
<section class="hero footer-section soc-subscribe-section">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div data-wow-delay=".5s" class="column is-5 wow fadeIn">
          <h4 class="title is-4 has-text-centered-mobile has-text-grey">
            Want us to email you with SSCHONLINECOACHING.COM news?
          </h4>
        </div>
        <div class="column is-6 is-offset-1">
          <div class="field has-addons wow lightSpeedIn">
            <div class="control">
              <input class="input is-medium" type="text" placeholder="user@example.com">
            </div>
            <div class="control">
              <a class="button is-medium is-primary">
                Subscribe
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
<section class="hero soc-footer footer-section">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-5">
          <h3 class="title is-3 mb-3 has-text-grey">
            SSCONLNECOACHING.COM
          </h3>
          <p class="footer-description is-heavy mb-3">
            Lots of your peers think SSCONLINECOACHING.COM is one of the best things ever.
            level up your preparation in the process.
          </p>
        </div>
        <div class="column is-6 is-offset-1">          
        </div>
      </div>
    </div>
  </div>
</section> 
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
    var wow = new WOW.WOW({ live: false });
        // flkty = new Flickity( '.carousel ', {});

    wow.init();
  });
</script>
@endsection
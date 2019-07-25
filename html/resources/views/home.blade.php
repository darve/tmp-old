@extends('general.base')

@section('content')

<div class="row">
  <section class="home-header d-flex align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2>We have an eagle eye when it comes to detail</h2>
          <div class="row">
            <div class="col-12">
              <a class="btn btn-outline-light rounded-0" href="/properties">Find your new home</a>
              <a class="btn btn-primary rounded-0" href="https://valuation.rogersand.co/" target="_blank">Free valuation here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="row">
  <section class="home-blurb">
    <div class="container">
      <div class="col-md-12">
        <h1>We are Rogers &amp; Co Estate Agents</h1>
        <p class="sub">Passionate, independent and innovative.</p>

        <p>Rogers &amp; Co have expanded and after the success of their original branch they are now delighted to have an office in the heart of the bustling town of Market Harborough thus bridging the Northamptonshire and Leicestershire borders.</p>
        <p>As the newest estate agency business in Desborough Rogers &amp; Co quickly established themselves as the market leader and are looking to replicate their winning formula in Market Harborough with their own unique style.</p>
        <p>Rogers &amp; Co's properties are advertised using professional photography and floor plans to enhance appearance thereby attracting a wider audience.</p>
        <p>Rogers &amp; Co not only offer Estate Agency services but also a wide range of other services affiliated with property moving, including mortgage / financial advice, surveys and valuation, conveyancing and legal advice through their panel of providers.</p>

      </div>
    </div>
  </section>
</div>

<div class="row">
  <section class="grey latest-properties">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Our latest properties</h1>
          <div id="property-wrapper">
            @include('partials.property', ['class' => 'light'])
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('partials.exceptional-service')
@include('partials.rogers-strap')
@include('partials.signup')

@endsection

@extends('frontend.layout.app')
@section('seo_title', 'Über uns - Büro')
@section('seo_description', 'Bürogründung Martina Hauser und Sabine Meier, Profil, Team')
@section('content')
<header class="page-header has-nav is-narrow">
  <h1>Büro</h1>
  <nav class="page-menu">
    @include('frontend.partials.menu.office')
  </nav>
</header>
<section class="content-office">
  <h2>Team</h2>
  @if (isset($partner_images[0]) || isset($employee_images[0]))
    <div class="grid-2x1">
      <div class="content-visual">
        @if (isset($partner_images[0]))
          <figure>
            <img data-src="/image/team/{{$partner_images[0]->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$partner_images[0]->caption}}">
          </figure>
        @endif
      </div>
      <div class="content-visual hide-sm">
        @if (isset($employee_images[0]))
          <figure>
            <img data-src="/image/team/{{$employee_images[0]->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$employee_images[0]->caption}}">
          </figure>
        @endif
      </div>
    </div>
  @endif
  <div class="content grid-2x1">
    <div>
      @if ($partner_data)
        <div class="grid-2x1">
          @foreach($partner_data as $p)
            <article>
              <h3>{{$p->firstname}} {{$p->name}}</h3>
              <div>
                @if ($p->role) {!! nl2br($p->role) !!}<br>@endif
                @if ($p->email) <a href="mailto:{{$p->email}}">{{$p->email}}</a><br>@endif
                @if ($p->phone) <a href="tel:{{$p->phone}}">{{$p->phone}}</a><br>@endif

                @if ($p->biography)
                  <a href="javascript:;" class="icon-chevron is-bio js-btn-bio js-logo-switch">Kurzbiographie</a>
                  <div class="biography js-bio" style="display:none">
                    @if (isset($p->publishedPortrait[0]))
                      <figure>  
                        <img src="/image/portrait/{{$p->publishedPortrait[0]->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$p->publishedPortrait[0]->name}}">
                      </figure>
                    @endif
                    {!! $p->biography !!}
                  </div>
                @endif
              </div>
            </article>
          @endforeach
        </div>
      @endif

      <div class="content-visual hide-md">
        @if (isset($employee_images[0]))
          <figure>
            <img data-src="/image/team/{{$employee_images[0]->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$employee_images[0]->caption}}">
          </figure>
        @endif
      </div>


    </div>
    <div>
      @if ($employee_data)
        <div class="grid-2x1">
          @foreach($employee_data as $p)
            <article class="employee">
              <h3>{{$p->firstname}} {{$p->name}}</h3>
              <div>
                @if ($p->role) {{$p->role}}<br>@endif
                @if ($p->email) <a href="mailto:{{$p->email}}">{{$p->email}}</a><br>@endif
                @if ($p->phone) {{$p->phone}}<br>@endif
              </div>
            </article>
          @endforeach
        </div>
      @endif
      @if ($former_data)
        <a href="javascript:;" class="icon-chevron is-bio is-former js-btn-former js-logo-switch">Ehemalige Mitarbeiterinnen</a>
        <div style="display:none" class="js-former">
          @foreach($former_data as $former)
            <div>{{$former->firstname}} {{$former->name}}</div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
  <h2>Profil</h2>
  @if ($profile_image)
    <div class="content-visual">
      <figure>
        <img data-src="/image/profile/{{ $profile_image->name }}" class="is-responsive lazyload" width="1600" height="1200" alt="{{ $profile_image->caption }}">
      </figure>
    </div>
  @endif
  @if ($profile_data)
    <div class="content grid-3x1 is-last">
      @foreach($profile_data as $p)
        <article class="word-break">
          <h3>{{ $p->title }}</h3>
          {!! $p->description !!}
        </article>
      @endforeach
    </div>
  @endif
</section>
@endsection
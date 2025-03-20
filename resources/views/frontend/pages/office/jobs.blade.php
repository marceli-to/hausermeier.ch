@extends('frontend.layout.app')
@section('seo_title', 'Jobs - Büro')
@section('seo_description', 'Bürogründung Martina Hauser und Sabine Meier, Profil, Team')
@section('content')
<header class="page-header has-nav is-narrow">
  <h1>Büro</h1>
  <nav class="page-menu">
    @include('frontend.partials.menu.office')
  </nav>
</header>
<section class="content-office">
  @if ($jobs)
    @foreach($jobs as $job)
      <h2>{{$job->title}}</h2>
      <article class="content grid-2x1">
        <div class="content-visual">
          @if (isset($job->publishedImages[0]))
            <figure>
              <img src="/img/job/{{$job->publishedImages[0]->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$job->publishedImages[0]->caption}}">
            </figure>
          @endif
        </div>  
        <div>
          @if ($job->description)
            {!! $job->description !!}
          @endif
          @if ($job->info)
            {!! $job->info !!}
          @endif
        </div>      
      </article>
    @endforeach
  @endif
</section>
@endsection
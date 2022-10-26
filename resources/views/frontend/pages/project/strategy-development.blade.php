@extends('frontend.layout.app')
@section('seo_title', 'Strategien & Entwicklungen')
@section('seo_description', '')
@section('content')
<header class="page-header has-nav">
  <h1>Projekte</h1>
  <nav class="page-menu is-projects">
    <div class="page-menu__project js-menu-projects">
      @include('frontend.partials.menu.projects')
    </div>
  </nav>
</header>
<section class="content-strategy-development">
  <div class="strategy-development-intro">
    <div class="strategy-development-intro__text">{!! $intro->text_intro !!}</div>
    @if ($intro->images && isset($intro->images[0]))
      <div class="content-visual">
        <figure>
          <img data-src="/image/intro/{{ $intro->images[0]->name }}" class="is-responsive lazyload" width="1600" height="1200" alt="{{ $intro->images[0]->caption }}">
        </figure>
      </div>
    @endif
    <div class="content grid-3x1 is-last">
      @if ($intro->text_column_1)
        <article class="strategy-development-text word-break">
          {!! $intro->text_column_1 !!}
        </article>
      @endif
      @if ($intro->text_column_2)
        <article class="strategy-development-text word-break">
          {!! $intro->text_column_2 !!}
        </article>
      @endif
      @if ($intro->text_column_3)
        <article class="strategy-development-text is-last word-break">
          {!! $intro->text_column_3 !!}
        </article>
      @endif
    </div>
  </div>

  @if ($projects)
    @foreach($projects as $project)
      <article class="strategy-development-project grid-2x1" data-article="{{ AppHelper::slug($project->title) }}">
        <header class="hide-md">
          <div>{{$project->category}}</div>
          <h2>{{$project->title}}</h2>
        </header>
        <div class="content-visual">
          @foreach($project->publishedImages as $img)
            @if ($loop->first)
              <figure>
                <a href="/image/lightbox/{{$img->name}}" data-fancybox="gallery-{{$project->id}}" data-caption="{{$img->caption}}">
                  <img data-src="/image/strategy-project/{{$img->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$img->caption}}">
                </a>
              </figure> 
            @else
              <a href="/image/lightbox/{{$img->name}}" data-fancybox="gallery-{{$project->id}}" data-caption="{{$img->caption}}"></a>
            @endif
          @endforeach
        </div>
        <div>
          <header class="hide-sm">
            <div>{{$project->category}}</div>
            <h2>{{$project->title}}</h2>
          </header>
          <div class="strategy-development__content">
            @if ($project->description)
              {!! $project->description !!}
           @endif

           @if ($project->project_id)
            <div class="strategy-development__link">
              <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($project->project->name), 'project' => $project->project->id]) }}" title="{{$project->project->name}}, {{$project->project->location}}">
                {{$project->project->name}} {{$project->project->location}}
              </a>
            </div>
          @endif
          </div>
          @if ($project->info)
            <a href="javascript:;" class="icon-chevron is-se js-btn-se js-logo-switch">Info</a>
            <div class="strategy-development__info js-se" style="display:none">
              {!! $project->info !!}
            </div>
          @endif
        </div>      
      </article>
    @endforeach
  @endif

  {{-- @if ($projects)
    @foreach($projects as $project)
      <article class="strategy-development-project grid-2x1">
        <header class="hide-md">
          @if ($project->rubric)
            <div>{{$project->rubric}}</div>
          @endif
          <h2>{{$project->name}}<br>{{$project->location}}</h2>
        </header>
        <div class="content-visual">
          @foreach($project->publishedImages as $img)
            @if ($loop->first)
              <figure>
                <a href="/image/project/{{$img->name}}" data-fancybox="gallery" data-caption="{{$img->caption}}">
                  <img data-src="/image/project/{{$img->name}}" class="is-responsive lazyload" width="1600" height="1200" alt="{{$img->caption}}">
                </a>
              </figure> 
            @else
              <a href="/image/project/{{$img->name}}" data-fancybox="gallery" data-caption="{{$img->caption}}"></a>
            @endif
          @endforeach
        </div>
        <div>
          <header class="hide-sm">
            @if ($project->rubric)
              <div>{{$project->rubric}}</div>
            @endif
            <h2>{{$project->name}}<br>{{$project->location}}</h2>
          </header>
          <div class="strategy-development__content">
            @if ($project->description)
              {!! $project->description !!}
            @endif
          </div>
          @if ($project->info)
            <div class="strategy-development__info">
              {!! $project->info !!}
            </div>
          @endif
        </div>      
      </article>
    @endforeach
  @endif --}}

</section>
@endsection
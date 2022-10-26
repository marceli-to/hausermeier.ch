@extends('frontend.layout.app')
@section('seo_title', 'Interaktion')
@section('content')
<header class="page-header">
  <h1>Interaktionen</h1>
</header>
<section class="content-interaction">
  <div class="interaction-intro">
    <div class="interaction-intro__text">{!! $intro->text_intro !!}</div>
    @if ($intro->images[0])
      <div class="content-visual">
        <figure>
          <img src="/image/intro/{{ $intro->images[0]->name }}" class="is-responsive" width="1600" height="1200" alt="{{ $intro->images[0]->caption }}">
        </figure>
      </div>
    @endif
    <div class="content grid-3x1 is-last">
      @if ($intro->text_column_1)
        <article class="interaction-intro word-break">
          {!! $intro->text_column_1 !!}
        </article>
      @endif
      @if ($intro->text_column_2)
        <article class="interaction-intro word-break">
          {!! $intro->text_column_2 !!}
        </article>
      @endif
      @if ($intro->text_column_3)
        <article class="interaction-intro is-last word-break">
          {!! $intro->text_column_3 !!}
        </article>
      @endif
    </div>
  </div>
  @if ($interactions)
    @foreach($interactions as $interaction)
      <article class="interaction-project grid-2x1" data-article="{{ AppHelper::slug($interaction->title) }}">
        <header class="hide-md">
          <div>{{$interaction->category}}</div>
          <h2>{{$interaction->title}}</h2>
        </header>
        <div class="content-visual">
          @if ($interaction->video)

            @foreach($interaction->publishedImages as $img)
              @if ($loop->first)
                <figure>
                  <a href="{{$interaction->video}}"  data-fancybox="video" data-caption="{{$img->caption}}">
                    <span class="is-video">
                      <img src="/image/interaction-project/{{$img->name}}" class="is-responsive" width="1600" height="1200" alt="{{$img->caption}}">
                    </span>
                  </a>
                </figure> 
              @endif
            @endforeach
          @else
            @foreach($interaction->publishedImages as $img)
              @if ($loop->first)
                <figure>
                  <a href="/image/lightbox/{{$img->name}}" data-fancybox="gallery-{{$interaction->id}}" data-caption="{{$img->caption}}">
                    <img src="/image/interaction-project/{{$img->name}}" class="is-responsive" width="1600" height="1200" alt="{{$img->caption}}">
                  </a>
                </figure> 
              @else
                <a href="/image/lightbox/{{$img->name}}" data-fancybox="gallery-{{$interaction->id}}" data-caption="{{$img->caption}}"></a>
              @endif
            @endforeach
          @endif
        </div>
        <div>
          <header class="hide-sm">
            <div>{{$interaction->category}}</div>
            <h2>{{$interaction->title}}</h2>
          </header>
          <div class="interaction__content">
            @if ($interaction->description)
              {!! $interaction->description !!}
            @endif

            @if ($interaction->project_id)
              <div class="interaction__link">
                <div class="icon-arrow-up">
                  <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($interaction->project->name), 'project' => $interaction->project->id]) }}" title="{{$interaction->project->name}}, {{$interaction->project->location}}">
                    {{$interaction->project->name}} {{$interaction->project->location}}
                  </a>
                </div>
              </div>
            @endif

            @if ($interaction->link && $interaction->linkText)
              <div class="interaction__link">
                <div class="icon-arrow-up">
                  <a href="{{$interaction->link}}" target="_blank" rel="noopener">
                    {{$interaction->linkText}}
                  </a>
                </div>
              </div>
            @endif

          </div>
          @if ($interaction->info)
            <a href="javascript:;" class="icon-chevron is-interaction js-btn-interaction js-logo-switch">Info</a>
            <div class="interaction__info js-interaction" style="display:none">
              {!! $interaction->info !!}
            </div>
          @endif
        </div>      
      </article>
    @endforeach
  @endif
</section>
@endsection
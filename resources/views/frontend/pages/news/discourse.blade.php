@extends('frontend.layout.app')
@section('seo_title', 'Aktuell - Diskurs')
@section('seo_description', 'Projekte, Aktuelles, Diskurs, Publikationen')
@section('content')
<header class="page-header has-nav">
  <h1>Aktuell</h1>
  <nav class="page-menu">
    @include('frontend.partials.menu.news')
  </nav>
</header>
@if ($groupedEntries)
  @foreach($groupedEntries as $entries)
    <h2 class="is-narrow">{{$entries[0]->topic->title}}</h2>
    <section class="content-news js-msnry">
      @foreach($entries as $e)
        <article class="news is-discourse {{ $loop->last ? 'is-last': '' }} {{ $loop->first ? 'is-first': '' }} js-msnry-item">
          <div class="news__date">{{ strftime("%e. %B %Y", strtotime($e->date)) }}</div>
          <h3>{{$e->title}}</h3>
          @if ($e->previewImage)
            <figure>
              <a href="/image/lightbox/{{$e->previewImage->name}}" data-fancybox="gallery-{{$e->id}}" data-caption="{{$e->previewImage->caption}}">
                <img src="/image/discourse/{{$e->previewImage->name}}" class="is-responsive" width="1600" height="1200" alt="{{$e->previewImage->caption}}">
              </a>
            </figure>
          @endif
          @foreach($e->publishedImages as $img)
            @if ($img->is_preview == 0)
              <a href="/image/lightbox/{{$img->name}}" data-fancybox="gallery-{{$e->id}}" data-caption="{{$img->caption}}"></a>
            @endif
          @endforeach
          <div class="news__description">
            {!! $e->description !!}
            <div class="news__links">
              @if ($e->project)
                <div>
                  <div class="icon-arrow-up">
                    <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($e->project->name), 'project' => $e->project->id]) }}" title="{{$e->project->name}}, {{$e->project->location}}">
                      Projekt
                    </a>
                  </div>
                </div>
              @endif
              @if ($e->interactionProject)
                <div>
                  <div class="icon-arrow-up">
                    <a href="/interaktionen/#{{AppHelper::slug($e->interactionProject->title)}}" title="{{$e->interactionProject->name}}">
                      Interaktion
                    </a>
                  </div>
                </div>
              @endif
              @if ($e->strategyProject)
                <div>
                  <div class="icon-arrow-up">
                    <a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($e->strategyProject->title)}}" title="{{$e->strategyProject->name}}">
                      Strategie und Entwicklung
                    </a>
                  </div>
                </div>
              @endif
              @if ($e->publishedDocuments)
                @foreach($e->publishedDocuments as $document)
                  <div class="icon-document">
                    <a href="/storage/uploads/{{$document->name}}" target="_blank" title="Download {{$document->caption}}">
                      {{$document->caption}}
                    </a>
                  </div>
                @endforeach
              @endif
            </div>
            @if ($e->info)
              <div class="news__info">
                {!! $e->info !!}
              </div>
            @endif
          </div>
        </article>
      @endforeach
    </section>
  @endforeach
@endif
@endsection
@extends('frontend.layout.app')
@section('seo_title', $project->name . ' ' . $project->location . ', ' . $project->type . ', ' . $project->year)
@if ($project->info)
  @section('seo_description', substr(strip_tags($project->description),0,255))
@endif
@if ($og)
  @section('og_image', url('/') . '/image/opengraph/'.$og)
@endif
@section('content')
<header class="page-header has-nav">
  <h1>Projekte</h1>
  <nav class="page-menu is-projects">
    <div class="page-menu__project js-menu-projects">
      @include('frontend.partials.menu.projects')
    </div>
  </nav>
</header>
<section class="content-project">
  <nav class="project-browse">
    <ul>
      @if ($browse['prev'])
        <a 
          href="{{ route('page.project.show', ['slug' => AppHelper::slug($browse['prev']->name), 'project' => $browse['prev']->id]) }}" 
          class="icon-browse-prev"
          title="{{$browse['prev']->name}}, {{$browse['prev']->location}}">
        </a>
      @endif
      @if ($browse['next'])
        <a 
          href="{{ route('page.project.show', ['slug' => AppHelper::slug($browse['next']->name), 'project' => $browse['next']->id]) }}" 
          class="icon-browse-next"
          title="{{$browse['next']->name}}, {{$browse['next']->location}}">
        </a>
      @endif
    </ul>
  </nav>
  <header class="project-header">
    <h1>{{$project->name}} {{$project->location}}<br>{{$project->type}}, {{$project->year}}</h1>
    <nav class="project-info">
      <ul>
        @if ($project->description || $project->info)
          <li>
            <a href="javascript:;" class="icon-chevron js-btn-info js-logo-switch">Info</a>
          </li>
        @endif
        @if ($project->publishedDocuments)
          <li>
            <a href="/storage/uploads/{{$project->publishedDocuments->name}}" target="_blank" title="Download">pdf</a>
          </li>
        @endif
        @if ($project->interactionProject)
          <li>
            <div class="icon-arrow-up">
              <a href="/interaktionen/#{{AppHelper::slug($project->interactionProject->title)}}">Interaktion</a>
            </div>
          </li>
        @endif
        @if ($project->strategyProject)
          <li>
            <div class="icon-arrow-up">
              <a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($project->strategyProject->title)}}">Strategie & Entwicklung</a>
            </div>
          </li>
        @endif
      </ul>
    </nav>
  </header>
  <div class="project">
    @if ($grids)
      <div class="project-grid">
        <div class="ratio-boxes">
          @foreach($grids as $g)
            @if ($g['key'] == '1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1-1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1-2')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '2-1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1-1-1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1-1-2s')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1-2s-1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '2s-1-1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1p-1p-1p')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '2s-1')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
            @if ($g['key'] == '1-2s')
              @if (isset($g['elements']))
                @include('frontend.partials.boxes.project.' . $g['key'], array('elements' => $g['elements']))
              @endif
            @endif
          @endforeach
        </div>
      </div>
    @endif
    <div class="project-description js-info">
      @if ($project->description)
        <div>{!! $project->description !!}</div>
      @endif
      @if ($project->info)
        <div class="project-description__info">{!! $project->info !!}</div>
      @endif
      <div class="project-description__links">
        <div>
          @if ($project->publishedDocuments)
            <a href="/storage/uploads/{{$project->publishedDocuments->name}}" target="_blank" title="Download">pdf</a>
          @endif
        </div>
        @if ($project->interactionProject)
          <div>
            <div class="icon-arrow-up">
              <a href="/interaktionen/#{{AppHelper::slug($project->interactionProject->title)}}">Interaktion</a>
            </div>
          </div>
        @endif
        @if ($project->strategyProject)
          <div>
            <div class="icon-arrow-up">
              <a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($project->strategyProject->title)}}">Strategie & Entwicklung</a>
            </div>
          </div>
        @endif
      </div>
    </div>
    @if ($browse['next'])
      <div class="project-teaser">
        <label>Nächstes Projekt</label>
        <figure>
          <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($browse['next']->name), 'project' => $browse['next']->id]) }}" title="{{$browse['next']->name}}, {{$browse['next']->location}}">
            <h3>{{$browse['next']->name}}, {{$browse['next']->location}}</h3>
            @if ($browse['next']->previewImage)
              <img src="/img/work-preview/{{$browse['next']->previewImage->name}}" class="is-responsive" height="400" width="800">
            @endif
          </a>
        </figure>
      </div>
    @endif
  </div>
</section>
@endsection

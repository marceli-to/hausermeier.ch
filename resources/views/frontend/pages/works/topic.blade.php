@extends('frontend.layout.app')
@section('seo_title', 'Werkliste - Thema')
@section('content')
<header class="page-header has-nav is-narrow">
  <h1>Werkliste</h1>
  <nav class="page-menu is-works">
    @include('frontend.partials.menu.works')
  </nav>
</header>
<section class="content-works js-works" data-type="images">
  @if ($works)
    @foreach($works as $work)
       <div class="collapsible js-clpsbl">
        <h2>
          <a href="javascript:;" class="btn-collapsible js-clpsbl-btn">
            @if (!$work[0]->is_strategy_project)
              {{ isset($work[0]->program->title) ? $work[0]->program->title : null }}
            @else
              Strategie & Entwicklung
            @endif
          </a>
        </h2>
        <div class="collapsible__content js-clpsbl-body" style="display: none">
          <div class="work-items grid-4x1">
            @foreach(collect($work)->sortByDesc('year') as $w)
              <article class="work-text-media">
                @if ($w->previewImage)
                  <figure>
                    @if (!$w->is_strategy_project && $w->has_detail)
                      <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w->name), 'project' => $w->id]) }}" title="{{ $w->name }}, {{ $w->location }}">
                        <img data-src="/img/work-preview/{{$w->previewImage->name}}" class="is-responsive lazyload" width="1000" height="698" alt="{{$w->previewImage->caption}}">
                      </a>
                    @else
                      <img data-src="/img/work-preview-se/{{$w->previewImage->name}}" class="is-responsive lazyload" width="1000" height="698" alt="{{$w->previewImage->caption}}">
                    @endif
                  </figure>
                @endif
                @if (!$w->is_strategy_project && $w->has_detail)
                  <div class="icon-arrow-up-before">
                    <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w->name), 'project' => $w->id]) }}" title="{{ $w->name }}, {{ $w->location }}">
                      {{$w->name}}
                      @if ($w->info_works_1 || $w->info_works_2)<br>@endif
                      @if ($w->info_works_1) {{$w->info_works_1}}<br>@endif
                      @if ($w->info_works_2) {{$w->info_works_2}}@endif
                    </a>
                  </div>
                @else
                  @if ($w->is_strategy_project)
                    <div class="icon-arrow-up-before">
                      <a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($w->title)}}" title="{{ $w->title }}">
                        {{$w->title}}
                        @if ($w->info_works_1 || $w->info_works_2)<br>@endif
                        @if ($w->info_works_1) {{$w->info_works_1}}<br>@endif
                        @if ($w->info_works_2) {{$w->info_works_2}}@endif
                      </a>
                    </div>
                  @else
                    {{$w->name}}
                    @if ($w->info_works_1 || $w->info_works_2)<br>@endif
                    @if ($w->info_works_1) {{$w->info_works_1}}<br>@endif
                    @if ($w->info_works_2) {{$w->info_works_2}}@endif
                  @endif
                @endif
              </article>
            @endforeach
          </div>
        </div>
      </div>
    @endforeach
  @endif
</section>
<section class="content-works content-works--list js-works" data-type="list" style="display:none">
  @if ($works_columns)
    <div class="grid-4x1">
      @foreach($works_columns as $column)
        <div>
          @foreach($column as $work)
            <h2>
              @if (!$work[0]['is_strategy_project'])
                {{ isset($work[0]['program']['title']['de']) ? $work[0]['program']['title']['de'] : null }}
              @else
                Strategie & Entwicklung
              @endif
            </h2>
            <div class="work-items-list {{$loop->last ? 'is-last' : ''}}">
              @foreach(collect($work)->sortByDesc('year') as $w)
                <article class="work-text">
                  @if ($w['has_detail'])
                    <div class="icon-arrow-up-before">
                      <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w['name']['de']), 'project' => $w['id']]) }}" title="{{$w['name']['de'] }}">
                        {{$w['name']['de']}}
                        @if (isset($w['info_works_1']['de']) || isset($w['info_works_2']['de']))<br>@endif
                        @if (isset($w['info_works_1']['de'])) {{$w['info_works_1']['de']}}<br>@endif
                        @if (isset($w['info_works_2']['de'])) {{$w['info_works_2']['de']}}@endif
                      </a>
                    </div>
                  @else
                    <div class="icon-dash">
                      {{$w['name']['de']}}
                      @if (isset($w['info_works_1']['de']) || isset($w['info_works_2']['de']))<br>@endif
                      @if (isset($w['info_works_1']['de'])) {{$w['info_works_1']['de']}}<br>@endif
                      @if (isset($w['info_works_2']['de'])) {{$w['info_works_2']['de']}}@endif
                    </div>
                  @endif
                </article>
              @endforeach
            </div>
          @endforeach
        </div>
      @endforeach
      <div>
        <h2>Strategie & Entwicklung</h2>
        <div class="work-items-list is-last">
          @foreach(collect($works_strategy)->sortByDesc('year') as $w)
            <article class="work-text">
              @if ($w['is_strategy_project'])
                <div class="icon-arrow-up-before">
                  <a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($w->title)}}" title="{{ $w->title }}">
                    {{$w->title}}
                    @if (isset($w->info_works_1) || isset($w->info_works_2))<br>@endif
                    @if (isset($w->info_works_1)) {{$w->info_works_1}}<br>@endif
                    @if (isset($w->info_works_2)) {{$w->info_works_2}}@endif
                  </a>
                </div>
              @endif
            </article>
          @endforeach
        </div>
      </div>
    </div>
  @endif
</section>
@endsection
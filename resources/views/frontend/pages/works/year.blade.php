@extends('frontend.layout.app')
@section('seo_title', 'Werkliste - Jahr')
@section('content')
<header class="page-header has-nav is-narrow">
  <h1>Werkliste</h1>
  <nav class="page-menu is-works">
    @include('frontend.partials.menu.works')
  </nav>
</header>
<section class="content-works content-works--year js-works" data-type="images">
  <h2>{{$heading}}</h2>
  @if ($works)
    <div class="work-items grid-4x1">
      @foreach($works as $work)
        @foreach($work as $w)
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
                <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w->name), 'project' => $w->id]) }}" title="{{ $w->name }}, {{ $w->type }}">
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
      @endforeach
    </div>
  @endif
</section>

<section class="content-works content-works--list js-works" data-type="list" style="display:none">
  @if ($works_columns)
    <div class="grid-4x1">
      @foreach($works_columns as $column)
        <div>
          @foreach($column as $work)
            <h2>{{$work[0]['year']}}</h2>
            <div class="work-items-list {{$loop->last ? 'is-last' : ''}}">
              @foreach($work as $w)
                <article class="work-text">
                  @if (!$w['is_strategy_project'] && $w['has_detail'])
                    <div class="icon-arrow-up-before">
                      <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w['name']['de']), 'project' => $w['id']]) }}" title="{{$w['name']['de'] }}, {{$w['type']['de']}}">
                        {{$w['name']['de']}}
                        @if (isset($w['info_works_1']['de']) || isset($w['info_works_2']['de']))<br>@endif
                        @if (isset($w['info_works_1']['de'])) {{$w['info_works_1']['de']}}<br>@endif
                        @if (isset($w['info_works_2']['de'])) {{$w['info_works_2']['de']}}@endif
                      </a>
                    </div>
                  @else
                    @if ($w['is_strategy_project'])
                      <div class="icon-arrow-up-before">
                        <a href="/projekte/strategien-und-entwicklungen/#{{AppHelper::slug($w['title']['de'])}}" title="{{ $w['title']['de'] }}">
                          {{$w['title']['de']}}
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
                  @endif
                </article>
              @endforeach
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
  @endif
</section>

@endsection
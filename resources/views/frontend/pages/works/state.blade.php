@extends('frontend.layout.app')
@section('seo_title', 'Werkliste - Status')
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
      <h2>{{__('settings.' . config('settings.projectState.' . $work[0]->state))}}</h2>
      <div class="work-items grid-4x1">
        @foreach($work as $w)
          <article class="work-text-media">
            @if ($w->previewImage)
              <figure>
                @if ($w->has_detail)
                  <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w->name), 'project' => $w->id]) }}" title="{{ $w->name }}, {{ $w->location }}">
                    <img data-src="/image/work-preview/{{$w->previewImage->name}}" class="is-responsive lazyload" width="1000" height="698" alt="{{$w->previewImage->caption}}">
                  </a>
                @else
                  <img data-src="/image/work-preview-se/{{$w->previewImage->name}}" class="is-responsive lazyload" width="1000" height="698" alt="{{$w->previewImage->caption}}">
                @endif
              </figure>
            @endif
            @if ($w->has_detail)
              <div class="icon-arrow-up">
                <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w->name), 'project' => $w->id]) }}" title="{{ $w->name }}, {{ $w->location }}">
                  {{$w->name}}, {{$w->year}}
                </a>
              </div>
            @else
              {{$w->name}}, {{$w->year}}
            @endif
            @if ($w->info_works_1)
              <span class="work-text__info">{{$w->info_works_1}}</span>
            @endif
            @if ($w->info_works_2)
              <span class="work-text__info">{{$w->info_works_2}}</span>
            @endif
          </article>
        @endforeach
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
            <h2>{{__('settings.' . config('settings.projectState.' . $work[0]['state']))}}</h2>
            <div class="work-items-list {{$loop->last ? 'is-last' : ''}}">
              @foreach($work as $w)
                <article class="work-text">
                  @if ($w['has_detail'])
                    <div class="icon-arrow-up">
                      <a href="{{ route('page.project.show', ['slug' => AppHelper::slug($w['name']['de']), 'project' => $w['id']]) }}" title="{{$w['name']['de'] }}, {{$w['type']['de']}}">
                        {{$w['name']['de']}}, {{$w['type']['de']}}
                      </a>
                    </div>
                  @else
                    <div class="icon-dash">
                      {{$w['name']['de']}}, {{$w['type']['de']}}
                    </div>
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
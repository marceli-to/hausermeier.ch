@if ($news['layout'] == 0)
  <article class="news-article is-outline">
@elseif ($news['layout'] == 1)
  <article class="news-article is-yellow">
@else 
  <article class="news-article is-grey">
@endif
  <div>
    @if ($news['date'])
      <header>{{$news['date']}}</header>
    @endif
    <h2>{{$news['title']}}</h2>
    {!! $news['description'] !!}

    @if ($news->publishedImages)
      <figure>
        <img src="/img/news/{{$news->publishedImages->name}}" alt="" class="">
      </figure>
    @endif


    @if ($news['link'])
      <footer>
        <a href="{{$news['link']}}" class="icon-arrow-up-sm is-news">
          {{$news['linkText']}}
        </a>
      </footer>
    @endif
  </div>
</article>
@if ($news['short_title'])
  <div class="caption">{{$news['short_title']}}</div>
@endif
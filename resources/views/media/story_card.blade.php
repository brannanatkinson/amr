<a href="/stories/{{ $story->id }}/edit">
<div class="card-flex-article card">
  <div class="card-image">
    @if ( is_null($story->story_image) )

      <img src="{{ url ('/img/' . $story->id . '.jpg') }}" alt="">                         
      
    @else
      <img src="{{ $story->story_image }}" alt="" >
      
    @endif
    <span class="label alert card-tag">{{ $story->client->client_name }}</span>
  </div>
  <div class="card-section">
    <h3 class="article-title">{{ $story->story_headline }}</h3>
    <div class="article-details">
      <span class="website">{{ date("m/d/Y", strtotime($story->story_date)) }} | {{ $story->project->project_name }}</span>
    </div>
  </div>
</div>
</a>

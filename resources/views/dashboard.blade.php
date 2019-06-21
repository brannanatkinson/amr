@extends('layout')

@section('content')
    {{-- header --}}
    <div class="ui container">
        @if ( Auth::user()->hasRole('siteadmin') ) 

                    <h1 class="ui header">Dashboard for All Clients</h1>

                @else

                    <h1 class="ui header">Dashboard for {{App\Client::find(Auth::user()->client_id)['client_name']}}</h1>

                @endif
    </div>

    <!-- Most recent mentions -->
    <div class="section" style="margin-bottom: 50px;">
        <div class="ui container">
            <h2>Most Recent Mentions</h2>
            @php
                $stories = App\Client::find(Auth::user()->client_id)->stories->sortByDesc('created_at')->take(6);
            @endphp
            <div class="ui three stackable cards">   
                @foreach ( $stories as $story )  
                    <div class="ui raised card">
                        <div class="content">
                            {{-- <div class="right floated">
                                <a href="{{ $story->story_url }}" target="_blank"><i class="large grey play icon"></i></a>
                            </div> --}}
                            <div class="story__details">
                                <span class="story__date story__weekday">{{ Carbon\Carbon::parse($story->story_date)->format('l,') }}</span>
                                <span class="story__date"><span class="story__day">{{ Carbon\Carbon::parse($story->story_date)->format('M d,') }}</span> </span>
                                <span class="story__year">{{ Carbon\Carbon::parse($story->story_date)->format('Y') }}</span>
                            </div>
                            @if(strpos($story->story_url, 'twitter') == true )
                                <h3>Twitter</h3>
                            @else
                                <i>{{ $story->org->org_name }}</i>
                            @endif
                        </div>
                        <div class="image">
                            @if(strpos($story->story_url, 'twitter') == true )
                                <img style="height: 200px; object-fit: cover;" src="/img/twitter_logo.png" alt="" >
                            @else
                                @if ( is_null($story->story_image) )
                                    <img style="height: 200px; object-fit: cover;" src="{{ url ('/img/' . $story->id . '.jpg') }}" alt="">                                                                          
                                @else
                                    <img style="height: 200px; object-fit: cover;" src="{{ $story->story_image }}" alt="" >
                                {{-- @elseif(strpos($story->story_url, 'twitter') == true )
                                    <h3>placeholder:twitter</h3> --}}
                                @endif
                            @endif
                        </div>
                        <div class="content">
                            @if(strpos($story->story_url, 'twitter') == true )
                                <a href="{{ $story->story_url }}" target="_blank"><h3>View Tweet</h3></a>
                            @else 
                                <a href="{{ $story->story_url }}" target="_blank"><h3>{{ str_limit( $story->headline(), $limit = 60, $end = '...') }}</h3></a>
                                @if ( $story->notes() )
                                    <p style="padding-top: 20px;">Notes: {{ $story->notes() }}</p>
                                @endif
                            @endif
                        </div>
                        <div class="extra content">
                            {{ $story->project->project_name }}
                            @if ( Auth::user()->hasRole('siteadmin') ) 
                                <p>{{ $story->getClientName() }}</p>
                            @endif
                            @if ( Auth::user()->hasRole('siteadmin') ) 
                                <a class="deleteStory right floated ui button" data-id="{{ $story->id }}">Delete</a>
                                <a class="right floated ui button" href="/stories/{{ $story->id }}/edit">Edit</a>

                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="ui right aligned header"><a href='/stories'>All mentions >></a></div>
        </div>
    </div>

    <!-- client stats -->
    <div class="section" style="background-color: #eee; padding: 50px 0px; text-align: center;">
        <p style="text-transform: uppercase;">Atkinson Media Reports Metrics for OZ Arts</p>
        <div class="ui three statistics">
            <div class="blue statistic">
                <div class="value">{{ App\Client::find(Auth::user()->client_id)->stories->count() }}</div>
                <div class="label">total mentions</div>
            </div>
            <div class="blue statistic">
                <div class="value">{{ App\Client::find(Auth::user()->client_id)->projects->count() }}</div>
                <div class="label">projects</div>
            </div>
            <div class="blue statistic">
                <div class="value">{{ App\Client::find(Auth::user()->client_id)->orgs()->count() }}</div>
                <div class="label">media outlets</div>
            </div>
        </div>
    </div>

    <!-- most recent projects -->
    <div class="section" style="background-color: #fff; padding: 50px 0px;">
        <div class="ui container">
            <h2 class="ui header">
              Most Recent Projects
              <div class="sub header">Click a project to see mentions</div>
            </h2>

            @php
                $projects = App\Client::find(Auth::user()->client_id)->projects->sortByDesc('created_at')->take(5);
            @endphp
            
            <ul style="font-size: 1.5em; line-height: 1.5;">
                @foreach ( $projects as $project )
                    <li><a href="/projects/{{ $project->id }}">{{ $project->project_name }}</a></li>
                @endforeach
            </ul>
            <div class="ui right aligned header"><a href='/projects'>All projects >></a></div>
        </div>
    </div>
@endsection

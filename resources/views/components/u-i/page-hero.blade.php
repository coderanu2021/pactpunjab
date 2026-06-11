
<div class="page-hero">
    <div class="hero-glow"></div>
    <div class="hero-glow2"></div>

    <div class="page-hero-inner">

        {{-- Breadcrumb --}}
@if($breadcrumbs && count($breadcrumbs))
            <div class="breadcrumb">

                @foreach($breadcrumbs as $breadcrumb)

                    @if(!$loop->first)
                        <i class="fas fa-chevron-right"></i>
                    @endif

                    @if(isset($breadcrumb['url']))
                        <a href="{{ $breadcrumb['url'] }}">
                            {{ $breadcrumb['label'] }}
                        </a>
                    @else
                        <span class="active">
                            {{ $breadcrumb['label'] }}
                        </span>
                    @endif

                @endforeach

            </div>
        @endif

        {{-- Page Tag --}}
        @if($subtitle)
            <div class="page-hero-tag">
                <span>{{ $subtitle }}</span>
            </div>
        @endif

        {{-- Title --}}
        <h1>
            {{ $title }}
        </h1>

        {{-- Description --}}
        @if($description)
            <p>
                {{ $description }}
            </p>
        @endif

        {{-- Hero Chips --}}
        @isset($chips)
            <div class="hero-chips">
                {{ $chips }}
            </div>
        @endisset

    </div>
</div>
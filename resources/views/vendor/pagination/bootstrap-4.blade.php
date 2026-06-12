@if ($paginator->hasPages())
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
  <div style="font-size:12px;color:var(--text-muted)">
    Showing <strong style="color:var(--text-main)">{{ $paginator->firstItem() }}</strong>
    – <strong style="color:var(--text-main)">{{ $paginator->lastItem() }}</strong>
    of <strong style="color:var(--text-main)">{{ $paginator->total() }}</strong> results
  </div>
  <div style="display:flex;gap:4px;align-items:center">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
      <span style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:inline-flex;align-items:center;justify-content:center;font-size:12px;color:var(--text-muted);cursor:not-allowed;opacity:.5">
        <i class="fa-solid fa-chevron-left"></i>
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--surface);display:inline-flex;align-items:center;justify-content:center;font-size:12px;color:var(--text-secondary);text-decoration:none;transition:all .15s" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background='var(--surface)'">
        <i class="fa-solid fa-chevron-left"></i>
      </a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
      @if (is_string($element))
        <span style="width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;font-size:13px;color:var(--text-muted)">…</span>
      @endif
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span style="width:32px;height:32px;border-radius:7px;background:var(--primary);color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;font-family:var(--font)">{{ $page }}</span>
          @else
            <a href="{{ $url }}" style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--surface);display:inline-flex;align-items:center;justify-content:center;font-size:13px;color:var(--text-secondary);text-decoration:none;font-family:var(--font);transition:all .15s" onmouseover="this.style.background='var(--bg)';this.style.color='var(--primary)'" onmouseout="this.style.background='var(--surface)';this.style.color='var(--text-secondary)'">{{ $page }}</a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--surface);display:inline-flex;align-items:center;justify-content:center;font-size:12px;color:var(--text-secondary);text-decoration:none;transition:all .15s" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background='var(--surface)'">
        <i class="fa-solid fa-chevron-right"></i>
      </a>
    @else
      <span style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:inline-flex;align-items:center;justify-content:center;font-size:12px;color:var(--text-muted);cursor:not-allowed;opacity:.5">
        <i class="fa-solid fa-chevron-right"></i>
      </span>
    @endif

  </div>
</div>
@endif

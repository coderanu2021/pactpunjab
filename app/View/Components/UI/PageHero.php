<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHero extends Component
{
    /**
     * Create a new component instance.
     */
     public string $title;
    public ?string $subtitle;
    public ?string $description;
    public array $breadcrumbs;

    public function __construct(string $title,?string $subtitle = null,?string $description = null,array $breadcrumbs = []
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
        $this->breadcrumbs = $breadcrumbs;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.u-i.page-hero');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CourseCard extends Component
{
    public $title;
    public $description;
    public $mediaLink;
    public $createdBy;
    public $courseId;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $description, $mediaLink, $createdBy, $courseId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->mediaLink = $mediaLink;
        $this->createdBy = $createdBy;
        $this->courseId = $courseId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-card');
    }
}

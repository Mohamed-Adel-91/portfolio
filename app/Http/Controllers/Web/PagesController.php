<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ContactRequest;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Intro;
use App\Models\Gallery;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        $intro = Intro::first();
        $about = About::first();
        $settings = Setting::first();
        $educations = Education::with('university')
            ->orderBy('start_at', 'desc')
            ->get();
        $experiences = Experience::with('company')
            ->orderBy('start_at', 'desc')
            ->get();
        $skillsByType = Skill::orderBy('type')
            ->orderByDesc('progress')
            ->get()
            ->groupBy('type');
        $portfolioFilters = $this->buildPortfolioFilters();
        $portfolioItems = $this->buildPortfolioItems($portfolioFilters);
        $portfolioItems = $this->paginateItems($portfolioItems, 9);

        return view('web.layouts.master')->with([
            'pageName' => 'Mohamed Adel - Personal Portfolio Website',
            'intro' => $intro,
            'about' => $about,
            'settings' => $settings,
            'educations' => $educations,
            'experiences' => $experiences,
            'skillsByType' => $skillsByType,
            'portfolioFilters' => $portfolioFilters,
            'portfolioItems' => $portfolioItems,
        ]);
    }

    private function buildPortfolioFilters(): Collection
    {
        $filters = collect([
            ['id' => 'all', 'label' => 'See All'],
            ['id' => 1, 'label' => 'Certificates', 'type' => 'certificates'],
            ['id' => 2, 'label' => 'Events', 'type' => 'events'],
        ]);

        $projects = Project::with(['portfolioItems' => function ($q) {
            $q->whereNotNull('image')
                ->where('image', '!=', '');
        }])
            ->orderBy('lunched_at', 'desc')
            ->get()
            ->filter(fn ($project) => $project->portfolioItems->isNotEmpty());
        $nextId = 10;

        foreach ($projects as $project) {
            $filters->push([
                'id' => $nextId,
                'label' => $project->name ?? 'Project',
                'type' => 'project',
                'projectId' => $project->id,
            ]);
            $nextId++;
        }

        return $filters;
    }

    private function buildPortfolioItems(Collection $filters): Collection
    {
        $items = collect();

        $certificates = Education::orderByDesc('start_at')->get();
        foreach ($certificates as $edu) {
            if (empty($edu->image)) {
                continue;
            }
            $image = $edu->image ? asset('upload/' . ltrim($edu->image, '/')) : 'https://via.placeholder.com/600x400?text=Certificate';
            $items->push([
                'category' => 1,
                'title' => $edu->title ?? 'Certificate',
                'subtitle' => $edu->sub_title ?? $edu->type ?? 'Certificate',
                'image' => $image,
                'link' => $edu->image ? $image : '#',
                'badge' => 'Certificate',
            ]);
        }

        $events = Gallery::orderByDesc('created_at')->get();
        foreach ($events as $event) {
            if (empty($event->image)) {
                continue;
            }
            $image = $event->image ? asset('upload/gallery/' . ltrim($event->image, '/')) : 'https://via.placeholder.com/600x400?text=Event';
            $items->push([
                'category' => 2,
                'title' => $event->title ?? 'Event',
                'subtitle' => $event->sub_title ?? 'Event',
                'image' => $image,
                'link' => $event->iframe ?: ($event->image ? $image : '#'),
                'badge' => 'Event',
            ]);
        }

        $filtersProjects = $filters->where('type', 'project')->keyBy('projectId');
        $projects = Project::with('portfolioItems')->orderBy('lunched_at', 'desc')->get();

        foreach ($projects as $project) {
            $filterId = optional($filtersProjects->get($project->id))['id'] ?? null;
            if (! $filterId) {
                continue;
            }

            foreach ($project->portfolioItems as $port) {
                if (empty($port->image)) {
                    continue;
                }
                $imagePath = ltrim($port->image, '/');
                if (Str::startsWith($imagePath, 'portfolio/')) {
                    $imagePath = Str::after($imagePath, 'portfolio/');
                }
                $image = asset('upload/portfolio/' . $imagePath);

                $items->push([
                    'category' => $filterId,
                    'title' => $port->title ?? $project->name ?? 'Project',
                    'subtitle' => $port->sub_title ?? 'Project',
                    'image' => $image,
                    'link' => $image,
                    'badge' => 'Project',
                ]);
            }
        }

        return $items;
    }

    private function paginateItems(Collection $items, int $perPage = 9): LengthAwarePaginator
    {
        $currentPage = max((int) request()->input('page', 1), 1);
        $total = $items->count();
        $results = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function contactUs()
    {
        return view('web.contact-us')->with([
            'pageName' => 'Contact Me',
        ]);
    }

    public function submitContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $contactRequest = ContactRequest::create($validator->validated());

        return response()->json([
            'status' => true,
            'errors' => [],
            'contactRequest' => $contactRequest,
        ]);
    }
}

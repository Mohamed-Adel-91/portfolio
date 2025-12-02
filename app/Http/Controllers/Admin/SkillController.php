<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\UpdateSkillRequest;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('type')->orderBy('name')->paginate(20);

        return view('admin.skills.index', [
            'pageName' => 'Skills',
            'skills' => $skills,
        ]);
    }

    public function create(): View
    {
        return view('admin.skills.create', [
            'pageName' => 'Add Skill',
            'skill' => new Skill(),
        ]);
    }

    public function store(StoreSkillRequest $request): RedirectResponse
    {
        Skill::create($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', [
            'pageName' => 'Edit Skill',
            'skill' => $skill,
        ]);
    }

    public function update(UpdateSkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}

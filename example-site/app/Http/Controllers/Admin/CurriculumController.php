<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;
use App\Models\CurriculumExit;
use App\Models\Employment;
use App\Models\Section;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use  Lwwcas\LaravelCountries\Models\Country;


class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($per_page = 10, )
    {
        return Inertia::render('Admin/Forms/Curriculum/List',
            [
                'curriculums' => Curriculum::with(['user', 'section', 'curriculum_exit', 'track', 'employment'])->paginate(10)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Forms/Curriculum/Create',
            [
                'sections'  => Section::get(),
                'curriculum_exits' => CurriculumExit::get(),
                'tracks' => Track::get(),
                'countries' => Country::_all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurriculumRequest $request)
    {
        $validated = $request->safe();

        $curriculum = new Curriculum;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' =>  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $employment = Employment::create([
            'status' => $validated['employment_status'],
            'address' => $validated['address']
        ]);


        $track = Track::find($validated['track']);

        $section = Section::find($validated['section']);

        $curriculum_exit = CurriculumExit::find($validated['curriculum_exit']);

        $curriculum->track()->associate($track);
        $curriculum->user()->associate($user);
        $curriculum->section()->associate($section);
        $curriculum->curriculum_exit()->associate($curriculum_exit);
        $curriculum->employment()->associate($employment);
        $curriculum->emmersion_company = $validated['emmersion_company'];
        $curriculum->lrn = $validated['lrn'];


        $curriculum->save();
         // go back the the roles.index route
       return Redirect::route('curriculums.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        $curriculum->delete();
          // go back the the roles.index route
       return Redirect::route('curriculums.index');
    }
}

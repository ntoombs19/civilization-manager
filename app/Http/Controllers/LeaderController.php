<?php

namespace App\Http\Controllers;

use App\Data\LeaderData;
use App\Models\Leader;
use App\Models\Civilization;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class LeaderController extends Controller
{
    public function index(Request $request): Response
    {
        $page = intval($request->get('page', 1) ?: 1);
        $search = $request->query('search');
        $pageSize = $request->query('pageSize', '12');
        $sort = $request->query('sort', 'name,asc');
        $filters = $request->query('filters', '');
        [$column, $direction] = explode(',', $sort);

        $leaders = Leader::query()
            ->with('civilization')
            ->when($search, fn ($query) => $query
                ->where('name', 'like', "%$search%")
                ->orWhere('subtitle', 'like', "%$search%")
                ->orWhere('lived', 'like', "%$search%"))
            ->when($filters, fn ($query) => $query->where(fn ($query) => collect(explode(',', $filters))
                ->map(fn ($filter) => explode('=', $filter))
                ->each(fn ($filter) => $query->where($filter[0], 'like', "%$filter[1]%")))
            )
            ->orderBy($column, $direction)
            ->paginate($pageSize, ['*'], 'users', $page);

        return Inertia::render('Leaders/Index', [
            'leaders' => LeaderData::collect($leaders)->values(),
            'page' => $leaders->currentPage(),
            'pageSize' => $leaders->perPage(),
            'totalPages' => $leaders->lastPage(),
            'count' => $leaders->total(),
            'actions' => auth()->check() ? [
                'create' => [
                    'url' => route('leaders.create'),
                    'label' => 'Create Leader',
                    'variant' => 'primary',
                ],
            ] : [],
        ]);
    }

    public function show(string $id): Response
    {
        $leader = Leader::with('civilization')->findOrFail($id);

        return Inertia::render('Leaders/Show', [
            'leader' => LeaderData::from($leader),
            'actions' => auth()->check() ? [
                'edit' => [
                    'url' => route('leaders.edit', $id),
                    'label' => 'Edit',
                    'variant' => 'primary',
                ],
                'delete' => [
                    'url' =>  route('leaders.delete', $id),
                    'label' => 'Delete',
                    'variant' => 'danger',
                ],
            ] : [],
        ]);
    }

    public function create(): Response
    {
        $civilizations = Civilization::all();

        return Inertia::render('Leaders/Create', [
            'leader' => new LeaderData(
                id: 0,
                civilizationId: null,
                name: '',
                subtitle: '',
                lived: '',
                icon: '',
                trait: ['name' => '', 'effect' => ''],
                titles: [],
                historicalInfo: [],
            ),
            'civilizations' => $civilizations,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'civilizationId' => 'nullable|exists:civilizations,id',
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'lived' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'trait' => 'required|array',
            'trait.name' => 'required|string|max:255',
            'trait.effect' => 'required|string',
            'titles' => 'required|array',
            'historicalInfo' => 'required|array',
        ]);

        $data = LeaderData::from([
            'id' => 0,
            'civilization_id' => $validated['civilizationId'],
            'name' => $validated['name'],
            'subtitle' => $validated['subtitle'],
            'lived' => $validated['lived'],
            'icon' => $validated['icon'],
            'trait' => $validated['trait'],
            'titles' => $validated['titles'],
            'historical_info' => $validated['historicalInfo'],
        ]);

        $leader = Leader::create($data->toDatabase());

        return Redirect::route('leaders.show', $leader->id)
            ->with('success', 'Leader created successfully.');
    }

    public function edit(string $id): Response
    {
        $leader = Leader::with('civilization')->findOrFail($id);
        $civilizations = Civilization::all();

        return Inertia::render('Leaders/Edit', [
            'leader' => LeaderData::from($leader),
            'civilizations' => $civilizations,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $leader = Leader::findOrFail($id);

        $validated = $request->validate([
            'civilizationId' => 'nullable|exists:civilizations,id',
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'lived' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'trait' => 'required|array',
            'trait.name' => 'required|string|max:255',
            'trait.effect' => 'required|string',
            'titles' => 'required|array',
            'historicalInfo' => 'required|array',
        ]);

        $data = LeaderData::from([
            'id' => $leader->id,
            'civilization_id' => $validated['civilizationId'],
            'name' => $validated['name'],
            'subtitle' => $validated['subtitle'],
            'lived' => $validated['lived'],
            'icon' => $validated['icon'],
            'trait' => $validated['trait'],
            'titles' => $validated['titles'],
            'historical_info' => $validated['historicalInfo'],
        ]);

        $leader->update($data->toDatabase());

        return Redirect::route('leaders.show', $leader->id)
            ->with('success', 'Leader updated successfully.');
    }

    public function delete(string $id)
    {
        $leader = Leader::findOrFail($id);
        $leader->delete();

        return Redirect::route('leaders.index')
            ->with('success', 'Leader deleted successfully.');
    }
}

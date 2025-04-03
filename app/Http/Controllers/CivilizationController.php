<?php

namespace App\Http\Controllers;

use App\Data\CivilizationData;
use App\Models\Civilization;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class CivilizationController extends Controller
{
    public function index(Request $request): Response
    {
        $page = intval($request->get('page', 1) ?: 1);
        $search = $request->query('search');
        $pageSize = $request->query('pageSize', '12');
        $sort = $request->query('sort', 'name,asc');
        $filters = $request->query('filters', '');
        [$column, $direction] = explode(',', $sort);

        $civilizations = Civilization::query()
            ->with('leader') // Add this line to eager load the leader relationship
            ->when($search, fn ($query) => $query
                ->where('name', 'like', "%$search%")) // Also fixed the search fields
            ->when($filters, fn ($query) => $query->where(fn ($query) => collect(explode(',', $filters))
                ->map(fn ($filter) => explode('=', $filter))
                ->each(fn ($filter) => $query->where($filter[0], 'like', "%$filter[1]%")))
            )
            ->orderBy($column, $direction)
            ->paginate($pageSize, ['*'], 'civilizations', $page);

        return Inertia::render('Civilizations/Index', [
            'civilizations' => CivilizationData::collect($civilizations)->values(),
            'page' => $civilizations->currentPage(),
            'pageSize' => $civilizations->perPage(),
            'totalPages' => $civilizations->lastPage(),
            'count' => $civilizations->total(),
            'actions' => auth()->check() ? [
                'create' => [
                    'url' => route('civilizations.create'),
                    'label' => 'Create Civilization',
                    'variant' => 'primary',
                ],
            ] : [],
        ]);
    }

    public function show(string $id): Response
    {
        $civilization = Civilization::with('leader')->findOrFail($id);

        return Inertia::render('Civilizations/Show', [
            'civilization' => CivilizationData::from($civilization),
            'actions' => auth()->check() ? [
                'edit' => [
                    'url' => route('civilizations.edit', $id),
                    'label' => 'Edit',
                    'variant' => 'primary',
                ],
                'delete' => [
                    'url' =>  route('civilizations.delete', $id),
                    'label' => 'Delete',
                    'variant' => 'danger',
                ],
            ] : [],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Civilizations/Create', [
            'civilization' => new CivilizationData(
                id: 0,
                name: '',
                icon: '',
                dawnOfMan: '',
                historicalInfo: [],
                leader: null
            ),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'dawnOfMan' => 'required|string',
            'historicalInfo' => 'required|array',
        ]);

        $data = CivilizationData::from([
            'id' => 0,
            'name' => $validated['name'],
            'icon' => $validated['icon'],
            'dawn_of_man' => $validated['dawnOfMan'],
            'historical_info' => $validated['historicalInfo'],
        ]);

        $civilization = Civilization::create($data->toDatabase());

        return Redirect::route('civilizations.show', $civilization->id)
            ->with('success', 'Civilization created successfully.');
    }

    public function edit(string $id): Response
    {
        $civilization = Civilization::findOrFail($id);

        return Inertia::render('Civilizations/Edit', [
            'civilization' => CivilizationData::from($civilization),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $civilization = Civilization::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'dawnOfMan' => 'required|string',
            'historicalInfo' => 'required|array',
        ]);

        $data = CivilizationData::from([
            'id' => $civilization->id,
            'name' => $validated['name'],
            'icon' => $validated['icon'],
            'dawn_of_man' => $validated['dawnOfMan'],
            'historical_info' => $validated['historicalInfo'],
        ]);

        $civilization->update($data->toDatabase());

        return Redirect::route('civilizations.show', $civilization->id)
            ->with('success', 'Civilization updated successfully.');
    }

    public function delete(string $id)
    {
        $civilization = Civilization::findOrFail($id);
        $civilization->delete();

        return Redirect::route('civilizations.index')
            ->with('success', 'Civilization deleted successfully.');
    }
}

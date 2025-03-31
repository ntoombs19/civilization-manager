<?php

namespace App\Http\Controllers;

use App\Data\CivilizationData;
use App\Models\Civilization;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

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
        ]);
    }

    public function show(int $id): Response
    {
        $civilization = Civilization::with('leader')->findOrFail($id);

        return Inertia::render('Civilizations/Show', [
            'civilization' => CivilizationData::from($civilization),
        ]);
    }
}

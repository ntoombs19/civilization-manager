<?php

namespace App\Http\Controllers;

use App\Data\LeaderData;
use App\Models\Leader;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

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
        ]);
    }

    public function show(int $id): Response
    {
        $leader = Leader::with('civilization')->findOrFail($id);

        return Inertia::render('Leaders/Show', [
            'leader' => LeaderData::from($leader),
        ]);
    }
}

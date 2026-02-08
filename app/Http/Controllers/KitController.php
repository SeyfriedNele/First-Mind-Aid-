<?php 
namespace App\Http\Controllers;

use App\Models\Kit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KitController extends Controller
{
    public function index()
    {
        return view('kit.index', [
            'kits' => Kit::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function show(Kit $kit)
    {
        return view('kit.show', [
            'kit' => $kit
        ]);
    }   


   public function create()
    {
        return view('kit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'post' => 'nullable|string|max:1000'
        ]);

        $validated['created_by'] = Auth::id();

        Kit::create($validated);
        return redirect()->route('kit.index')->with('success', 'Kit created successfully.');
    }

    public function edit(Kit $kit)
    {
        return view('kit.edit', [
            'kit' => $kit
        ]);
    }

    public function update(Request $request, Kit $kit)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'post' => 'nullable|string|max:1000'
        ]);

        $validated['created_by'] = Auth::id();

        $kit->update($validated);

        return redirect()->route('kit.index')->with('success', 'Kit updated successfully.');
    }

    public function destroy(Kit $kit)
    {
        $kit ->delete();

        return redirect()->route('kit.index')->with('success', 'Kit deleted successfully.');
    }
}

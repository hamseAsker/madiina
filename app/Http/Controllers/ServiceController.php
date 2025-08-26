<?php 

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // ✅ Show all services
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('services.create');
    }

    // ✅ Store new service
    public function store(Request $request)
    {
        Service::create($request->all());
        return redirect()->route('services.index');
    }

    // ✅ Show single service
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // ✅ Show edit form
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    // ✅ Update service
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return redirect()->route('services.index');
    }

    // ✅ Delete service
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index');
    }
}

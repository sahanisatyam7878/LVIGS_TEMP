<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        return view('admin.products.index', [
            'products' => Product::latest()->get(),
        ]);
    }

    public function create(Request $request): View|RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        return view('admin.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:80'],
            'price' => ['required', 'numeric', 'min:0'],
            'tag' => ['nullable', 'string', 'max:40'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['required', 'string', 'max:500'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Clothing product added successfully.');
    }

    public function edit(Request $request, Product $product): View|RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:80'],
            'price' => ['required', 'numeric', 'min:0'],
            'tag' => ['nullable', 'string', 'max:40'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['required', 'string', 'max:500'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Clothing product updated successfully.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Clothing product deleted successfully.');
    }

    private function isAdmin(Request $request): bool
    {
        return (bool) $request->session()->get('admin_logged_in');
    }
}

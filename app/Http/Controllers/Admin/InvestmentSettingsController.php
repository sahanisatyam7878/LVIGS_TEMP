<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\InvestmentSettingsStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvestmentSettingsController extends Controller
{
    public function edit(Request $request): View|RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        return view('admin.investment-settings.edit', [
            'settings' => InvestmentSettingsStore::get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:160'],
            'hero_text' => ['required', 'string', 'max:500'],
            'gallery_title' => ['required', 'string', 'max:160'],
            'gallery_text' => ['required', 'string', 'max:500'],
            'membership_title' => ['required', 'string', 'max:160'],
            'membership_text' => ['required', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        unset($data['image']);

        if ($request->hasFile('image')) {
            $current = InvestmentSettingsStore::get();

            if ($current['image_path']) {
                Storage::disk('public')->delete($current['image_path']);
            }

            $data['image_path'] = $request->file('image')->store('investment', 'public');
        }

        InvestmentSettingsStore::save($data);

        return redirect()
            ->route('admin.investment.edit')
            ->with('success', 'Investment details updated successfully.');
    }

    public function destroyImage(Request $request): RedirectResponse
    {
        if (! $this->isAdmin($request)) {
            return redirect()->route('admin.login');
        }

        $settings = InvestmentSettingsStore::get();

        if ($settings['image_path']) {
            Storage::disk('public')->delete($settings['image_path']);
            InvestmentSettingsStore::save(['image_path' => null]);
        }

        return redirect()
            ->route('admin.investment.edit')
            ->with('success', 'Investment image deleted successfully.');
    }

    private function isAdmin(Request $request): bool
    {
        return (bool) $request->session()->get('admin_logged_in');
    }
}

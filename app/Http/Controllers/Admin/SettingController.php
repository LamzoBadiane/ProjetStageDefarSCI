<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'platform_name' => Setting::get('platform_name'),
            'support_email' => Setting::get('support_email'),
            'company_auto_delete_delay' => Setting::get('company_auto_delete_delay', 2),
            'max_offers_display' => Setting::get('max_offers_display', 10),
            'max_applications_display' => Setting::get('max_applications_display', 10),
            'registration_students_enabled' => Setting::get('registration_students_enabled', 'yes'),
            'registration_companies_enabled' => Setting::get('registration_companies_enabled', 'yes'),
            'registration_admins_enabled' => Setting::get('registration_admins_enabled', 'yes'),

        ];
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $request)
    {
        $data = $request->only([
            'platform_name',
            'support_email',
            'company_auto_delete_delay',
            'max_offers_display',
            'max_applications_display',
            'registration_companies_enabled',
            'registration_students_enabled',
            'registration_admins_enabled',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Paramètres mis à jour');
    }
}

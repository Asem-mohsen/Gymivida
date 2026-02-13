<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    /**
     * Switch locale
     */
    public function switch(Request $request)
    {
        $locale = $request->input('locale');
        $supportedLocales = ['en', 'ar'];

        if (!in_array($locale, $supportedLocales)) {
            return redirect()->back()->with('error', 'Invalid locale');
        }

        Session::put('locale', $locale);

        // Get the current path without locale prefix (e.g. "en" -> "", "en/privacy" -> "privacy")
        $currentPath = $request->input('current_path', '');
        $currentPath = preg_replace('/^(en|ar)(\/|$)/', '', $currentPath);
        $currentPath = trim($currentPath, '/');

        $targetPath = $currentPath === '' ? '/' . $locale : '/' . $locale . '/' . $currentPath;

        return redirect($targetPath);
    }
}

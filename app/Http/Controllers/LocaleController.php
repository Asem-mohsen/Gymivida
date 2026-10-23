<?php



namespace App\Http\Controllers;

use App\Enums\AppLocale;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');

        if (! is_string($locale) || ! AppLocale::isSupported($locale)) {
            return redirect()->back()->with('error', 'Invalid locale');
        }

        $locale = AppLocale::normalize($locale)->value;

        session()->put('locale', $locale);

        $currentPath = $request->input('current_path', '');
        $currentPath = preg_replace('/^(en|ar)(\/|$)/', '', (string) $currentPath);
        $currentPath = trim((string) $currentPath, '/');

        $targetPath = $currentPath === '' ? '/'.$locale : '/'.$locale.'/'.$currentPath;

        return redirect($targetPath);
    }
}

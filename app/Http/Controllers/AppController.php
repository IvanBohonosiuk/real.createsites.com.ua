<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class AppController extends Controller
{
    public function language(Request $request)
    {

        $locale = $request->input('lang');

        if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
            \Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
        }

        return redirect()->back();                              # Редиректим его <s>взад</s> на ту же страницу

    }
}

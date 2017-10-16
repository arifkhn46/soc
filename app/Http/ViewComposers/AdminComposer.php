<?php


namespace App\Http\ViewComposers;


class AdminComposer {


    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose($view)
    {
        view()->composer('layouts.app', function ($view) {
            if(auth()->check()){
                $view->with('isAdmin', auth()->user()->isAdmin());
            }    
        });
    }


}
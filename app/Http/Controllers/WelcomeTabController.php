<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Welcome\WelcomeTab as Tab;
use \App\Welcome\WelcomeSection as Section;


class WelcomeTabController extends WelcomeController
{
    public function store()
    {
        //check if logged in
        WelcomeHelper::auth();

        //validate
        // TODO:

        //saving tab
        $tab = new Tab;
        $tab->title = request('tab_title');
        $tab->latin_id = request('tab_latin_id');
        $tab->save();

        //creating layout
        WelcomeHelper::make_layout($tab->id,'Tab');

        //saving sections
        $types = request('type');
        $titles = request('title');
        foreach ($types as $key => $value) {
            $section = new Section;
            $section->tab_id = $tab->id;
            $section->title = $titles[$key];
            $section->type = $types[$key];
            $section->type = $types[$key];
            $section->save();
        }

        WelcomeHelper::flash();
        return redirect('welcome_panel');
    }

    public function update($id)
    {
        //find
        $tab = Tab::find($id);
        $sections = $tab->sections;

        //update tab
        $tab->title = request('tab_title');
        $tab->latin_id = request('tab_latin_id');
        $tab->save();

        //add new sections or edit previus sections
        $types = request('type');
        $titles = request('title');
        $cols = request('cols');
        foreach ($sections as $i => $section) {
            $section->title = $titles[$i];
            $section->type = $types[$i];
            $section->save();
        }
        for ($i=count($sections); $i < count($types); $i++) {
            $section = new Section;
            $section->tab_id = $tab->id;
            $section->title = $titles[$i];
            $section->type = $types[$i];
            $section->cols = $cols[$i];
            $section->save();
        }

        WelcomeHelper::flash();
        return back();
    }
}

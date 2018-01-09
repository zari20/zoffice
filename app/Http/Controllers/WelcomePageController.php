<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomePageController extends WelcomeController
{
    public function load($partial)
    {
        switch ($partial) {
            case 'welcome_colors':
                $colors = \App\Welcome\WelcomeColors::find(1) ?? new \App\Welcome\WelcomeColors;
                return view('home',compact('partial','colors'));
                break;
            case 'welcome_header':
                $header = \App\Welcome\WelcomeHeader::find(1);
                $top_links = \App\Welcome\WelcomeTopLink::orderBy('number')->get();
                if(!count($top_links)) $top_links = array(new \App\Welcome\WelcomeTopLink);
                return view('home',compact('partial','header','top_links'));
                break;
            case 'welcome_logo':
                $welcome_logo = \App\Welcome\WelcomeLogo::find(1);
                return view('home',compact('partial','welcome_logo'));
                break;
            case 'welcome_menu':
                $menus = \App\Welcome\WelcomeMenu::all();
                if(!count($menus)) $menus = array(new \App\Welcome\WelcomeMenu);
                return view('home',compact('partial','menus'));
                break;
            case 'welcome_cols':
                $cols = \App\Welcome\WelcomeCol::all();
                if(!count($cols)) $cols = array(new \App\Welcome\WelcomeCol);
                return view('home',compact('partial','cols'));
                break;
            case 'welcome_sliders':
                $sliders = \App\Welcome\WelcomeSlider::all();
                if(!count($sliders)) $sliders = array(new \App\Welcome\WelcomeSlider);
                return view('home',compact('partial','sliders'));
                break;
            case 'welcome_introduce_tabs':
                $tabs = \App\Welcome\WelcomeIntroduceTab::all();
                $blogs = \App\Welcome\WelcomeIntroduceBlog::all();
                if(!count($tabs)) $tabs = array(new \App\Welcome\WelcomeIntroduceTab);
                if(!count($blogs)) $blogs = array(new \App\Welcome\WelcomeIntroduceBlog);
                return view('home',compact('partial','tabs','blogs'));
                break;
            case 'welcome_team_members':
                $team_members = \App\Welcome\WelcomeOurTeam::all();
                if(!count($team_members)) $team_members = array(new \App\Welcome\WelcomeOurTeam);
                return view('home',compact('partial','team_members'));
                break;
            case 'welcome_our_services':
                $services = \App\Welcome\WelcomeOurService::all();
                if(!count($services)) $services = array(new \App\Welcome\WelcomeOurService);
                return view('home',compact('partial','services'));
                break;
            case 'welcome_our_projects':
                $projects = \App\Welcome\WelcomeOurProject::all();
                if(!count($projects)) $projects = array(new \App\Welcome\WelcomeOurProject);
                return view('home',compact('partial','projects'));
                break;
            case 'welcome_our_departments':
                $departments = \App\Welcome\WelcomeOurDepartment::all();
                if(!count($departments)) $departments = array(new \App\Welcome\WelcomeOurDepartment);
                return view('home',compact('partial','departments'));
                break;
            case 'welcome_our_views':
                $views = \App\Welcome\WelcomeOurView::all();
                if(!count($views)) $views = array(new \App\Welcome\WelcomeOurView);
                return view('home',compact('partial','views'));
                break;
            case 'welcome_our_branches':
                $branches = \App\Welcome\WelcomeOurBranch::all();
                if(!count($branches)) $branches = array(new \App\Welcome\WelcomeOurBranch);
                return view('home',compact('partial','branches'));
                break;
            case 'welcome_main_branch':
                $main_branch = \App\Welcome\WelcomeMainBranch::find(1);
                if(!$main_branch) $main_branch = new \App\Welcome\WelcomeMainBranch;
                return view('home',compact('partial','main_branch'));
                break;
            case 'welcome_contact_branches':
                $branches = \App\Welcome\WelcomeContactBranch::all();
                if(!count($branches)) $branches = array(new \App\Welcome\WelcomeContactBranch);
                return view('home',compact('partial','branches'));
                break;
            case 'welcome_catalogs':
                $catalogs = \App\Welcome\WelcomeCatalog::all();
                if(!count($catalogs)) $catalogs = array(new \App\Welcome\WelcomeCatalog);
                return view('home',compact('partial','catalogs'));
                break;
            case 'welcome_videos':
                $videos = \App\Welcome\WelcomeVideo::all();
                if(!count($videos)) $videos = array(new \App\Welcome\WelcomeVideo);
                return view('home',compact('partial','videos'));
                break;
            case 'welcome_products':
                $products = \App\Welcome\WelcomeProduct::all();
                if(!count($products)) $products = array(new \App\Welcome\WelcomeProduct);
                return view('home',compact('partial','products'));
                break;
            case 'welcome_links':
                $links = \App\Welcome\WelcomeLink::all();
                if(!count($links)) $links = array(new \App\Welcome\WelcomeLink);
                return view('home',compact('partial','links'));
                break;
            case 'welcome_footer':
                $footer = \App\Welcome\WelcomeFooter::find(1);
                $links = (isset($footer->links) && count($footer->links)) ? $footer->links : array(new \App\Welcome\WelcomeFooterLink);
                return view('home',compact('partial','footer','links'));
                break;
            default:
                return view('home',compact('partial'));
                break;
        }
    }

    public function index()
    {
        $colors = \App\Welcome\WelcomeColors::find(1);
        $header = \App\Welcome\WelcomeHeader::find(1);
        $welcome_logo = \App\Welcome\WelcomeLogo::find(1);
        $top_links = \App\Welcome\WelcomeTopLink::orderBy('number')->get();
        $menus = \App\Welcome\WelcomeMenu::all();
        $five_cols = \App\Welcome\WelcomeFiveCol::all();
        $sliders = \App\Welcome\WelcomeSlider::all();
        $main_branch = \App\Welcome\WelcomeMainBranch::find(1);
        $contact_branches = \App\Welcome\WelcomeContactBranch::all();
        $latest_products = \App\Welcome\WelcomeProduct::latest()->get();
        $links = \App\Welcome\WelcomeLink::all();
        $footer = \App\Welcome\WelcomeFooter::find(1);
        return view('welcome',compact(
            'colors', 'header', 'welcome_logo', 'top_links', 'menus', 'five_cols', 'sliders',
            'main_branch', 'contact_branches', 'latest_products', 'links', 'footer'
        ));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Client;
use App\Models\Admin\OurAchieve;
use App\Models\Admin\OurAchieveItem;
use App\Models\Admin\OurService;
use App\Models\Admin\privacyPolicy;
use App\Models\Admin\TermsAndCondition;
use App\Models\Admin\Testimonial;
use App\Models\Admin\WhyChooseUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (METHOD)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['banner'] = Banner::first();
        $data['achive'] = OurAchieve::first();
        $data['achiveItems'] = OurAchieveItem::get();
        $data['ourServices'] = OurService::get();
        $data['testimonials'] = Testimonial::get();
        $data['whyChooseUsItems'] = WhyChooseUs::get();
        $data['ourClients'] = Client::get();
        return view('frontend.pages.home-page.index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    |  TERMS AND CONDITION (METHOD)
    |--------------------------------------------------------------------------
    */
    public function termsCondition()
    {
        $data['termsAndCondition'] = TermsAndCondition::first();
        return view('frontend.pages.terms-and-condition.index', $data);
    }
    /*
    |--------------------------------------------------------------------------
    |  PRIVACY POLICY (METHOD)
    |--------------------------------------------------------------------------
    */
    public function privacyPolicy()
    {
        $data['privacyPolicy'] = privacyPolicy::first();
        return view('frontend.pages.privacy-policy.index', $data);
    }
}

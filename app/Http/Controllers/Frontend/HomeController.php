<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Category;
use App\Models\Admin\Client;
use App\Models\Admin\OurAchieve;
use App\Models\Admin\OurAchieveItem;
use App\Models\Admin\OurService;
use App\Models\Admin\OurTeam;
use App\Models\Admin\privacyPolicy;
use App\Models\Admin\Product;
use App\Models\Admin\TermsAndCondition;
use App\Models\Admin\Testimonial;
use App\Models\Admin\WhyChooseUs;
use App\Models\CustomerQuery;
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
    /*
    |--------------------------------------------------------------------------
    |  OUR TEAM (METHOD)
    |--------------------------------------------------------------------------
    */
    public function ourTeam()
    {
        $data['developerTeams'] = OurTeam::where('field', 'development')->get();
        $data['salesTeams'] = OurTeam::where('field', 'sales')->get();
        return view('frontend.pages.our-team.index', $data);
    }
    /*
    |--------------------------------------------------------------------------
    |  PRODUCT FOR MENU (METHOD)
    |--------------------------------------------------------------------------
    */
    public function singleProduct($slug)
    {
        $data['singleProduct'] = Product::where('slug', $slug)->with('feature')->first();
        // return json_decode($data['singleProduct']);
        return view('frontend.pages.single-product.index', $data);
    }
    /*
    |--------------------------------------------------------------------------
    |  PRODUCT FOR MENU (METHOD)
    |--------------------------------------------------------------------------
    */
    public function singleService($slug)
    {
        $data['singleService'] = Category::where('slug', $slug)->first();
        return view('frontend.pages.single-services.index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    |  CONTACT PAGE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function contactPage()
    {
        return view('frontend.pages.contact.index');
    }
    /*
    |--------------------------------------------------------------------------
    |  CONTACT PAGE STORE (METHOD)
    |--------------------------------------------------------------------------
    */
    public function contactPageStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
        ]);

        CustomerQuery::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'subject'   => $request->message,
        ]);
        // Alert::success('Success!', 'Submit Message');


        return redirect()->back();
    }




}

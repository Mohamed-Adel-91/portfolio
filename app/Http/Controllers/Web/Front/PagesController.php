<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{

    public function index()
    {

        $sliders = Sliders::where('pageName', 'Home')
            ->where('sectionName', 'Home-first-banner')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $ourHistory = Sliders::where('pageName', 'Home')
            ->where('sectionName', 'homeOurHistory')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $ourFleet = Sliders::where('pageName', 'Home')
            ->where('sectionName', 'homeOurFleet')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $services = Sliders::where('pageName', 'Home')
            ->where('sectionName', 'homeServices')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $helpCenter = Sliders::where('pageName', 'Home')
            ->where('sectionName', 'homeHelpCenter')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.index')->with([
            'pageName' => 'Air Master | Home',
            'sliders' => $sliders,
            'ourHistory' => $ourHistory,
            'ourFleet' => $ourFleet,
            'services' => $services,
            'helpCenter' => $helpCenter,
        ]);
    }

    public function contactUs()
    {
        $slider = Sliders::where('pageName', 'Contact-Us')
            ->where('sectionName', 'Contact-Us-start-banner')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();
        $helpCenter = Sliders::where('pageName', 'Contact-Us')
            ->where('sectionName', 'Contact-Us-Help-Center')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();
        $lastSection = Sliders::where('pageName', 'Contact-Us')
            ->where('sectionName', 'Contact-Us-Last-Section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.contact-us')->with([
            'pageName' => 'Air Master | Contact Us',
            'slider' => $slider,
            'helpCenter' => $helpCenter,
            'lastSection' => $lastSection,
        ]);
    }

    public function submitContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $contactRequest = ContactRequest::create($validator->validated());

        return response()->json([
            'status' => true,
            'errors' => [],
            'contactRequest' => $contactRequest,
        ]);
    }

    public function about()
    {

        $slider = Sliders::where('pageName', 'about-us')
            ->where('sectionName', 'about-us-first-banner')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $ourHistory = Sliders::where('pageName', 'about-us')
            ->where('sectionName', 'about-us-ourHistory')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $ourServices = Sliders::where('pageName', 'about-us')
            ->where('sectionName', 'about-us-ourServices')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $ourDna = Sliders::where('pageName', 'about-us')
            ->where('sectionName', 'about-us-ourDna')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $teams = Sliders::where('pageName', 'about-us')
            ->where('sectionName', 'about-us-teams')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $joinUs = Sliders::where('pageName', 'about-us')
            ->where('sectionName', 'about-us-joinUs')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.about')->with([
            'pageName' => 'Air Master | About',
            'slider' => $slider,
            'ourHistory' => $ourHistory,
            'ourServices' => $ourServices,
            'ourDna' => $ourDna,
            'teams' => $teams,
            'joinUs' => $joinUs,
        ]);
    }

    public function ourFleet()
    {
        $slider = Sliders::where('pageName', 'our-Fleet')
            ->where('sectionName', 'our-Fleet-first-banner')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $sectionTwo = Sliders::where('pageName', 'our-Fleet')
            ->where('sectionName', 'our-Fleet-second-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $ourServices = Sliders::where('pageName', 'our-Fleet')
            ->where('sectionName', 'our-Fleet-ourServices')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $transparency = Sliders::where('pageName', 'our-Fleet')
            ->where('sectionName', 'our-Fleet-Transparency')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.ourFleet')->with([
            'pageName' => 'Air Master | Our Fleet',
            'slider' => $slider,
            'sectionTwo' => $sectionTwo,
            'ourServices' => $ourServices,
            'transparency' => $transparency,
        ]);
    }

    public function whatsNew()
    {

        $slider = Sliders::where('pageName', 'Whats-New')
            ->where('sectionName', 'Whats-New-Start-Section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $secondSection = Sliders::where('pageName', 'Whats-New')
            ->where('sectionName', 'Whats-New-Second-Section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();
        $lastSection = Sliders::where('pageName', 'Whats-New')
            ->where('sectionName', 'Whats-New-Last-Section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.whatsNew')->with([
            'pageName' => 'Air Master | What\'s New',
            'slider' => $slider,
            'secondSection' => $secondSection,
            'lastSection' => $lastSection,
        ]);
    }

    public function careers()
    {

        $startBanner = Sliders::where('pageName', 'Careers')
            ->where('sectionName', 'Careers-Start-Banner')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $secondSection = Sliders::where('pageName', 'Careers')
            ->where('sectionName', 'Careers-second-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $lastSection = Sliders::where('pageName', 'Careers')
            ->where('sectionName', 'Careers-last-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.careers')->with([
            'pageName' => 'Air Master | Careers',
            'startBanner' => $startBanner,
            'secondSection' => $secondSection,
            'lastSection' => $lastSection,
        ]);
    }

    public function services()
    {
        $startSection = Sliders::where('pageName', 'Services')
            ->where('sectionName', 'Services-start-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $cardSection = Sliders::where('pageName', 'Services')
            ->where('sectionName', 'Services-card-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.services')->with([
            'pageName' => 'Air Master | Services',
            'startSection' => $startSection,
            'cardSection' => $cardSection,
        ]);
    }

    public function faq()
    {

        $startSection = Sliders::where('pageName', 'FAQs')
            ->where('sectionName', 'FAQs-start-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.faq')->with([
            'pageName' => 'Air Master | FAQs',
            'startSection' => $startSection,
        ]);
    }

    public function helpCenter()
    {
        $startSection = Sliders::where('pageName', 'Help-Center')
            ->where('sectionName', 'Help-Center-start-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $cardSection = Sliders::where('pageName', 'Help-Center')
            ->where('sectionName', 'Help-Center-card-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $lastSection = Sliders::where('pageName', 'Contact-Us')
            ->where('sectionName', 'Contact-Us-Last-Section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.helpCenter')->with([
            'pageName' => 'Air Master | help Center',
            'startSection' => $startSection,
            'cardSection' => $cardSection,
            'lastSection' => $lastSection,
        ]);
    }

    public function terms()
    {

        $startSection = Sliders::where('pageName', 'Terms')
            ->where('sectionName', 'Terms-start-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $cardSection = Sliders::where('pageName', 'Terms')
            ->where('sectionName', 'Terms-card-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        $contactSection = Sliders::where('pageName', 'Terms')
            ->where('sectionName', 'Terms-contact-section')
            ->where('show_status', 'Active')
            ->orderBy('slider_no')
            ->get();

        return view('web.terms')->with([
            'pageName' => 'Air Master | Terms',
            'startSection' => $startSection,
            'cardSection' => $cardSection,
            'contactSection' => $contactSection,
        ]);
    }

}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AdvocateRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\URL;
class AdvocateRegistrationController extends BaseController
{
    public function index(Request $request)
    {
        $this->setPageTitle('Advocate Registration', 'Advocate Registration');
        return view('site.advocate.registration.index');
    }
    public function store(Request $request)
    {
       // dd($request->all());
       $this->validate($request, [
            'name'      =>  'required|string|max:20',
            'email' => 'required|email',
            'postcode' => 'required|digits:4',
            'suburb' => 'required|string',
            'platform' => 'required',
        ]);
        $business = new AdvocateRegistration();
        $business->name = $request->name;
        $business->email = $request->email;
        $business->postcode = $request->postcode;
        $business->suburb = $request->suburb;
        $business->platform = $request->platform;
        $business->mail_status	 = 1;
        $saved = $business->save();
        if ($saved) {
        $to = $request->email;

        $subject = "Thank You for Registered!";

        $content = "<p>Hello, greetings from Local Tales!<br>
        <br>
        We’re a brand-new site aimed at bringing the community together and <br>we’re looking for local people to promote our business and join us in this venture.
        <br>
        </p>

        <p>It’s a fantastic opportunity to be one of our Local Tales advocates.<br> You’ll be the advocate of your suburb <br>and increase our brand awareness in the area.<br> By being an advocate you’ll see lots of benefits as a local champion.
        </p>

        <p>There’s a whole host of ways to assist us; <br>this could include anything from <br>leaflet drops to business sponsorship, getting new members onboard, <br>hosting local events, charity events etc.
        </p>

        <p>We are looking for one advocate per suburb, <br>if you’d like to hear more about this opportunity follow the registration link Here (Embed Link), <br>as we’re looking to fill the position in the near future. <br>However, if you have any questions, do let us know.
        </p>

        <p>Have a great day!
        </p>";
        $link = '<a href="'.URL::to('/').'/'.'advocate/registration/'.'">REGISTER HERE</a>';
        $body = str_replace("(Embed Link)", $link, $content);
        $message = $body;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $message, $headers);
        return redirect()->route('products.create.step.three');

    }
       else{
            return $this->responseRedirectBack('Error occurred while registration.', 'error', true, true);
        }

        //return redirect()->route('products.create.step.three');

    }
}

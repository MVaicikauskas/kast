<?php

namespace app\Http\Controllers\Page;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

// General models
use app\Models\General\PageSettings;
use app\Models\General\Banner;
use app\Models\General\Partner;

use app\Models\Events\Event;
use app\Models\Events\EventRegion;
use app\Models\Events\EventCategory;

//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.events.event-form_new')->with([
            //'events' => Event::all()->where('confirmed', 1),
            'categories' => EventCategory::where('id', '!=', 15)->orderBy('name', 'asc')->get(),
            'regions' => EventRegion::all(),
            'heading' => 'Įkelk renginį'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:255',
            'region_id' => 'required',
            'category_id' => 'required',
	        'date' => 'required|date',
	        'start_time' => 'required',
			'user_email' => 'required|email',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'location' => 'nullable|string|min:3|max:255',
            'website' => 'nullable|string|min:3|max:255',
            'ticket_link' => 'nullable|string|min:3|max:255',
            'facebook_link' => 'nullable|string|min:3|max:255',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $event = new Event;

        $event->title = $request->title;
	    $event->slug = Str::slug($request->title) . "-" . Str::slug($request->date);
        $event->category_id = $request->category_id;
        $event->region_id = $request->region_id;
        $event->excerpt = $request->excerpt;
        $event->description = $request->description;
        $event->is_free = $request->is_free === 'yes' ? true : false;

        if(($request->hasFile('image'))) {
            $name = md5(time()) . '.' . $request->image->getClientOriginalExtension();

            $savePath = 'storage_old/events/';

            if (!File::exists($savePath)) {
              File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

            $event->image = $name;
        }

        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->website = $request->website;
        $event->ticket_link = $request->ticket_link;
        $event->facebook_link = $request->facebook_link;
        $event->confirmed = 0;

        $event->save();

        if ($request->has_alternative_dates === 'yes') {
            foreach ($event->alternativeDate as $altDate) {
              $altDate->delete();
            }
  
            if (!empty($request->alt_date_1) && !empty($request->alt_start_time_1)) {
              $event->alternativeDate()->create([
                'date' => $request->alt_date_1,
                'start_time' => $request->alt_start_time_1,
                'end_time' => $request->alt_end_time_1
              ]);
            }
  
            if (!empty($request->alt_date_2) && !empty($request->alt_start_time_2)) {
              $event->alternativeDate()->create([
                'date' => $request->alt_date_2,
                'start_time' => $request->alt_start_time_2,
                'end_time' => $request->alt_end_time_2
              ]);
            }
  
            if (!empty($request->alt_date_3) && !empty($request->alt_start_time_3)) {
              $event->alternativeDate()->create([
                'date' => $request->alt_date_3,
                'start_time' => $request->alt_start_time_3,
                'end_time' => $request->alt_end_time_3
              ]);
            }
          }

        return redirect()->route('user.add-event')->with('alert-success', 'Renginį turime patikrinti, todėl renginio atsiradimo kalendoriuje procesas gali užtrukti iki 12 valandų. Klaipėda, aš su tavim pasilieka teisę neskelbti renginio, jei jo informacija neatitinka mūsų sąlygų ir taisyklių. Įkėlimo sąlygos:<br><ul>
<li>•	Informaciją įkeliantis asmuo patvirtina, kad informacija nepažeidžia Lietuvos Respublikos įstatymų, teisės aktų ir kitokių teisinių reglamentacijų; (pvz. nėra melaginga, šmeižianti ir pan.).</li>
<li>•	Klaipėda, aš su tavim neatsako už įdėtos informacijos autorinių teisių pažeidimus.</li>
<li>•	Už autorinių teisių pažeidimus, susijusius su įkelta ir portale Klaipėda, aš su tavim publikuota informacija, atsako asmuo, įkėlęs informaciją.</li>
<li>•	Klaipėda, aš su tavim neatsako, jei renginys neįvyks ar vėluos.</li>
<li>•	Su renginio informacija įkeliama vaizdinė ir garsinė medžiaga yra naudojama su šios medžiagos autorių sutikimu;.</li>
<li>•	Klaipėda, aš su tavim pasilieka teisę koreguoti įkeltą informaciją arba išvis nekelti renginio, jei renginio informacija yra paruošta neprofesionaliai (gramatinės ir stiliaus klaidos tekste; tekstas ne lietuvių kalba; naudojama žemos kokybės vizualinė medžiaga)..</li>
<li>•	Piknaudžiaujant paslauga ir bandant kelti tą patį renginį daugiau nei vieną kartą, jis bus trinamas.</li></ul><hr>');
    }
}

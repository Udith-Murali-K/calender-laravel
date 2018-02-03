<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;

class GoogleController extends Controller
{
    private $client ;
    private $authURL;
    public function  __construct()
    {
        $this->client = new  Google_Client();
        $filePath = base_path("client_secret.json");
        $this->client->setAuthConfig($filePath);
        $this->client->setScopes(array('https://www.googleapis.com/auth/calendar'));
        $this->authURL = $this->client->createAuthUrl();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($token=session()->get('token',''))
            return redirect('callback');
        else
            return view('pages.google')->with('authurl', $this->authURL);

//        return view('pages.google')->with('authurl', $this->authURL);

    }

    public function callback(Request $request){
        $input = $request->all() ;
        $eventsArray =[];
        if( $request->has('code')){
            $this->client->fetchAccessTokenWithAuthCode($input['code']);
            session()->put('token',$this->client->getAccessToken());
            session()->put('code',$input['code']);
        }

        if($token=session()->get('token','')){
            $this->client->setAccessToken($token);
            $service = new \Google_Service_Calendar($this->client);
            $calendarList  = $service->calendarList->listCalendarList();
            while(true) {
                foreach ($calendarList->getItems() as $calendarListEntry) {
                    // get events

                    $events = $service->events->listEvents($calendarListEntry->id);
                    foreach ($events->getItems() as $event) {

                        $individualEvent[$calendarListEntry->getSummary()][]=['summery'=>$event->getSummary(),'id'=>$event->id];
                    }
                    $eventsArray[]=$individualEvent;
                }
                $pageToken = $calendarList->getNextPageToken();
                if ($pageToken) {
                    $optParams = array('pageToken' => $pageToken);
                    $calendarList = $service->calendarList->listCalendarList($optParams);
                } else {
                    break;
                }
            }
        }

        $logut= $this->authURL.'?logout=1';
       
        return view('pages.callback')->with('logout',$logut)->with('events',$eventsArray);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        if($this->client->isAccessTokenExpired()) {
            $this->client->setAccessToken(session()->get('token',''));
        }
        $input=$request->all();
        $service = new \Google_Service_Calendar($this->client);
        $event = new \Google_Service_Calendar_Event(array(
            'summary' => 'Gdvdsvdsv dsddsdsf',
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => 'A chance to hear more about Google\'s developer products.',
            'start' => array(
                'dateTime' => '2018-05-28T09:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ),
            'end' => array(
                'dateTime' => '2018-05-28T17:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ),
            'recurrence' => array(
                'RRULE:FREQ=DAILY;COUNT=2'
            ),
            'attendees' => array(
                array('email' => 'lpage@example.com'),
                array('email' => 'sbrin@example.com'),
            ),
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        ));


        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
        return redirect('/');
//        printf('Event created: %s\n', $event->htmlLink);
        //TODO create payload da ne poyo

//       $res= $service->calendars->insert();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->client->isAccessTokenExpired()) {
            $this->client->setAccessToken(session()->get('token',''));
            // dd($this->client);
        }
        $service = new \Google_Service_Calendar($this->client);
        $service->events->delete('primary', $id);

        return redirect('/');
    }

}

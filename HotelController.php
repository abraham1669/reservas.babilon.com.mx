<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\HotelBeds;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;

class HotelController extends Controller
{
     public function index(Request $request) {

        $hotelbeds = new HotelBeds();
        //$request = $hotelbeds->getHotelApi();
        //$data_test = $request;

        /*for ($i=0; $i < count($data_test->hotels); $i++) {
             $hotel_code                  = (isset($data_test->hotels[$i]->code)) ? $data_test->hotels[$i]->code : null;
             $hotel_name                  = (isset($data_test->hotels[$i]->name->content)) ? $data_test->hotels[$i]->name->content : null;
             $hotel_description           = (isset($data_test->hotels[$i]->description->content)) ? $data_test->hotels[$i]->description->content : null;
             $hotel_countryCode           = (isset($data_test->hotels[$i]->countryCode)) ? $data_test->hotels[$i]->countryCode : null;
             $hotel_stateCode             = (isset($data_test->hotels[$i]->stateCode)) ? $data_test->hotels[$i]->stateCode : null;
             $hotel_destinationCode       = (isset($data_test->hotels[$i]->destinationCode)) ? $data_test->hotels[$i]->destinationCode : null;
             $hotel_zoneCode              = (isset($data_test->hotels[$i]->zoneCode)) ? $data_test->hotels[$i]->zoneCode : null;
             $hotel_coordinates           = (isset($data_test->hotels[$i]->coordinates)) ? json_encode($data_test->hotels[$i]->coordinates) : null;;
             $hotel_categoryCode          = (isset($data_test->hotels[$i]->categoryCode)) ? $data_test->hotels[$i]->categoryCode : null;
             $hotel_categoryGroupCode     = (isset($data_test->hotels[$i]->categoryGroupCode)) ? $data_test->hotels[$i]->categoryGroupCode : null;
             $hotel_chainCode             = (isset($data_test->hotels[$i]->chainCode)) ? $data_test->hotels[$i]->chainCode : null;
             $hotel_accommodationTypeCode = (isset($data_test->hotels[$i]->accommodationTypeCode)) ? $data_test->hotels[$i]->accommodationTypeCode : null;
             $hotel_boardCodes            = (isset($data_test->hotels[$i]->boardCodes)) ? json_encode($data_test->hotels[$i]->boardCodes) : null;;
             $hotel_segmentCodes          = (isset($data_test->hotels[$i]->segmentCodes)) ? json_encode($data_test->hotels[$i]->segmentCodes) : null;;
             $hotel_address               = (isset($data_test->hotels[$i]->address->content)) ? $data_test->hotels[$i]->address->content : null;
             $hotel_postalCode            = (isset($data_test->hotels[$i]->postalCode)) ? $data_test->hotels[$i]->postalCode : null;
             $hotel_city                  = (isset($data_test->hotels[$i]->city->content)) ? $data_test->hotels[$i]->city->content : null;
             $hotel_email                 = (isset($data_test->hotels[$i]->email)) ? $data_test->hotels[$i]->email : null;
             $hotel_license               = (isset($data_test->hotels[$i]->license)) ? $data_test->hotels[$i]->license : null;
             $hotel_phones                = (isset($data_test->hotels[$i]->phones)) ? json_encode($data_test->hotels[$i]->phones) : null;;
             $hotel_rooms                 = (isset($data_test->hotels[$i]->rooms)) ? json_encode($data_test->hotels[$i]->rooms) : null;;
             $hotel_facilities            = (isset($data_test->hotels[$i]->facilities)) ? json_encode($data_test->hotels[$i]->facilities) : null;;
             $hotel_terminals             = (isset($data_test->hotels[$i]->terminals)) ? json_encode($data_test->hotels[$i]->terminals) : null;;
             $hotel_interestPoints        = (isset($data_test->hotels[$i]->interestPoints)) ? json_encode($data_test->hotels[$i]->interestPoints) : null;;
             $hotel_images                = (isset($data_test->hotels[$i]->images)) ? json_encode($data_test->hotels[$i]->images) : null;;
             $hotel_wildcards             = (isset($data_test->hotels[$i]->wildcards)) ? json_encode($data_test->hotels[$i]->wildcards) : null;;
             $hotel_web                   = (isset($data_test->hotels[$i]->web)) ? $data_test->hotels[$i]->web : null;


            DB::table('hb_hotels')->insert([
                'code'                  => $hotel_code,
                'name'                  => $hotel_name,
                'description'           => $hotel_description,
                'countryCode'           => $hotel_countryCode,
                'stateCode'             => $hotel_stateCode,
                'destinationCode'       => $hotel_destinationCode,
                'zoneCode'              => $hotel_zoneCode,
                'coordinates'           => $hotel_coordinates,
                'categoryCode'          => $hotel_categoryCode,
                'categoryGroupCode'     => $hotel_categoryGroupCode,
                'chainCode'             => $hotel_chainCode,
                'accommodationTypeCode' => $hotel_accommodationTypeCode,
                'boardCodes'            => $hotel_boardCodes,
                'segmentCodes'          => $hotel_segmentCodes,
                'address'               => $hotel_address,
                'postalCode'            => $hotel_postalCode,
                'city'                  => $hotel_city,
                'email'                 => $hotel_email,
                'license'               => $hotel_license,
                'phones'                => $hotel_phones,
                'rooms'                 => $hotel_rooms,
                'facilities'            => $hotel_facilities,
                'terminals'             => $hotel_terminals,
                'interestPoints'        => $hotel_interestPoints,
                'images'                => $hotel_images,
                'wildcards'             => $hotel_wildcards,
                'web'                   => $hotel_web,
                'language_id'           => 2,
            ]);
        }

 dd($data_test);*/
       

     	return view('hotels.index');

     }
     public function send(Request $request) {

        $hotel_name = $request->input('hote_input');
        $hotel_id = $request->input('id_hotel');

        $boards = null;

        $from = $request->input('from');
        $to = $request->input('to');
        $rooms = $request->input('rooms_input');
        $data = $request->all();
        $adult = 0;
        $child = 0;

        for ($i=0; $i < $rooms; $i++) {
            $count = $i + 1;
            $adults[$i] = $request->input('habit_adult_' . $count);
            $childs[$i] = $request->input('habit_child_' . $count);
            $adult += $request->input('habit_adult_' . $count);
            $child += $request->input('habit_adult_' . $count);
        }

        $count = 0;
        $i = 0;

        foreach ($childs as $child) {
            $count_child = 0;
            $count = $count + 1;
            for ($i=0; $i < $child; $i++) {
                $count_child = $count_child + 1;
                $child_age['age_' . $count . '_' . $count_child] = $request->input('age_child_' . $count . '_' . $count_child);
            }
            $i++;
        }
        if ($child == 0) {
            $child_age = 0;
        }

        $hotelbeds = new HotelBeds();
        $request = $hotelbeds->getHotels($hotel_name);
        $hotel = $request;

        //availability
        $availability = $hotelbeds->getAvailability($rooms,$adult,$child,$from,$to,$child_age,$hotel_id);
        //dd($availability);
        $hotel_rate = $availability->hotels->hotels[0]->rooms;
       // dd($hotel_rooms);
        //ITEM CODES
        $id_category       = $hotel[0]->categoryCode;
        $id_destination    = $hotel[0]->destinationCode;
        $id_country        = $hotel[0]->countryCode;
        $id_state          = $hotel[0]->stateCode;
        $id_chain          = $hotel[0]->chainCode;
        $id_accommodation  = $hotel[0]->accommodationTypeCode;
        $id_zone           = $hotel[0]->zoneCode;

        //GET DATA FROM DB
        $category            = $hotelbeds->getCategories($id_category);
        $destination         = $hotelbeds->getDestinations($id_destination);
        $country             = $hotelbeds->getCountry($id_country);
        $state               = $hotelbeds->getStates($id_state);
        $chain               = $hotelbeds->getChains($id_chain);
        $accommodation       = $hotelbeds->getAccommodations($id_accommodation);
        //$zone              = $hotelbeds->getZones(); //no se puede porque no manda codigo o no tiene
        $json_boards         = json_decode($hotel[0]->boardCodes);
        $json_segments       = json_decode($hotel[0]->segmentCodes);
        $json_rooms          = json_decode($hotel[0]->rooms);
        $json_images         = json_decode($hotel[0]->images);
        $json_phones         = json_decode($hotel[0]->phones);
        $json_facilities     = json_decode($hotel[0]->facilities);
        $json_interestPoints = json_decode($hotel[0]->interestPoints);
        $json_wildcards      = json_decode($hotel[0]->wildcards);
    
        for ($i=0; $i <count($json_wildcards); $i++) {
            $id_wildcards = $json_wildcards[$i]->roomType;
            $wildcards = $hotelbeds->getrooms($id_wildcards);
            $hotel_wildcards[] = $wildcards;
        }

        for ($i=0; $i <count($json_interestPoints); $i++) {
            $id_interestPoints = $json_interestPoints[$i]->facilityCode;
            $interestPoints = $hotelbeds->getFacilities($id_interestPoints);
            $hotel_interestPoints[] = $interestPoints;
        }

        for ($i=0; $i <count($json_facilities); $i++) {
            $id_facility = $json_facilities[$i]->facilityCode;
            $facility = $hotelbeds->getFacilities($id_facility);
            $hotel_facility[] = $facility;
        }
        //dd($hotel_facility);
        foreach ($json_boards as $id_board){
            $board = $hotelbeds->getBoards($id_board);
            $boards[] = $board;
        }
        //dd($boards);
        foreach ($json_segments as $id_segment){
            $segment = $hotelbeds->getSegments($id_segment);
            $segments[] = $segment;
        }

        for ($i=0; $i <count($json_rooms); $i++) {
            $id_room = $json_rooms[$i]->roomCode;
            $room = $hotelbeds->getrooms($id_room);
            $hotel_rooms[] = $room;

            if (isset($json_rooms[$i]->roomFacilities)) {
                $id_facility = $json_rooms[$i]->roomFacilities[0]->facilityCode;
                $facilities[$id_room][] = $hotelbeds->getFacilities($id_facility);
            }

        }

        for ($i=0; $i <count($json_images); $i++) {
            if (isset($json_images[$i]->roomCode)) {
                $id_room = $json_images[$i]->roomCode;
                $images[$id_room][] = $json_images[$i]->path;
            } else {
                $hotel_images[] = $json_images[$i]->path;
            }
        }

         for ($i=0; $i <count($hotel_rate); $i++) {
            if (isset($hotel_rate[$i]->code)) {
                $id_room = $hotel_rate[$i]->code;
                for ($x=0; $x <count($hotel_rate[$i]->rates); $x++) { 
                    $prices[$id_room][] = $hotel_rate[$i]->rates[$x];

                }
            }
        }
        //dd($hotel_rate);
        /*
            $id_promotion      = $hotel->hotels->hotels[0]->destinationCode;
            $id_facility       = $hotel->hotels->hotels[0]->destinationCode;
            $id_facilitygroup  = $hotel->hotels->hotels[0]->destinationCode;
            $id_imagetype      = $hotel->hotels->hotels[0]->destinationCode;

            $facilitygroup = $hotelbeds->getFacilityGroups($id_facilitygroup);
            $imagetype     = $hotelbeds->getImagetypes($id_imagetype);
            $issue         = $hotelbeds->getIssues($id_issue);
            $promotion     = $hotelbeds->getPromotions($id_promotion);
        */

        return view('hotels.results', [
            // START FORM
            'hotel_name'          => $hotel_name,
            'from'                => $from,
            'to'                  => $to,
            'adults'              => $adults,
            'childs'              => $childs,
            'child_age'           => $child_age,
            'rooms'               => $rooms,
            'data'                => $data,
            // END FORM

            'category'            => $category,
            'hotel_images'        => $hotel_images,
            'destination'         => $destination,
            'country'             => $country,
            'state'               => $state,
            'chain'               => $chain,
            'accommodation'       => $accommodation,
            'segment'             => $segment,
            'boards'              => $boards,
            'segments'            => $segments,
            'facilities'          => $facilities,
            'hotel_rooms'         => $hotel_rooms,
            'hotel_facility'      => $hotel_facility,
            'images'              => $images,
            'images'              => $images,
            'hotel'               => $hotel,
            'json_phones'         => $json_phones,
            'json_interestPoints' => $json_interestPoints,
            'hotel_interestPoints'=> $hotel_interestPoints,
            'hotel_wildcards'     => $hotel_wildcards,
            'hotel_rate'          => $hotel_rate,
            'prices'              => $prices,
        ]);

}

     public function detail(Request $request, $var) {

     	$var = unserialize($var);
     	//dd($var);
     	return view('hotels.detail', [
     		'var'=>$var,
     	]);

     }
     public function autocomplete(Request $request){
        $autocomplete = $request->input('term');
        //$autocomplete = 'bar';
        $hotels = DB::table('hb_hotels')->select('code', 'name as value');
        if ($autocomplete!=null) {
           $hotels = $hotels->where('name','like',$autocomplete . '%')->limit(5);
        }
        $hotels = $hotels->get();

        $hotel = json_encode($hotels);

        return $hotel;
     }

     public function bookingRequest(Request $request){
        $name = "Junior";
        $surname = "AMLO";
        $clien_reference = "bookinID";
        $rateKey = "";
        $request ='{
                    "holder": {
                        "name": "'.$name.'",
                        "surname": "'.$surname.'"
                    },
                    "rooms": [{
                        "rateKey": "'.$rateKey.'",
                        "paxes": [{
                            "roomId": "1",
                            "type": "AD",
                            "name": "'.$name.'",
                            "surname": "'.$surname.'"
                        },
                        {
                            "roomId": "1",
                            "type": "CH",
                            "name": "'.$name.'",
                            "surname": "'.$surname.'"
                        }]
                    }],
                    "clientReference": "IntegrationAgency",
                    "remark": "Booking remarks are to be written here.",
                    "tolerance" : 0
                }';
     }
}

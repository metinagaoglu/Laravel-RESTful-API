<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\AppointmentRepository;
use App\Repository\Eloquent\ContactRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder as RB;
use Postcode;

class AppointmentController extends Controller
{

    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository, ContactRepository $contactRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function index(Request $request)
    {

        //TODO: validation

        $appointments = $this->appointmentRepository->filterAndPaginate($request->get('date'), 10);

        return RB::success($appointments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function store(Request $request)
    {
        //TODO: validation
        //$valid = Postcode::validate($request->get('post_code'));

        $contact = $contact = $this->updateOrCreateContact($request);

        $appointment = Postcode::getPostcode($request->get('post_code'));
        $real_estate = Postcode::getPostcode(getenv('REAL_ESTATE_AGENT_POSTCODE'));

        /**
         * TODO: Make a service for this
         * Google maps api
         */
        $google_maps_api_token = config('services.googleapis.distance');
        $maps = "https://maps.googleapis.com/maps/api/distancematrix/json"
        ."?destinations={$appointment->latitude}%20{$appointment->longitude}"
        ."&origins={$real_estate->latitude}%20{$real_estate->longitude}"
        ."&key={$google_maps_api_token}&mode=driving";
        $mapsCache = file_get_contents($maps);

       $distanceApiResponse = json_decode($mapsCache);
       if(json_last_error() !== 0) {
            return RB::error(110,[],'Google maps api error')->setStatusCode(500);
       }

       if($distanceApiResponse->status !== "OK") {
           return RB::error(111,[],'Google maps api error')->setStatusCode(500);
       }

        /**
         * Date calculate
         */
        $distanceSecond = $distanceApiResponse->rows[0]->elements[0]->duration->value;

        $appointment_date = new Carbon($request->get('appointment_date'));

        $estimated_time_out_of_office = $appointment_date->subSecond($distanceSecond);

        $appointment_date = new Carbon($request->get('appointment_date'));
        $available_time_at_the_office = $appointment_date->addSecond( $distanceSecond + 3600 );

        //Store appointment
        $appointment = $this->appointmentRepository->create([
            'user_id' => auth()->user()->id,
            'contact_id' => $contact->contact_id,
            'appointment_address' => $request->get('appointment_address'),
            'appointment_date' => $request->get('appointment_date'),
            'post_code' => $request->get('post_code'),
            'latitude' => $appointment->latitude,
            'longitude' => $appointment->longitude,
            'origin_addresses' => $distanceApiResponse->origin_addresses[0],
            'distance' => $distanceApiResponse->rows[0]->elements[0]->distance->value,
            'duration' => $distanceApiResponse->rows[0]->elements[0]->duration->value,
            'estimated_time_out_of_office' => $estimated_time_out_of_office->toDateTimeString(),
            'available_time_at_the_office' => $available_time_at_the_office->toDateTimeString(),
        ]);


        return RB::success($appointment)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response|object|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: validation
        $contact = $this->updateOrCreateContact($request);

        $updateAttributes = $request->only('appointment_address', 'appointment_date', 'post_code');
        $updateAttributes['contact_id'] = $contact->contact_id;
        $this->appointmentRepository->update($updateAttributes, $id);

        return RB::success()->setStatusCode(200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        $this->appointmentRepository->destroy($id);
        return RB::success()->setStatusCode(202);
    }

    private function updateOrCreateContact(Request $request)
    {
        return $this->contactRepository->updateOrCreate(
            [
                'phonenumber' => $request->get('contact_phonenumber')
            ],
            [
                'name' => $request->get('contact_name'),
                'email' => $request->get('contact_email'),
                'surname' => $request->get('contact_surname'),
                'phonenumber' => $request->get('contact_phonenumber'),
            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\AppointmentRepository;
use App\Repository\Eloquent\ContactRepository;
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

        /*      TODO: distance calculate using google maps api
                $appointment = Postcode::getPostcode($request->get('post_code'));
                $real_estate = Postcode::getPostcode(getenv('REAL_ESTATE_AGENT_POSTCODE'));
                var_dump($real_estate->longitude);
                var_dump($real_estate->latitude);
                var_dump($appointment->latitude);
                var_dump($appointment->latitude);
                exit;
        */
        //Store appointment
        $appointment = $this->appointmentRepository->create([
            'user_id' => auth()->user()->id,
            'contact_id' => $contact->contact_id,
            'appointment_address' => $request->get('appointment_address'),
            'appointment_date' => $request->get('appointment_date'),
            'post_code' => $request->get('post_code'),
            'distance' => 3, //TODO: calculate
            'estimated_time_out_of_office' => 'NOW()', //TODO: calculate
            'available_time_at_the_office' => 'NOW()', //TODO: calculate
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

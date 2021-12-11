<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\AppointmentRepository;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{

    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function store(Request $request)
    {
        //TODO: validation

        //TODO updateOrCreate contact

        //Store appointment
        $this->appointmentRepository->create([
           'user_id' => auth()->user()->id,
           'contact_id' => 1, //TODO: get contactid
           'appointment_address' => $request->get('appointment_address'),
           'appointment_date' => $request->get('appointment_date'),
           'post_code' => $request->get('post_code'),
           'distance' => 3,
           'estimated_time_out_of_office' => 'NOW()',
           'available_time_at_the_office' => 'NOW()',
        ]);


        return response()->json([
            'status' => true
        ])->setStatusCode(201);

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
        //
    }
}

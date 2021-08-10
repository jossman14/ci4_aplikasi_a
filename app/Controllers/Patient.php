<?php

namespace App\Controllers;

use App\Models\PatientModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Patient extends BaseController
{
    /**
     * Get all Patients
     * @return Response
     */
    public function index()
    {
        $model = new PatientModel();
        return $this->getResponse(
            [
                'message' => 'Patients retrieved successfully',
                'patients' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Patient
     */
    public function store()
    {

      // ['patient_name','gender','address','telp']
        $rules = [
            'patient_name' => 'required|min_length[2]|max_length[225]',
            'gender' => 'required',
            'telp' => 'required|min_length[6]|is_unique[patient.telp]',
            'address' => 'required|max_length[255]'
        ];

 $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $patientTelp = $input['telp'];

        $model = new PatientModel();
        $model->save($input);
        

        $patient = $model->where('telp', $patientTelp)->first();

        return $this->getResponse(
            [
                'message' => 'Patient added successfully',
                'patient' => $patient
            ]
        );
    }

    /**
     * Get a single patient by ID
     */
    public function show($id)
    {
        try {

            $model = new PatientModel();
            $patient = $model->findPatientById($id);

            return $this->getResponse(
                [
                    'message' => 'Patient retrieved successfully',
                    'patient' => $patient
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find patient for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

		public function update($id)
    {
        try {

            $model = new PatientModel();
            $model->findPatientById($id);

          $input = $this->getRequestInput($this->request);


            $model->update($id, $input);
          
            $patient = $model->findPatientById($id);

            return $this->getResponse(
                [
                    'message' => 'Patient updated successfully',
                    'patient' => $patient
                ]
            );

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function destroy($id)
    {
        try {

            $model = new PatientModel();
            $patient = $model->findPatientById($id);
            $model->delete($patient);

            return $this
                ->getResponse(
                    [
                        'message' => 'Patient deleted successfully',
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }


    	public function uploadPatient($id)
    {
        try {

            $model = new PatientModel();
            
            
            return $this->getResponse(
            [
                'message' => 'Patients retrieved successfully',
                'patients' => $model->findAll()
            ]
        );

            

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

}

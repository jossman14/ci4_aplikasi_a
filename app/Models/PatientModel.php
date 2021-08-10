<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PatientModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'patient';
	protected $primaryKey           = 'patient_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['patient_name','gender','address','telp'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

  public function findPatientById($id)
    {
        $client = $this
            ->asArray()
            ->where(['patient_id' => $id])
            ->first();

        if (!$client) throw new Exception('Could not find client for specified ID');

        return $client;
    }
	
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLogActivityAPIRequest;
use App\Http\Requests\API\UpdateLogActivityAPIRequest;
use App\Models\LogActivity;
use App\Repositories\LogActivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LogActivityController
 * @package App\Http\Controllers\API
 */

class LogActivityAPIController extends AppBaseController
{
    /** @var  LogActivityRepository */
    private $logActivityRepository;

    public function __construct(LogActivityRepository $logActivityRepo)
    {
        $this->logActivityRepository = $logActivityRepo;
    }

    /**
     * Display a listing of the LogActivity.
     * GET|HEAD /logActivities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logActivities = $this->logActivityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logActivities->toArray(), 'Log Activities retrieved successfully');
    }

    /**
     * Store a newly created LogActivity in storage.
     * POST /logActivities
     *
     * @param CreateLogActivityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLogActivityAPIRequest $request)
    {
        $input = $request->all();

        $logActivity = $this->logActivityRepository->create($input);

        return $this->sendResponse($logActivity->toArray(), 'Log Activity saved successfully');
    }

    /**
     * Display the specified LogActivity.
     * GET|HEAD /logActivities/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var LogActivity $logActivity */
        $logActivity = $this->logActivityRepository->find($id);

        if (empty($logActivity)) {
            return $this->sendError('Log Activity not found');
        }

        return $this->sendResponse($logActivity->toArray(), 'Log Activity retrieved successfully');
    }

    /**
     * Update the specified LogActivity in storage.
     * PUT/PATCH /logActivities/{id}
     *
     * @param int $id
     * @param UpdateLogActivityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogActivityAPIRequest $request)
    {
        $input = $request->all();

        /** @var LogActivity $logActivity */
        $logActivity = $this->logActivityRepository->find($id);

        if (empty($logActivity)) {
            return $this->sendError('Log Activity not found');
        }

        $logActivity = $this->logActivityRepository->update($input, $id);

        return $this->sendResponse($logActivity->toArray(), 'LogActivity updated successfully');
    }

    /**
     * Remove the specified LogActivity from storage.
     * DELETE /logActivities/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var LogActivity $logActivity */
        $logActivity = $this->logActivityRepository->find($id);

        if (empty($logActivity)) {
            return $this->sendError('Log Activity not found');
        }

        $logActivity->delete();

        return $this->sendSuccess('Log Activity deleted successfully');
    }
}

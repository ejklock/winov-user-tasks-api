<?php

namespace App\Domains\Task\Http\Controllers;

use App\Domains\Task\Http\Requests\StoreTaskRequest;
use App\Domains\Task\Http\Resources\TaskResourceCollection;
use App\Domains\Task\Models\Task;
use App\Domains\Task\Services\TaskService;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
/**
 * @OA\PathItem(path="/api/tasks")
 *  @OpenApi\Tag(name="Auth")
 * 
 */
class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     security={{"jwt":{}}},
     *     summary="Retrieves a collection of tasks for the authenticated user.",
     *     @OA\Response(response="200", description="The collection of tasks.")
     * )
     */
    public function index(Request $request)
    {
        try {
            return new TaskResourceCollection(
                TaskService::listTasksByUser(auth()->user()->id, $request->page, $request->per_page),
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error(
                $th->getMessage(),
                null,
                $th->getCode()
            );
        }
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Creates a new task for the authenticated user.",
     *     security={{"jwt":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Buy milk"),
     *             @OA\Property(property="description", type="string", example="I need to buy milk for breakfast.")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Task created successfully."),
     *     @OA\Response(response="400", description="Invalid request data."),
     *     @OA\Response(response="500", description="Internal server error.")
     * )
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            return ResponseHelper::success(
                'Task created successfully',
                TaskService::createTask(
                    auth()->user()->id,
                    $request->title,
                    $request->description
                ),
                201
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error(
                $th->getMessage(),
                null,
                $th->getCode()
            );
        }
    }


    /**
     * @OA\Delete(
     *     path="/api/tasks/{taskId}",
     *     summary="Deletes a task.",
     *     security={{"jwt":{}}},
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         required=true,
     *         description="The ID of the task to be deleted.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Task deleted successfully."),
     *     @OA\Response(response="404", description="Task not found."),
     *     @OA\Response(response="500", description="Internal server error.")
     * )
     */
    public function destroy(int $taskId)
    {
        try {
            return ResponseHelper::success(
                'Task deleted successfully',
                TaskService::deleteTask($taskId),
                204
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error(
                $th->getMessage(),
                null,
                $th->getCode()
            );
        }
    }


    /**
     * @OA\Put(
     *     path="/api/tasks/{taskId}",
     *     summary="Updates a task.",
     *     security={{"jwt":{}}},
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         required=true,
     *         description="The ID of the task to be updated.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Buy milk"),
     *             @OA\Property(property="description", type="string", example="I need to buy milk for breakfast.")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Task updated successfully."),
     *     @OA\Response(response="404", description="Task not found."),
     *     @OA\Response(response="500", description="Internal server error.")
     * )/**/

    public function update(Task $task, StoreTaskRequest $request)
    {
        try {
            return ResponseHelper::success(
                'Task updated successfully',
                TaskService::updateTask($task->id, $request->title, $request->description),
                201
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error(
                $th->getMessage(),
                null,
                $th->getCode()
            );
        }
    }
}

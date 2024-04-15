<?php

namespace App\Domains\Task\Services;

use App\Domains\Task\Models\Task;
use App\Exceptions\CreateEntityException;
use App\Exceptions\DeleteEntityException;
use App\Exceptions\GeneralException;
use App\Exceptions\UpdateEntityException;
use DateTime;
use Exception;

class TaskService
{

    /**
     * Retrieves a paginated list of tasks belonging to a specific user.
     *
     * @param int $userId The ID of the user whose tasks are being retrieved.
     * @param string $page The page number of the results to retrieve. Default is 1.
     * @param string $perPage The number of tasks per page. Default is 10.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator The paginated list of tasks.
     */
    public static function listTasksByUser(int $userId, $page = 1, $perPage = 10)
    {
        try {
            return Task::where('user_id', $userId)->paginate($perPage, ['*'], 'page', $page);
        } catch (\Throwable $th) {
            throw new GeneralException("Failed to list tasks: " . $th->getMessage());
        }
    }

    /**
     * Creates a new task with the given user ID, title, and description.
     *
     * @param int $userId The ID of the user for the task.
     * @param string $title The title of the task.
     * @param string $description The description of the task.
     * @return Task The newly created task.
     */
    public static function createTask(int $userId, string $title, string $description)
    {
        try {
            return Task::create([
                'user_id' => $userId,
                'title' => $title,
                'description' => $description,
            ]);
        } catch (\Throwable $th) {
            throw new CreateEntityException($th->getMessage());
        }
    }


    public static function deleteTask(int $taskId)
    {
        try {
            return Task::where('id', $taskId)->delete();
        } catch (\Throwable $th) {

            throw new DeleteEntityException($th->getMessage());
        }
    }


    public static function updateTask(int $taskId, string $title, string $description)
    {
        try {
            return Task::where('id', $taskId)->update([
                'title' => $title,
                'description' => $description
            ]);
        } catch (\Throwable $th) {

            throw new UpdateEntityException($th->getMessage());
        }
    }


    public static function markTaskAsCompleted(int $taskId, DateTime $completedAt)
    {
        try {
            return Task::where('id', $taskId)->update([
                'completed_at' => $completedAt
            ]);
        } catch (\Throwable $th) {
            throw new UpdateEntityException($th->getMessage());
        }
    }
}

<?php

namespace App\Domains\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class TaskSchema extends SchemaFactory
{

    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Task')
            ->properties(
                Schema::string('id')->default(null),
                Schema::string('title')->default(null),
                Schema::string('description')->default(null),
                Schema::string('completed_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME)->default(null)
            );
    }
}

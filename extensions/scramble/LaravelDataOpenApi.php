<?php

declare(strict_types=1);

use Spatie\LaravelData\Data;
use Dedoc\Scramble\Extensions\TypeToSchemaExtension;
use Dedoc\Scramble\Support\Type\ObjectType;
use Dedoc\Scramble\Support\Type\Type;

final class LaravelDataOpenApi extends TypeToSchemaExtension
{
    public function shouldHandle(Type $type)
    {
        return $type instanceof ObjectType
            && $type->isInstanceOf(Data::class);
    }

    public function toSchema(Type $type)
    {
        $this->infer->analyzeClass($type->name);

        $array = $type->getMethodDefinition('toArray')
            ->type
            ->getReturnType();

        return $this->openApiTransformer->transform($array);
    }

    public function toResponse(Type $type)
    {
        $this->infer->analyzeClass($type->name);

        $array = $type->getMethodDefinition('toResponse')
            ->type
            ->getReturnType();

        return $this->openApiTransformer->transform($array);
    }
}

<?php


namespace Alvario\ResponseBuilderBundle;

interface SerializerInterface
{
    public const TAG = 'alvario_response_builder_serializer';
    public function serialize($data, $context = null);
    public function deserialize($data, $type, $context = null);
}

<?php


namespace Alvario\ResponseBuilderBundle;

use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;

class JMSArraySerializerAdapter implements SerializerInterface
{
    /**
     * @var ArrayTransformerInterface
     */
    private $transformer;

    /**
     * ArraySerializer constructor.
     * @param ArrayTransformerInterface $transformer
     */
    public function __construct(ArrayTransformerInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    public function serialize($data, $groups = [])
    {
        return $this->transformer->toArray($data, $this->createContext($groups));
    }

    public function deserialize($data, $type, $groups = [])
    {
        $this->transformer->fromArray($data, $type, $this->createContext($groups, true));
    }

    /**
     * @param array $groups
     * @param bool $deserialization
     * @return SerializationContext|DeserializationContext|null
     */
    protected function createContext(array $groups, $deserialization = false)
    {
        if (count($groups) < 1) {
            return null;
        }

        if ($deserialization) {
            return DeserializationContext::create()->setGroups($groups);
        }

        return SerializationContext::create()->setGroups($groups);
    }
}

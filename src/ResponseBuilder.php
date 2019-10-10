<?php


namespace alvario\ResponseBuilderBundle;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseBuilder
{
    private $data;
    /**
     * @var integer $status
     */
    private $status = 200;
    /**
     * @var array $serializationGroups
     */
    private $serializationGroups;
    /**
     * @var SerializerInterface $serializerName
     */
    private $serializer;

    public function getResponse()
    {
        return new JsonResponse(
            $this->serializer->serialize($this->data, $this->serializationGroups),
            $this->status
        );
    }

    /**
     * @param mixed $data
     * @return ResponseBuilder
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param mixed $status
     * @return ResponseBuilder
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param array $serializationGroups
     * @return ResponseBuilder
     */
    public function setSerializationGroups(array $serializationGroups): ResponseBuilder
    {
        $this->serializationGroups = $serializationGroups;
        return $this;
    }

    /**
     * @param SerializerInterface $serializer
     * @return ResponseBuilder
     */
    public function setSerializer(SerializerInterface $serializer): ResponseBuilder
    {
        $this->serializer = $serializer;
        return $this;
    }
}

<?php

namespace IWD\JOBINTERVIEW\Manager\Data;

use IWD\JOBINTERVIEW\Manager\Data\Behavior\DataManagerInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use const ROOT_PATH;

class JsonDataManager implements DataManagerInterface
{
    const DATA_DIR = 'data';

    /**
     * @var array|null
     */
    private $data;

    /**
     * @var DecoderInterface
     */
    private $serializer;

    public function __construct(DecoderInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->data = null;
    }

    public function fetchAll(): array
    {
        if ($this->data) {
            return $this->data;
        }

        $dataPath = sprintf('%s/%s', ROOT_PATH, self::DATA_DIR);
        $this->data = [];
        foreach ($this->scanDir($dataPath) as $filename) {
            $filePath = sprintf('%s/%s', $dataPath, $filename);
            $this->data[] = $this->serializer->decode(file_get_contents($filePath), JsonEncoder::FORMAT);
        }

        return $this->data;
    }

    private function scanDir($directory): array
    {
        return array_diff(scandir($directory), array('..', '.'));
    }
}

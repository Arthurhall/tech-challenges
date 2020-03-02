<?php

namespace IWD\JOBINTERVIEW\Serializer;

use IWD\JOBINTERVIEW\Exception\SerializerUndecodableException;
use IWD\JOBINTERVIEW\Model\SurveyCollection;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SurveySerializer implements DecoderInterface, NormalizerInterface
{
    public function supportsDecoding(string $format)
    {
        return $format == JsonEncoder::FORMAT;
    }

    public function decode(string $data, string $format, array $context = [])
    {
        if (!$this->supportsDecoding($format)) {
            throw new SerializerUndecodableException();
        }

        return json_decode($data, true);
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof SurveyCollection;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        if (!$this->supportsNormalization($object, $format)) {
            throw new SerializerNotNormalizableException();
        }

        $data = [];
        foreach ($object as $survey) {
            $tmpData = [
                'name' => $survey->getName(),
                'code' => $survey->getCode(),
            ];

            if (isset($context['aggregation'])) {
                $tmpData['aggregation'] = [
                    'numeric' => $survey->getAnswerAggregation()->getNumeric(),
                    'date' => $survey->getAnswerAggregation()->getDate(),
                    'qcm' => $survey->getAnswerAggregation()->getQcm(),
                ];
            }

            $data[] = $tmpData;
        }

        return $data;
    }
}

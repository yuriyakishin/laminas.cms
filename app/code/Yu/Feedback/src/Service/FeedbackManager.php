<?php

namespace Yu\Feedback\Service;

class FeedbackManager
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $type;

    /**
     * FeedbackManager constructor.
     * @param array $config
     * @param string $type
     */
    public function __construct(
        array $config,
        string $type
    )
    {
        $this->config = $config;
        $this->type = $type;
    }

    /**
     * @param array $data
     * @return string
     */
    public function createSubject(array $data)
    {
        $subject = '';
        if(isset($this->config['feedback'][$this->type]['subject'])) {
            $subject = $this->config['feedback'][$this->type]['subject'];
        }

        return $subject;

    }

    /**
     * @param array $data
     * @return string
     */
    public function createBody(array $data)
    {
        $body = '12';
        foreach ($this->config['feedback'][$this->type]['elements'] as $item)
        {
            if(isset($item['spec'])) {
                $body .= $item['spec']['options']['label'] . ': ' . $data[$item['spec']['name']];
            }
        }
        return $body;
    }
}
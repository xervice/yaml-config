<?php
declare(strict_types=1);


namespace Xervice\YamlConfig\Business\Exception;


class ConfigException extends \Exception
{
    /**
     * ConfigException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        $message = '[Config] Config failure: ' . $message;
        parent::__construct($message, $code, $previous);
    }

}
<?php

namespace Lib\Jwt\HeaderParameter;

use Lib\Jwt\FactoryTrait;

/**
 * @method ParameterInterface get(string $name)
 */
class Factory
{
    use FactoryTrait;

    /**
     * @var string
     */
    private static $customParameterClass = 'Jwt\HeaderParameter\Custom';

    /**
     * @var array
     */
    private static $classMap = [
        Algorithm::NAME                       => 'Jwt\HeaderParameter\Algorithm',
        ContentType::NAME                     => 'Jwt\HeaderParameter\ContentType',
        Critical::NAME                        => 'Jwt\HeaderParameter\Critical',
        JsonWebKey::NAME                      => 'Jwt\HeaderParameter\JsonWebKey',
        JwkSetUrl::NAME                       => 'Jwt\HeaderParameter\JwkSetUrl',
        KeyId::NAME                           => 'Jwt\HeaderParameter\KeyId',
        Type::NAME                            => 'Jwt\HeaderParameter\Type',
        X509CertificateChain::NAME            => 'Jwt\HeaderParameter\X509CertificateChain',
        X509CertificateSha1Thumbprint::NAME   => 'Jwt\HeaderParameter\X509CertificateSha1Thumbprint',
        X509CertificateSha256Thumbprint::NAME => 'Jwt\HeaderParameter\X509CertificateSha256Thumbprint',
        X509Url::NAME                         => 'Jwt\HeaderParameter\X509Url',
    ];

    /**
     * @return array
     */
    protected function getClassMap()
    {
        return self::$classMap;
    }

    /**
     * @return string
     */
    protected function getDefaultClass()
    {
        return self::$customParameterClass;
    }
}

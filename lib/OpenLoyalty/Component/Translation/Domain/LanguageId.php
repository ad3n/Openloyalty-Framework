<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Component\Translation\Domain;

use Assert\Assertion as Assert;
use OpenLoyalty\Component\Core\Domain\Model\Identifier;

/**
 * Class LanguageId.
 */
class LanguageId implements Identifier
{
    /**
     * @var string
     */
    private $languageId;

    /**
     * LanguageId constructor.
     *
     * @param string $languageId
     */
    public function __construct(string $languageId)
    {
        Assert::string($languageId);
        Assert::uuid($languageId);

        $this->languageId = $languageId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->languageId;
    }
}

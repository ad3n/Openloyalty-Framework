<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Component\Transaction\Domain;

use Assert\Assertion as Assert;
use OpenLoyalty\Component\Core\Domain\Model\Identifier;

/**
 * Class CustomerId.
 */
class CustomerId implements Identifier
{
    private $customerId;

    /**
     * @param string $customerId
     */
    public function __construct($customerId)
    {
        Assert::string($customerId);
        Assert::uuid($customerId);

        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->customerId;
    }
}

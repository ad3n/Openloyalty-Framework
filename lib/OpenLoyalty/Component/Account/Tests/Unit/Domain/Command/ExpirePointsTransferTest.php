<?php
/*
 * Copyright © 2018 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace OpenLoyalty\Component\Account\Tests\Unit\Domain\Command;

use OpenLoyalty\Component\Account\Domain\AccountId;
use OpenLoyalty\Component\Account\Domain\Command\ExpirePointsTransfer;
use OpenLoyalty\Component\Account\Domain\CustomerId;
use OpenLoyalty\Component\Account\Domain\Event\AccountWasCreated;
use OpenLoyalty\Component\Account\Domain\Event\PointsTransferHasBeenExpired;
use OpenLoyalty\Component\Account\Domain\Event\PointsWereAdded;
use OpenLoyalty\Component\Account\Domain\Model\AddPointsTransfer;
use OpenLoyalty\Component\Account\Domain\PointsTransferId;

/**
 * Class ExpirePointsTransferTest.
 */
final class ExpirePointsTransferTest extends AccountCommandHandlerTest
{
    /**
     * @test
     */
    public function it_expire_points()
    {
        $accountId = new AccountId('00000000-0000-0000-0000-000000000000');
        $customerId = new CustomerId('00000000-1111-0000-0000-000000000000');
        $pointsTransferId = new PointsTransferId('00000000-1111-0000-0000-000000000111');
        $pointsTransferId2 = new PointsTransferId('00000000-1111-0000-0000-000000000112');
        $this->scenario
            ->withAggregateId((string) $accountId)
            ->given([
                new AccountWasCreated($accountId, $customerId),
                new PointsWereAdded($accountId, new AddPointsTransfer($pointsTransferId, 100, 5, null, new \DateTime('-11 days'))),
                new PointsWereAdded($accountId, new AddPointsTransfer($pointsTransferId2, 100, 6, null, new \DateTime('-10 days'))),
            ])
            ->when(new ExpirePointsTransfer($accountId, $pointsTransferId))
            ->then(array(
                new PointsTransferHasBeenExpired($accountId, $pointsTransferId),
            ));
    }
}

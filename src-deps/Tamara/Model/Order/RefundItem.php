<?php

declare(strict_types=1);

namespace Tamara_Checkout\Deps\Tamara\Model\Order;

use Tamara_Checkout\Deps\Tamara\Model\Money;
use DateTimeImmutable;
use DateTime;

class RefundItem
{
    private const
        REFUND_ID = 'refund_id',
        CAPTURE_ID = 'capture_id',
        TOTAL_AMOUNT = 'total_amount',
        ITEMS = 'items',
        CREATED_AT = 'created_at';

    /**
     * @var string
     */
    private $refundId;

    /**
     * @var string
     */
    private $captureId;

    /**
     * @var Money
     */
    private $totalAmount;

    /**
     * @var OrderItemCollection
     */
    private $items;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    public static function fromArray(array $data): RefundItem
    {
        $self = new self();
        $self->setRefundId($data[self::REFUND_ID]);
        $self->setCaptureId($data[self::CAPTURE_ID]);
        $self->setItems(OrderItemCollection::create($data[self::ITEMS]));
        $self->setTotalAmount(Money::fromArray($data[self::TOTAL_AMOUNT]));
        $self->setCreatedAt(new DateTimeImmutable($data[self::CREATED_AT]));

        return $self;
    }

    public function getRefundId(): string
    {
        return $this->refundId;
    }

    public function setRefundId(string $refundId): void
    {
        $this->refundId = $refundId;
    }

    public function getCaptureId(): string
    {
        return $this->captureId;
    }

    public function setCaptureId(string $captureId): void
    {
        $this->captureId = $captureId;
    }

    public function getTotalAmount(): Money
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(Money $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    public function getItems(): OrderItemCollection
    {
        return $this->items;
    }

    public function setItems(OrderItemCollection $items): void
    {
        $this->items = $items;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function toArray(): array
    {
        return [
            self::REFUND_ID => $this->getRefundId(),
            self::CAPTURE_ID => $this->getCaptureId(),
            self::ITEMS => $this->getItems()->toArray(),
            self::TOTAL_AMOUNT => $this->getTotalAmount()->toArray(),
            self::CREATED_AT => $this->getCreatedAt()->format(DateTime::ATOM),
        ];
    }
}
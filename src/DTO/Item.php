<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Traits\Makeable;
use WandesCardoso\MercadoPago\Contracts\Arrayable;

final class Item implements Arrayable
{
    use Makeable;

    public function __construct(
        public ?string $id = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $pictureUrl = null,
        public ?string $categoryId = null,
        public ?int $quantity = null,
        public ?float $unitPrice = null
    ) {

    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'picture_url' => $this->pictureUrl,
            'category_id' => $this->categoryId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
        ];
    }

    public function getTotalAmount(): float
    {
        return $this->quantity * $this->unitPrice;
    }

    /**
     * @param  string|null  $id
     *
     * @return Item
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param  string|null  $title
     *
     * @return Item
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  string|null  $description
     *
     * @return Item
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param  string|null  $pictureUrl
     *
     * @return Item
     */
    public function setPictureUrl(?string $pictureUrl): self
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * @param  string|null  $categoryId
     *
     * @return Item
     */
    public function setCategoryId(?string $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @param  int|null  $quantity
     *
     * @return Item
     */
    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @param  float|null  $unitPrice
     *
     * @return Item
     */
    public function setUnitPrice(?float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }
}

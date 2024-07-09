<?php declare(strict_types=1);

namespace Diglin\Sylius\ApiClient;


class SyliusShopClientDecorator implements SyliusShopClientInterface
{
    /** @var list<Api\ApiAwareInterface> */
    private array $apiRegistry = [];

    public function __construct(
        private SyliusShopClientInterface $decoratedClient
    ) {}

    public function __call($name, $arguments)
    {
        $property = lcfirst(substr($name, 3));
        if ('get' === substr($name, 0, 3) && isset($this->apiRegistry[$property])) {
            return $this->apiRegistry[$property];
        }

        return $this->decoratedClient->{$name}($arguments);
    }

    public function addApi(string $key, Api\ApiAwareInterface $api)
    {
        $this->apiRegistry[$key] = $api;
    }

    public function get(string $name): ?Api\ApiAwareInterface
    {
        return $this->apiRegistry[$name] ?? null;
    }

    public function getAddressApi(): Api\Shop\AddressApiInterface
    {
        return $this->decoratedClient->getAddressApi();
    }

    public function getAdjustmentApi(): Api\Shop\AdjustmentApiInterface
    {
        return $this->decoratedClient->getAdjustmentApi();
    }

    public function getChannelApi(): Api\Shop\ChannelApiInterface
    {
        return $this->decoratedClient->getChannelApi();
    }

    public function getCountryApi(): Api\Shop\CountryApiInterface
    {
        return $this->decoratedClient->getCountryApi();
    }

    public function getCatalogPromotionApi(): Api\Shop\CatalogPromotionApiInterface
    {
        return $this->decoratedClient->getCatalogPromotionApi();
    }

    public function getCurrencyApi(): Api\Shop\CurrencyApiInterface
    {
        return $this->decoratedClient->getCurrencyApi();
    }

    public function getCustomerApi(): Api\Shop\CustomerApiInterface
    {
        return $this->decoratedClient->getCustomerApi();
    }

    public function getLocaleApi(): Api\Shop\LocaleApiInterface
    {
        return $this->decoratedClient->getLocaleApi();
    }

    public function getOrderItemUnitApi(): Api\Shop\OrderItemUnitApiInterface
    {
        return $this->decoratedClient->getOrderItemUnitApi();
    }

    public function getOrderItemApi(): Api\Shop\OrderItemApiInterface
    {
        return $this->decoratedClient->getOrderItemApi();
    }

    public function getOrderApi(): Api\Shop\OrderApiInterface
    {
        return $this->decoratedClient->getOrderApi();
    }

    public function getPaymentApi(): Api\Shop\PaymentApiInterface
    {
        return $this->decoratedClient->getPaymentApi();
    }

    public function getShipmentApi(): Api\Shop\ShipmentApiInterface
    {
        return $this->decoratedClient->getShipmentApi();
    }

    public function getPaymentMethodApi(): Api\Shop\PaymentMethodApiInterface
    {
        return $this->decoratedClient->getPaymentMethodApi();
    }

    public function getProductImageApi(): Api\Shop\ProductImageApiInterface
    {
        return $this->decoratedClient->getProductImageApi();
    }

    public function getProductOptionValueApi(): Api\Shop\ProductOptionValueApiInterface
    {
        return $this->decoratedClient->getProductOptionValueApi();
    }

    public function getProductOptionApi(): Api\Shop\ProductOptionApiInterface
    {
        return $this->decoratedClient->getProductOptionApi();
    }

    public function getProductReviewApi(): Api\Shop\ProductReviewApiInterface
    {
        return $this->decoratedClient->getProductReviewApi();
    }

    public function getProductTaxonApi(): Api\Shop\ProductTaxonApiInterface
    {
        return $this->decoratedClient->getProductTaxonApi();
    }

    public function getProductTranslationApi(): Api\Shop\ProductTranslationApiInterface
    {
        return $this->decoratedClient->getProductTranslationApi();
    }

    public function getProductVariantTranslationApi(): Api\Shop\ProductVariantTranslationApiInterface
    {
        return $this->decoratedClient->getProductVariantTranslationApi();
    }

    public function getProductVariantApi(): Api\Shop\ProductVariantApiInterface
    {
        return $this->decoratedClient->getProductVariantApi();
    }

    public function getProductApi(): Api\Shop\ProductApiInterface
    {
        return $this->decoratedClient->getProductApi();
    }

    public function getShippingMethodApi(): Api\Shop\ShippingMethodApiInterface
    {
        return $this->decoratedClient->getShippingMethodApi();
    }

    public function getShippingMethodTranslationApi(): Api\Shop\ShippingMethodTranslationApiInterface
    {
        return $this->decoratedClient->getShippingMethodTranslationApi();
    }

    public function getTaxonTranslationApi(): Api\Shop\TaxonTranslationApiInterface
    {
        return $this->decoratedClient->getTaxonTranslationApi();
    }

    public function getTaxonApi(): Api\Shop\TaxonApiInterface
    {
        return $this->decoratedClient->getTaxonApi();
    }

    public function getVerifyCustomerAccountApi(): Api\Shop\VerifyCustomerAccountApiInterface
    {
        return $this->decoratedClient->getVerifyCustomerAccountApi();
    }

    public function getResetPasswordRequestApi(): Api\Shop\ResetPasswordRequestApiInterface
    {
        return $this->decoratedClient->getResetPasswordRequestApi();
    }
}

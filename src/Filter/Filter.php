<?php
/**
 * Diglin GmbH - Switzerland.
 *
 * @author      Sylvain Rayé <support at diglin.com>
 *
 * @category    SyliusApiClient
 *
 * @copyright   2020 - Diglin (https://www.diglin.com)
 */

namespace Diglin\Sylius\ApiClient\Filter;

class Filter implements FilterInterface
{
    /** @var string */
    private $nameOfCriterion;
    /** @var string */
    private $searchPhrase;
    /** @var string */
    private $searchOption;

    public function __construct(
        string $nameOfCriterion = 'search',
        string $searchOption = SearchOptions::CONTAINS,
        string $searchPhrase = ''
    ) {
        $this->nameOfCriterion = $nameOfCriterion;
        $this->searchPhrase = $searchPhrase;
        $this->searchOption = $searchOption;
    }

    public function getCriteria(): array
    {
        return [
            printf('criteria[%s][type]', $this->nameOfCriterion) => $this->searchOption,
            printf('criteria[%s][value]', $this->nameOfCriterion) => $this->searchPhrase,
        ];
    }
}

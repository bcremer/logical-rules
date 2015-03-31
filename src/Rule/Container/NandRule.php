<?php

namespace Dnoegel\Rules\Rule\Container;

/**
 * NandRule nagates the result of the AndRule
 *
 * Class NandRule
 * @package Dnoegel\Rules\Rule\Container
 */
class NandRule extends AbstractContainer
{
    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        $andRule = $this->createAndRuleFromRules();

        $rule = new NotRule($andRule);

        return $rule->validate();
    }

    /**
     * @return AndRule
     */
    private function createAndRuleFromRules()
    {
        $andRuleClass = 'Dnoegel\Rules\Rule\Container\AndRule';
        // as of PHP 5.5 this can be replaced by:
        // $andRuleClass = AndRule::class;

        $reflect = new \ReflectionClass($andRuleClass);
        $andRule = $reflect->newInstanceArgs($this->rules);

        return $andRule;
    }
}

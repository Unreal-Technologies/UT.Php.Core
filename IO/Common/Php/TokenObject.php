<?php

namespace UT_Php_Core\IO\Common\Php;

class TokenObject implements IObject
{
    use DeclarationTraits;
    
    /**
     * @var array
     */
    private array $tokens;

    /**
     * @param array $tokens
     */
    public function __construct(array $tokens)
    {
        $this -> tokens = $tokens;
    }

    /**
     * @return string
     */
    public function declaration(): string
    {
        return implode('', (new \UT_Php_Core\Collections\Linq($this -> tokens))
            -> select(function ($x) {
                if (is_array($x)) {
                    return $x[1];
                }
                return $x;
            })
            -> toArray());
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return (new \UT_Php_Core\Collections\Linq($this -> tokens))
            -> firstOrDefault(function ($x) {
                return is_array($x) && $x[0] === 313;
            })[1];
    }
    
    /**
     * @return bool
     */
    public function isClass(): bool
    {
        return (new \UT_Php_Core\Collections\Linq($this -> tokens))
            -> firstOrDefault(function ($x) {
                return is_array($x) && $x[0] === 369;
            }) !== null;
    }
    
    /**
     * @return bool
     */
    public function isTrait(): bool
    {
        return (new \UT_Php_Core\Collections\Linq($this -> tokens))
            -> firstOrDefault(function ($x) {
                return is_array($x) && $x[0] === 370;
            }) !== null;
    }
    
    /**
     * @return bool
     */
    public function isInterface(): bool
    {
        return (new \UT_Php_Core\Collections\Linq($this -> tokens))
            -> firstOrDefault(function ($x) {
                return is_array($x) && $x[0] === 371;
            }) !== null;
    }
    
    /**
     * @return bool
     */
    public function isEnum(): bool
    {
        return (new \UT_Php_Core\Collections\Linq($this -> tokens))
            -> firstOrDefault(function ($x) {
                return is_array($x) && $x[0] === 372;
            }) !== null;
    }
}
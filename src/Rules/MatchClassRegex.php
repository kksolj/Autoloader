<?php
/**
 * This file is part of Reflect\Autoloader package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Reflect\Autoloader\Rules;

/**
 * Class MatchClassRegex
 * @package Reflect\Autoloader\Rules
 */
class MatchClassRegex implements Comparator
{
    /**
     * @var string
     */
    private $regex;

    /**
     * MatchFileRegex constructor.
     * @param string $regex
     */
    public function __construct(string $regex)
    {
        $this->regex = '#' . $regex . '#isu';
    }

    /**
     * @param string $class
     * @param string $file
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function compare(string $class, string $file): bool
    {
        $result = @preg_match($this->regex, $class);

        if ($result === false) {
            throw new \InvalidArgumentException('Cannot parse the ' . $this->regex . ' regular expression');
        }

        return $result === 1;
    }
}

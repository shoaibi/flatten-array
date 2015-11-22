<?php
declare(strict_types=1);
namespace Intercom;
/**
 * Class with few(just 1 for now) utility functions to work with
 * nested arrays
 */
class NestedArray
{
  /**
   * Take a array with nested arrays and returns a flattened 1-dimension version
   * @param  array  $source Containing nested elements
   * @return array  Flattened representation of the input array
   */
  public function flatten(array $source): array
  {
    $flattenedArray = [];

    foreach ($source as $element) {
      if (\is_array($element)) {
        $flattenedArray = \array_merge($flattenedArray, $this->flatten($element));
      } else {
        $flattenedArray[] = $element;
      }
    }
    return $flattenedArray;
  }
}

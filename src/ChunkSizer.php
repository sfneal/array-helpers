<?php


namespace Sfneal\Helpers\Arrays;


use Sfneal\Actions\AbstractActionStatic;

class ChunkSizer extends AbstractActionStatic
{
    /**
     * Return a best fit chunk size to be passed to array_chunks functions.
     *
     * Calculates the remainder of array sizes divided by the divisor
     * using modulus division.  Continues to calculate remainders until
     * the remainder is zero, signifying evenly sized chunks, or the
     * divisor is equal to the array size.  If a remainder of zero is not
     * found the lowest remainder is returned.
     *
     * @param int $array_size
     * @param int $min minimum chunk size
     * @param null $max maximum chunk size
     * @param int $divisor
     * @return int $remainder lowest calculated remainder
     */
    public static function execute(int $array_size, $min = 0, $max = null, $divisor = 2): int
    {
        // If the size of the array is a perfect square, return the square root
        if (gmp_perfect_square($array_size) == true) {
            return sqrt($array_size);
        }

        // If min and max are the same return that value
        elseif ($min == $max) {
            return $min;
        }

        $max = (isset($max) ? $max : $array_size);
        $sizes = [];
        while ($divisor < $max) {
            $sizes[$divisor] = [
                // Number of chunks
                'rows'=> floor($array_size / $divisor),

                // Items in each chunk
                'cols' => $divisor,

                // Left over items in last chunk
                'remainder' => $array_size % $divisor,
            ];
            $divisor++;
        }

        // Filter sizes by column values
        return min(array_filter(
            array_column($sizes, 'cols', 'cols'),
            function ($size) use ($min, $max, $sizes) {
                return
                    // Check that the remainder is no more than half of the number of columns
                    ($sizes[$size]['remainder'] == 0 || $sizes[$size]['remainder'] >= $size / 2) &&

                    // Check that the number of columns is greater than or equal than min and less than or equal than max
                    $min <= $size && $size <= $max;
            }
        ));
    }
}

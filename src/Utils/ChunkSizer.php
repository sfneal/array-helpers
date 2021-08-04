<?php

namespace Sfneal\Helpers\Arrays\Utils;

use Sfneal\Actions\Action;

class ChunkSizer extends Action
{
    /**
     * @var int
     */
    private $array_size;

    /**
     * @var int
     */
    private $min;

    /**
     * @var int|null
     */
    private $max;

    /**
     * @var int
     */
    private $divisor;

    /**
     * ChunkSizer constructor.
     *
     * @param int $array_size size of the array
     * @param int $min minimum chunk size
     * @param int|null $max maximum chunk size
     * @param int $divisor
     */
    public function __construct(int $array_size, int $min = 0, int $max = null, int $divisor = 2)
    {
        $this->array_size = $array_size;
        $this->min = $min;
        $this->max = $max;
        $this->divisor = $divisor;
    }

    /**
     * Return a best fit chunk size to be passed to array_chunks functions.
     *
     * Calculates the remainder of array sizes divided by the divisor
     * using modulus division.  Continues to calculate remainders until
     * the remainder is zero, signifying evenly sized chunks, or the
     * divisor is equal to the array size.  If a remainder of zero is not
     * found the lowest remainder is returned.
     *
     * @return int $remainder lowest calculated remainder
     */
    public function execute(): int
    {
        // If the size of the array is a perfect square, return the square root
        if (gmp_perfect_square($this->array_size) == true) {
            return sqrt($this->array_size);
        }

        // If min and max are the same return that value
        elseif ($this->min == $this->max) {
            return $this->min;
        }

        $this->max = (isset($this->max) ? $this->max : $this->array_size);
        $sizes = [];
        while ($this->divisor < $this->max) {
            $sizes[$this->divisor] = [
                // Number of chunks
                'rows'=> floor($this->array_size / $this->divisor),

                // Items in each chunk
                'cols' => $this->divisor,

                // Left over items in last chunk
                'remainder' => $this->array_size % $this->divisor,
            ];
            $this->divisor++;
        }

        // Filter sizes by column values
        return min(array_filter(
            array_column($sizes, 'cols', 'cols'),
            function ($size) use ($sizes) {
                return
                    // Check that the remainder is no more than half of the number of columns
                    ($sizes[$size]['remainder'] == 0 || $sizes[$size]['remainder'] >= $size / 2) &&

                    // Check that the number of columns is greater than or equal than min and less than or equal than max
                    $this->min <= $size && $size <= $this->max;
            }
        ));
    }
}

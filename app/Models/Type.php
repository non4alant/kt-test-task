<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public static function maskConversion($serial_number)
    {
        $output = '';

        for ($i = 0; $i < strlen($serial_number); $i++) {
            $char = $serial_number[$i];

            if (is_numeric($char)) {
                $output .= 'N';
            } elseif (ctype_upper($char)) {
                if (in_array($char, range('A', 'Z'))) {
                    $output .= 'A';
                } else {
                    $output .= 'X';
                }
            } elseif (ctype_lower($char)) {
                $output .= 'a';
            } elseif (in_array($char, ['-', '_', '@'])) {
                $output .= 'Z';
            } else {
                $output .= $char;
            }
        }

        return $output;
    }
}

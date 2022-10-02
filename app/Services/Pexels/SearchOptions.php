<?php

namespace App\Services\Pexels;

use Illuminate\Contracts\Support\Arrayable;

class SearchOptions implements Arrayable
{
  public function toArray(): array
  {
    return [
      'orientation' => 'landscape',
    ];
  }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class CarouselService
{
    public function get()
    {
        return setting('carousel', null);
    }

    public function set(array $input)
    {
        setting(['carousel' => $input]);
    }

    public function create(array $input)
    {
        $this->validate($input);

        if (!$old = $this->get()) {
            $this->set([$input]);
        } else {
            $old[] = $input;
            $this->set($old);
        }
    }

    public function update(array $input)
    {
        $result = [];

        foreach ($input as $key => $value) {
            $this->validate($value);
            $result[] = $value;
        }

        $this->set($result);
    }

    private function validate(array $input)
    {
        Validator::make(
            $input,
            [
                'image' => 'string|required|max:250',
                'text' => 'nullable|string|max:250',
                'link' => 'nullable|string|max:250',
                'link_text' => 'nullable|string|max:30',
                'link_class' => 'nullable|string|max:50'
            ]
        )->validate();
    }
}

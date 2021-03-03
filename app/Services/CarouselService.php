<?php

namespace App\Services;

use App\Actions\Vendor\Filepond;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class CarouselService
{
    protected $filepond;

    public function __construct(Filepond $filepond)
    {
        $this->filepond = $filepond;
    }

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
        $input['image'] = $this->processImage($input['image']);

        if (!$old = $this->get()) {
            $input['id'] = 1;
            $this->set([$input]);
        } else {
            $input['id'] = max(Arr::pluck($input, 'id')) + 1;
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
                'image' => 'string|required|max:255',
                'text' => 'nullable|string|max:50',
                'text_class' => 'nullable|string|max:50',
                'link' => 'nullable|string|max:250',
                'link_text' => 'nullable|string|max:30',
                'link_class' => 'nullable|string|max:50'
            ]
        )->validate();
    }

    private function processImage(string $text)
    {
        return $this->filepond->move($text, 'carousel');
    }
}

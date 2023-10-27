<?php
namespace App\Service;

use InvalidArgumentException;

class NewProductValidator
{
    public $validationResult = false;

    public function validate($requestPayload)
    {
        $result = false;

//        $param = $request->getPayload()->all();
        $param = $requestPayload;
        if (isset($param['name']) == false) {
            throw new InvalidArgumentException('Name missing');
        }
        if (isset($param['quantity']) == false) {
            throw new InvalidArgumentException('Quantity missing');
        }
        if (isset($param['priceNet']) == false) {
            throw new InvalidArgumentException('priceNet missing');
        }
        if (isset($param['priceGross']) == false) {
            throw new InvalidArgumentException('priceGross missing');
        }
        if (isset($param['vatRate']) == false) {
            throw new InvalidArgumentException('vatRate missing');
        }

        $this->validationResult = true;
    }

    public function isValid(): bool
    {
        return $this->validationResult;
    }
}

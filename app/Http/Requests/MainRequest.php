<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class MainRequest extends FormRequest
{

    abstract protected function rulesArray();

    protected function postMethod()
    {
        return $this->rulesArray();
    }

    protected function patchMethod()
    {
        return $this->rulesArray();
    }

    protected function putMethod()
    {
        $params = $this->request->keys();
        $validateArray = [];
        $mainRules = $this->rulesArray();
        if (!empty($params)) {
            foreach ($params as $param) {
                $validateArray[$param] = $mainRules[$param];
            }
        }
        return $validateArray;
    }

    public function checkRequest()
    {
        switch (request()->method()) {
            case 'POST':
                return $this->postMethod();
                break;

            case 'PATCH':
                return $this->patchMethod();
                break;

            case 'PUT':
                return $this->putMethod();
                break;
            default :
                return [];
                break;
        }
    }

}

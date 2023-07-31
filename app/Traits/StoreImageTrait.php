<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait StoreImageTrait
{

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStoreImage(Request $request, $fieldname = 'picture', $directory = 'unknown')
    {
        if ($request->hasFile($fieldname)) {
            if (!$request->file($fieldname)->isValid()) {
                session()->flash('error', 'Invalid Image!');
                return redirect()->back()->withInput();
            }
            $destinationPath = $directory;

            $file = $request->$fieldname ;
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid(). '.' . $extension;
            $file->move($destinationPath, $fileName);

            return $fileName;
        }
        return null;
    }
}

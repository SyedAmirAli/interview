<?php

namespace App\Http\Controllers;

use App\Helper\Resources;
use App\Models\GeneralInformation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GeneralFormController extends Controller
{
    public function index()
    {
        $countries = Resources::COUNTRIES;
        $generalsInformation = GeneralInformation::latest('id')->get();

        return view('home', compact('countries', 'generalsInformation'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:4096',
            'bankName' => 'required',
            'accountNo' => 'required',
            'ibn' => 'required',
            'accountType' => 'required',
            'nid' => 'required',
            'countryName' => 'required',
            'countryCode' => 'required',
        ]);

        $image = Resources::saveFile($request);
        $generalInformation = GeneralInformation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'date_of_birth' => $request->input('dateOfBirth'),
            'gender' => $request->input('gender'),
            'image' => $image,
            'passport' => $request->input('passport'),
            'bank_name' => $request->input('bankName'),
            'account_no' => $request->input('accountNo'),
            'ibn' => $request->input('ibn'),
            'account_type' => $request->input('accountType'),
            'nid' => $request->input('nid'),
            'country_name' => $request->input('countryName'),
            'country_code' => $request->input('countryCode'),
        ]);

        if ($generalInformation) {
            return response()->json([
                'status' => 'success',
                'message' => 'Information stored successfully!',
                'data' => $generalInformation
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to stored Information!',
            'data' => $generalInformation
        ], 500);
    }
    public function update(Request $request, $id)
    {
        $generalInformation = GeneralInformation::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'bankName' => 'required',
            'accountNo' => 'required',
            'ibn' => 'required',
            'accountType' => 'required',
            'nid' => 'required',
            'countryName' => 'required',
            'countryCode' => 'required',
        ]);

        $image = Resources::saveFile($request, oldPath: $generalInformation->image);
        if ($image) $generalInformation->image = $image;

        if (!$image && $request->input('isImageDelete') && $request->input('isImageDelete') === '1') {
            if ($generalInformation->image && file_exists($generalInformation->image)) {
                unlink($generalInformation->image);
            }
            $generalInformation->image = null;
        }

        $generalInformation->name = $request->input('name');
        $generalInformation->email = $request->input('email');
        $generalInformation->phone = $request->input('phone');
        $generalInformation->date_of_birth = $request->input('dateOfBirth');
        $generalInformation->gender = $request->input('gender');
        $generalInformation->passport = $request->input('passport');
        $generalInformation->bank_name = $request->input('bankName');
        $generalInformation->account_no = $request->input('accountNo');
        $generalInformation->ibn = $request->input('ibn');
        $generalInformation->account_type = $request->input('accountType');
        $generalInformation->nid = $request->input('nid');
        $generalInformation->country_name = $request->input('countryName');
        $generalInformation->country_code = $request->input('countryCode');

        if ($generalInformation->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Information updated successfully!',
                'data' => $generalInformation,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update Information!',
            'data' => $generalInformation,
        ], 500);
    }

    public function delete($id)
    {
        $generalInformation = GeneralInformation::findOrFail($id);

        if ($generalInformation->image && file_exists($generalInformation->image)) {
            unlink($generalInformation->image);
        }

        if ($generalInformation->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Information deleted successfully!',
                'data' => $generalInformation,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete Information!',
            'data' => ['id' => $id],
        ], 500);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserCats;
use App\User;
use Image;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $this->data['user'] = Auth::user();
        return view('users.dashboard', $this->data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveBasic(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $user = Auth::user();

        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->birthday = $request['birthday'];
        $user->resume = $request['resume'];
        $user->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveImage(Request $request)
    {
        $image = $request->file('image');
        $filename = time() . '-' . Auth::user()->first_name . '-' . Auth::user()->last_name . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

        $user = Auth::user();

        $user->image = $filename;
        $user->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveContacts(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);

        $user = Auth::user();

        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePay(Request $request)
    {
        $user = Auth::user();

        $user->pay_card_pb = $request['pay_card_pb'];
        $user->pay_card_2 = $request['pay_card_2'];
        $user->save();

        return redirect()->back();
    }

    /**
     * @param $id
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, User $user)
    {
        $this->data['user'] = $user->getById($id);

        return view('users.show', $this->data);
    }

    /**
     * @param UserCats $cats
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function freelancers(UserCats $cats, User $users)
    {
        $this->data['freelancers'] = User::all();
        $this->data['cats'] = $cats->getActive();

        return view('users.freelancers', $this->data);
    }

    /**
     * @param $slug
     * @param UserCats $cat
     * @param User $users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory($slug, UserCats $cat, User $users)
    {
        $this->data['ucat'] = $cat->getBySlug($slug);
        $this->data['cats'] = $cat->getActive();
        $this->data['freelancers'] = $users->all();

        return view('users.show_cat', $this->data);
    }
}

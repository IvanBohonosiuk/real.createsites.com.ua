<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCat;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function index(Product $products, ProductCat $cats)
    {
        $this->data['products'] = $products->getActive();
        $this->data['cats'] = $cats->getActive();

        return view('shop.index', $this->data);
    }

    public function show($id)
    {
        $this->data['product'] = Product::find($id);

        return view('shop.show', $this->data);
    }

    /**
     *
     * view create new product form
     *
     * @param ProductCat $cats
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ProductCat $cats)
    {
        $this->data['cats'] = $cats->getActive();

        return view('shop.create', $this->data);
    }

    /**
     *
     * create - save new project
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'description' => 'required|max:1000'
        ]);

        $product = new Product;

        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->price = $request['price'];

        if (isset($request['sale_price'])) :
            $product->sale_price = $request['sale_price'];
        endif;

        if (isset($request['qty'])) :
            $product->qty = $request['qty'];
        endif;

        if ($request->file('img')) :

            $image = $request->file('img');
            $filename = time() . '_' . Auth::user()->id . '_' . Auth::user()->name . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( public_path('/uploads/products/' . $filename ) );

            $product->img = $filename;

        endif;

        $product->user_id = $request['user_id'];

        $message = $request->user()->products()->save($product) ? 'Продукт отправлен на модерацию успешно!' : 'Произошла ошыбка!';

        $cats_id = $request['cat_ids'];

        foreach ($cats_id as $cat_id) :
            $product->categories()->attach($cat_id);
        endforeach;

        return redirect()->back()->with(['message' => $message]);
    }

    /**
     *
     * get category by slug and all products into category
     *
     * @param $slug
     * @param ProjectCats $cat
     * @param Projects $projects
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory($slug, ProjectCats $cat, Projects $projects)
    {
        $this->data['pcat'] = $cat->getBySlug($slug);
        $this->data['cats'] = $cat->getActive();
        $this->data['projects'] = $projects->getActive();

        return view('projects.show_cat', $this->data);
    }

    /**
     *
     * activate product in admin panel
     *
     * @param $id
     * @param Projects $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateProduct($id, Product $product)
    {
        $act_product = $product->getById($id);

        $act_product->active = 1;
        $act_product->save();

        // send notification on pusher.com
        // $pusher = new \Pusher(
        //     config('broadcasting.connections.pusher.key'),
        //     config('broadcasting.connections.pusher.secret'),
        //     config('broadcasting.connections.pusher.app_id'),
        //     config('broadcasting.connections.pusher.options')
        // );
        // set project data
        // $data = ['project' => $act_project, 'user' => $act_project->user];
        // $pusher->trigger( 'project', 'NewProject', $data);


        // send event to project author
//        event(new NewProject($act_project, $act_project->user));

        // find all users
//        $users = User::all();
//
//        foreach ($users as $user) :
//            if ($user->hasRole('Freelancer')) :
//                // send notification to all freelancers
//                $user->notify(new AddProjects($act_project, $act_project->user));
//            endif;
//        endforeach;

        return redirect()->back();
    }
}

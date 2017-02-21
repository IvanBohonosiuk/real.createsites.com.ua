<?php

namespace App\Http\Controllers;

use App\Models\ProjectCats;
use Illuminate\Http\Request;
use App\Models\Projects;


class ProjectsController extends Controller
{
    /**
     *
     * View list active project
     *
     * @param Projects $projects
     * @param ProjectCats $cats
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Projects $projects, ProjectCats $cats)
    {
        $this->data['projects'] = $projects->getActive();
        $this->data['cats'] = $cats->getActive();

        return view('projects.index', $this->data);
    }

    /**
     *
     * view project by id
     *
     * @param $id
     * @param Projects $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Projects $project)
    {
        $this->data['project'] = $project->getById($id);
        $this->data['bids'] = $project->getById($id)->bids;

        return view('projects.show', $this->data);
    }

    /**
     *
     * view create new project form
     *
     * @param ProjectCats $cats
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ProjectCats $cats)
    {
        $this->data['cats'] = $cats->getActive();

        return view('projects.create', $this->data);
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
            'end_date' => 'required',
            'description' => 'required|max:1000'
        ]);

        $project = new Projects;

        $project->title = $request['title'];
        $project->description = $request['description'];
        $project->end_date = $request['end_date'];
        $project->price = $request['price'];

        if (isset($request['remote'])) {
            $project->remote = $request['remote'];
        }

        $project->user_id = $request['user_id'];

        $message = $request->user()->projects()->save($project) ? 'Проект отправлен на модерацию успешно!' : 'Произошла ошыбка!';

        $cats_id = $request['cat_ids'];

        foreach ($cats_id as $cat_id) :
            $project->categories()->attach($cat_id);
        endforeach;

        // find all users
//        $users = User::all();
//
//        foreach ($users as $user) :
//            if ($user->hasRole('admin')) :
//                // send notification to all admins
//                $user->notify(new NotifyAdminsAboutNewProject($project));
//            endif;
//        endforeach;

        return redirect()->back()->with(['message' => $message]);
    }

    /**
     *
     * select freelancer to work a project
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function useFreelancer(Request $request, $id)
    {
        $freelancer = Projects::find($id);
        $freelancer->freelancer_id = $request->freelancer_id;
        $freelancer->status = $request->status;

        $message = $freelancer->save() ? 'Исполнитель выбран успешно!' : 'Произошла ошыбка!';

        return redirect()->back()->with(['message' => $message]);
    }

    /**
     *
     * project complete successful
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completed(Request $request, $id)
    {
        $freelancer = Projects::find($id);
        $freelancer->freelancer_id = $request->freelancer_id;
        $freelancer->status = $request->status;

        $message = $freelancer->save() ? 'Задание выполнено успешно!' : 'Произошла ошыбка!';

        return redirect()->back()->with(['message' => $message]);
    }

    /**
     *
     * cancel selected freelancer, project not complete
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function canceled(Request $request, $id)
    {
        $freelancer = Projects::find($id);
        $freelancer->freelancer_id = $request->freelancer_id;
        $freelancer->status = $request->status;

        $message = $freelancer->save() ? 'Задание не выполнено!' : 'Произошла ошыбка!';

        return redirect()->back()->with(['message' => $message]);
    }

    /**
     *
     * get category by slug and all project into category
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
     * activate project in admin panel
     *
     * @param $id
     * @param Projects $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateProject($id, Projects $project)
    {
        $act_project = $project->getById($id);

        $act_project->active = 1;
        $act_project->save();

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

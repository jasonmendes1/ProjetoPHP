<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class UserController extends BaseController implements ResourceControllerInterface {
        /**
     * @return mixed
     */
    public function index()
    {
        $users = User::all();
        View::make('users.index', ['users' => $users]);

    }

    /**
     * @return mixed
     */
    public function create()
    {
        View::make('users.create');
    }

    /**
     * @return mixed
     */
    public function store()
    {
        // create new resource (activerecord/model) instance
        // your form name fields must match the ones of the table fields
        $users = new Users(Post::getAll());

        if($users->is_valid()){
            $users->save();
            Redirect::toRoute('users/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('users/create', ['users' => $users]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $users = User::find($id);

        \Tracy\Debugger::barDump($users);

        if (is_null($users)) {
            // redirect to standard error page
        } else {
            View::make('users.show', ['users' => $users]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $users = User::find($id);

        if (is_null($users)) {
            // redirect to standard error page
        } else {
            View::make('users.edit', ['users' => $users]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $users = User::find($id);
        $users->update_attributes(Post::getAll());

        if($users->is_valid()){
            $users->save();
            Redirect::toRoute('users/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('users/edit', ['users' => $users], $id);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        Redirect::toRoute('users/index');
    }

}
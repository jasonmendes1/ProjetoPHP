<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Data;


class UserController extends BaseController implements ResourceControllerInterface {
    /**
     * @return mixed
     */
    public function index()
    {
        $users = User::all();
        View::make('user.index', ['user' => $users]);

    }

    /**
     * @return mixed
     */
    public function create()
    {
        View::make('user.create');
    }

    /**
     * @return mixed
     */
    public function store()
    {
        // create new resource (activerecord/model) instance
        // your form name fields must match the ones of the table fields
        $users = new User(Post::getAll());

        if($users->is_valid()){
            $users->save();
            Redirect::toRoute('user/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('user/create', ['user' => $users]);
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
            View::make('user.show', ['user' => $users]);
        } else {
            View::make('user.show', ['user' => $users]);
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
            View::make('user.edit', ['user' => $users]);
        } else {
            View::make('user.edit', ['user' => $users]);
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
            Redirect::toRoute('user/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('user/edit', ['user' => $users], $id);
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
        Redirect::toRoute('user/index');
    }

    public function Fazerlogin()
    {
        $username = Post::get('username');
        $password = Post::get('password');
        $logar = User::find_by_username_and_password($username,$password);
        Tracy\Debugger::barDump($logar);
        if(is_null($logar))
        {
           $erro ="O Username ou a Password esta incorreta
           Recuperar a Conta?";
           View::make('home.login',['erro'=>$erro] );
        }else {
            Session::set('username',$username);
            if($logar->isadmin == 1)
            {
                Redirect::toRoute('user/index');
            }
            else if($logar->blocked == 1)
            {
                echo 'Bloqueado';
            }
            else Redirect::toRoute('game/gui');
        }
    }  

    public function login()
    {
        $erro ="";
        View::make('home.login',['erro'=>$erro]);
    }
}

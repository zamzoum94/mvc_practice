<?php
    if(Session::exists("id")){
        Reddirect::to("home");
    }
    if(Input::exists("post")){
        //check existance token
        if(Token::check(Input::get("form"))){
            //Validation
            $validate = new Validation();
            $validate->check($_POST, array(
                    "username" => array(
                            "required" => true,
                            "min" => 3,
                            "max" => 20,
                            "unique" => true
                    ),
                    "password" => array(
                            "required" => true,
                            "min" => 8
                    ),
                    "full_name" => array(
                            "required" => true,
                            "min" => 3,
                            "max" => 20
                    )
            ));
            if($validate->passed()){
                //Creating a user
                $user = new User();
                $salt = Hash::salt();
                $error = $user->create(array(
                    "username" => Input::get("username"),
                    "password" => Hash::make(Input::get("password"), $salt),
                    "salt" => $salt,
                    "full_name" => Input::get("full_name"),
                    "birth_date" => Input::get("birth_date")
                ));

                if($error){
                    echo "Some error occured, please try to register again!";
                    var_dump($error);
                } else {
                    Reddirect::to("login");
                }
            } else{
                //Validation errors
                $errors = $validate->getErrors();
                foreach ($errors as $error){
                    echo $error . "<br>";
                }
            }
        }
    }
?>
<h1>Create new account</h1>
<div class="row">
    <div class="col-md-4">
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value=<?= escape(Input::get("username"))?>>
            </div>
            <div class="form-group">
                <label for="full_name">Full name</label>
                <input type="text" class="form-control" id="full_name" name="full_name"  value=<?= escape(Input::get("full_name"))?>>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="birth_date">Birth date</label>
                <input class="form-control" type="date" id="birth_date" name="birth_date" value=<?= escape(Input::get("birth_date"))?>/>
            </div>
            <input type="hidden" name="form" value=<?= Token::generate('form')?>>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="?request=login"><small class="form-text text-muted">Already have an acount?</small></a>
        </form>
    </div>  
</div>
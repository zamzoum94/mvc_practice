<?php
    if(Input::exists("post")){
        if(Token::check(Input::get("form"))){
            $validate = new Validation();
            $validate->check($_POST, array(
                "content" => array(
                    "required" => true,
                    "min" => 30
                ),
                "category" => array(
                    "required" => true
                )
            ));

            if($validate->passed()){
                $post= new Post();
                $post->create($_POST);
                Reddirect::to("home");
            } else{
                $errors = $validate->getErrors();
                foreach ($errors as $error){
                    echo $error . "<br>";
                }
            }
        }
    }
?>
<h3>Create post</h3>
<form method="POST">
    <div class="form-group">
        <label for="content">Content</label>
        <textarea type="textarea" name="content" class="form-control"></textarea>
    </div>
    <select name="category" class="custom-select">
        <option selected>Select category</option>
        <option value="drama">Drama</option>
        <option value="politics">Politics</option>
        <option value="sport">Sport</option>
    </select>
    <input type="hidden" name="form" value=<?= Token::generate("form")?>>
    <button type="submit" class="btn btn-success mt-2">Submit</button>
</form>
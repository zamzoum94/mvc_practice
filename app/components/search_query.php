<?php
    $query = new Query();
    $results = [];
    if(Input::exists("post")){
        $results = $query->getAll(Input::get("search"));
    } else{
        //$results = $query->getLast(Session::get("id"));
    }
?>

<h3>Search query</h3>
<form method="post">
    <input type="text" name="search" class="form-control" placeholder="Search a post"/>
    <button type="submit" class="btn btn-info mt-2">Search</button>
</form>

<?php if(count($results)){?>
<div class="row">
    <div class="col-md-6">Content</div>
    <div class="col-md-2">Category</div>
    <div class="col-md-2">Created at</div>
    <div class="col-md-2">Updated at</div>
</div>
<?php foreach($results as $query){?>
<div class="row">
    <div class="col-md-6"><?= $query->content?></div>
    <div class="col-md-2"><?= $query->category?></div>
    <div class="col-md-2"><?= $query->created_at?></div>
    <div class="col-md-2"><?= $query->updated_at?></div>
</div>
<?php }
} else {
    echo "No results found";
} ?>
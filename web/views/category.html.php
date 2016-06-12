<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/question.js"></script>

    <title>Category</title>
</head>
<body>
<div id="content">
    <h1><span class="font_color">Category: </span><?=$cat_name?></h1>

    <ul id="menu">
        <li><a href="/">home</a></li>
        <?php if($logged){ ?>
            <li><a href="/myquestions">myQuestions</a></li>
            <li><a href="/settings">settings</a></li>
            <li><a href="/logout">logout</a></li>
        <?php }else{ ?>
            <li><a href="<?=$uri?>">idi loginsya</a></li>
        <?php } ?>
    </ul>
    <br/>
    <br/>
    <br/>
        <form role="form" class="form-inline" style="float: right">
            <p><input type="search" class="form-control" id="inputsearch" placeholder="Search by name">
                <input type="submit" class="btn btn-default" id="namesearch" value="Find"></p>
        </form>
    <br/>
    <br/>
    <br/>

    <?php for($i = 0; $i < sizeof($experts); $i++){ ?>
        <div id="myModal_<?=$i?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Asking <?=$experts[$i]->name?></h4>
                    </div>
                    <form id="quest_form_<?=$i?>" role="form" class="form-inline formsubmitter" method="post">
                        <div class="modal-body">
                            <p><input type="text" name="expert_id" value="<?=$experts[$i]->id?>" hidden>
                            <p><input id="cat_<?=$i?>" name="category" type="text" class="form-control" value="<?=$cat_name?>" readonly></p>
                            <p><textarea id='<?=$i?>' rows="5" cols="67" name="question" class="text-area-resize"></textarea></p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <input type="submit" name="modal_submit" value="Send" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="expert-content">
        <?php for($i = 0; $i < sizeof($experts); $i+=3){ ?>
            <div class="row">
                <div class="col-lg-4 category-expert">
                    <?php if(isset($experts[$i])){ ?>
                        <div>
                            <a href=""><h4 class="text-center exp-name"><?=$experts[$i]->name?></h4></a>
                            <div class="text-center"><img class="expert-photo" src="<?=$experts[$i]->photo?>"></div>
                            <div class="cat-delimiter"></div>
                            <div class="text-center font_set category-description"><p><?=$experts[$i]->description?><p></div>
                            <div class="cat-delimiter"></div>
                            <div class="category-font"><h5>Answers: <?=$experts[$i]->count_of_ans?></h5></div>
                            <div class="category-font"><h5>Rating: <?=$experts[$i]->rating?></h5></div>
                            <div class="cat-delimiter"></div>
                            <div class="text-center" style="margin-bottom: 10px">
                                <a <?php  echo $logged? 'data-toggle="modal" data-target="#myModal_'.$i.'"' : 'href='.$uri?> type="button" class="btn btn-default">Ask</a>
                            </div>
                        </div>
                    <? } ?>
                </div>
                <div class="col-lg-4 category-expert">
                    <?php if(isset($experts[$i+1])){ ?>
                        <div>
                            <a href=""><h4 class="text-center exp-name"><?=$experts[$i+1]->name?></h4></a>
                            <div class="text-center"><img class="expert-photo" src="<?=$experts[$i+1]->photo?>"></div>
                            <div class="cat-delimiter"></div>
                            <div class="text-center font_set category-description"><p><?=$experts[$i+1]->description?><p></div>
                            <div class="cat-delimiter"></div>
                            <div class="category-font"><h5>Answers: <?=$experts[$i+1]->count_of_ans?></h5></div>
                            <div class="category-font"><h5>Rating: <?=$experts[$i+1]->rating?></h5></div>
                            <div class="cat-delimiter"></div>
                            <div class="text-center" style="margin-bottom: 10px">
                                <a <?php  echo $logged? 'data-toggle="modal" data-target="#myModal_'.($i+1).'"' : 'href='.$uri?> type="button" class="btn btn-default">Ask</a>
                            </div>
                        </div>
                    <? } ?>
                </div>
                <div class="col-lg-4 category-expert">
                    <?php if(isset($experts[$i+2])){ ?>
                        <div>
                            <a href=""><h4 class="text-center exp-name"><?=$experts[$i+2]->name?></h4></a>
                            <div class="text-center"><img class="expert-photo" src="<?=$experts[$i+2]->photo?>"></div>
                            <div class="cat-delimiter"></div>
                            <div class="text-center font_set category-description"><p><?=$experts[$i+2]->description?><p></div>
                            <div class="cat-delimiter"></div>
                            <div class="category-font"><h5>Answers: <?=$experts[$i+2]->count_of_ans?></h5></div>
                            <div class="category-font"><h5>Rating: <?=$experts[$i+2]->rating?></h5></div>
                            <div class="cat-delimiter"></div>
                            <div class="text-center" style="margin-bottom: 10px">
                                <a <?php  echo $logged? 'data-toggle="modal" data-target="#myModal_'.($i+2).'"' : 'href='.$uri?> type="button" class="btn btn-default">Ask</a>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <br/>
    <br/>

    <div id="footer">
        <p>Copyright &copy; <em>minimalistica</em> &middot; <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
    </div>

</div>
</body>
</html>
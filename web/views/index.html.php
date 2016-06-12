<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <title>Question</title>
</head>
<body>
<div id="content">
    <h1>Question</h1>

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


    <div class="post">
        <div class="details">
            <h2><a href="https://github.com/CheeBam/question" class="font_color">Short project description</a></h2>
        </div>
        <div class="body font_set proj_descr">
            <p>Develop web application that would allow anyone (The Author) to ask Expert in some fields of knowledge:</p>
            <p>- Authors can see a list of categories<br>
            - Authors can view the list of experts in a specific category<br>
            - Authors can ask an expert<br>
            - Authors should login through your Google account</p>
            <p>- Expert receives a question by email<br>
            - Expert answers the question through a unique link<br>
            - Expert doesn't login into the application<br>
            - Expert can be in several categories</p>
        </div>
        <div class="x"></div>
    </div>

        <h2 class="font_color text-center">Categories</h2>
    <br/>

    <?php for ($i = 0; $i < sizeof($all_cats); $i+=4){ ?>
        <div class="row">
            <div class="col-lg-3 index-delimiter index-cat-div">
                <?php if(isset($all_cats[$i])){?>
                    <a href="/category/<?=$all_cats[$i]->id?>"><h4 class="text-center font_color"><?=$all_cats[$i]->name?></h4></a>
                <?php } ?>
            </div>

            <div class="col-lg-3 index-delimiter index-cat-div">
                <?php if(isset($all_cats[$i+1])){?>
                    <a href="/category/<?=$all_cats[$i+1]->id?>"><h4 class="text-center font_color"><?=$all_cats[$i+1]->name?></h4></a>
                <?php } ?>
            </div>

            <div class="col-lg-3 index-delimiter index-cat-div">
                <?php if(isset($all_cats[$i+2])){?>
                    <a href="/category/<?=$all_cats[$i+2]->id?>"><h4 class="text-center font_color"><?=$all_cats[$i+2]->name?></h4></a>
                <?php } ?>
            </div>

            <div class="col-lg-3 index-cat-div">
                <?php if(isset($all_cats[$i+3])){?>
                    <a href="/category/<?=$all_cats[$i+3]->id?>"><h4 class="text-center font_color"><?=$all_cats[$i+3]->name?></h4></a>
                <?php } ?>
            </div>
        </div>
        <br/>
    <?php } ?>
    <br/>

    <div id="footer"></div>

    <h2 class="font_color text-center" style="margin-top: -7px">Top Experts</h2>
    <br/>

    <div class="row">

        <div class="col-lg-1"></div>
        <?php for($i = 0; $i < 5; $i++){ ?>
            <div class="col-lg-2 index-cat-div index-delimiter">
                <h4 class="text-center font_color"><?=$experts[$i]['name']?></h4>
                <div class="text-center"><img class="index-expert-photo" src="<?=$experts[$i]['photo']?>"></div>
                <h3 class="text-center font_color" style="font-style: oblique"><?=$experts[$i]['rating']?></h3>
            </div>
        <?php } ?>

        <div class="col-lg-1"></div>

    </div>



    <br/>
    <br/>

    <div id="footer">
        <p>Copyright &copy; <em>minimalistica</em> &middot; <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
    </div>
</div>
</body>
</html>


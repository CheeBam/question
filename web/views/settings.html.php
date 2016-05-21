<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/question.js"></script>

    <title>Question</title>
</head>
<body>
<div id="content">
    <h1>Settings<?php if(isset($name)) echo ': <span class="font_color">'.$name ?></span></h1>

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
    <br/>
    <br/>
    <br/>

    <div id="footer"></div>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form role="form" class="form-inline namechanger">
                <div class="form-group">
                    <label for="name_changer_input">Change name: </label>
                    <input type="text" class="form-control" id="name_changer_input" name='changed_name' placeholder="<?php if(isset($name)) echo $name ?>">
                </div>
                <input type="submit" class="btn btn-default" value="Change">
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>

    <br/>
    <br/>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 ">
            <?php if(!$expert){ ?>
            <div class="text-center"><button class="btn btn-success collapse-button" data-toggle="collapse" data-target="#hide">Become an Expert</button></div>
            <div id="hide" class="collapse">
                <br/>
                <form role="form" class="expecter">
                    <div class="form-group">
                        <label for="expert_name">Name</label>
                        <input type="text" class="form-control" name="expert_name" value="<?php if(isset($name)) echo $name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="expert_photo">Photo Link</label>
                        <input type="text" pattern="[^\s]+\.(?i)jpg|png|bmp$" class="form-control" name="expert_photo" id="expert_photo" required>
                    </div>
                    <div class="form-group">
                        <label for="answer">Description</label>
                        <div class="text-center"><textarea rows="5" cols="50" name="description" class="text-area-resize"></textarea></div>
                    </div>
                    <label>Choose category</label>
                    <div class="checkbox">
                        <?php foreach ($categories as $var){?>
                            <p><label><input type="checkbox" name="category[]" value="<?=$var->id?>"><?=$var->name?></label></p>
                        <?php }  ?>
                    </div>
                    <div class="text-center"><input type="submit" class="btn btn-default" value="&nbsp;&nbsp;Go&nbsp;&nbsp;"></div>
                    <div class="become-div"></div>
                </form>
            </div>
            <? } else { ?>
                <div class="text-center leave-div"><a class="leave-experts btn btn-danger">Leave from experts</a></div>
            <? } ?>
        </div>
        <div class="col-lg-3"></div>
    </div>


    <br/>
    <br/>

    <div id="footer">
        <p>Copyright &copy; <em>minimalistica</em> &middot; <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
    </div>

</div>
</body>
</html>
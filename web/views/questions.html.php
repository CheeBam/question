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
    <h1>myQuestions</h1>

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

    <?php
    $counter = 0;
    foreach($questions as $var){
        $q_number = sizeof($questions)-$counter;
        $counter++; ?>
        <div class="row">
            <div class="col-lg-12 question-panel">
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">#<?=$q_number?> [<?=$var['category_name']?>] Question from <?=$var['date']?></div>
                        <div class="panel-body"><?=$var['text']?></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Answer by <?=$var['expert_name']?></div>
                        <div class="panel-body"><?=$var['answer']?></div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h5 class="text-center">Rate Answer</h5>
                    <form id="quest_form_<?=$counter?>" role="form" class="form-inline formRadio">
                        <div class="radio-panel">
                            <div>
                                <input type="radio" id="radio5_<?=$counter?>" name="<?=$var['id']?>" value="5" <?php if(isset($var['rating']) && $var['rating'] === '5') echo 'checked';?>/>
                                <label for="radio5_<?=$counter?>" style="font-size: large"; ><span></span>&#9733;&#9733;&#9733;&#9733;&#9733;</label>
                            </div>
                            <div>
                                <input type="radio" id="radio4_<?=$counter?>" name="<?=$var['id']?>" value="4" <?php if(isset($var['rating']) && $var['rating'] === '4') echo 'checked';?>/>
                                <label for="radio4_<?=$counter?>" style="font-size: large;"><span></span>&#9733;&#9733;&#9733;&#9733;</label>
                            </div>
                            <div>
                                <input type="radio" id="radio3_<?=$counter?>" name="<?=$var['id']?>" value="3" <?php if(isset($var['rating']) && $var['rating'] === '3') echo 'checked';?>/>
                                <label for="radio3_<?=$counter?>" style="font-size: large;"><span></span>&#9733;&#9733;&#9733;</label>
                            </div>
                            <div>
                                <input type="radio" id="radio2_<?=$counter?>" name="<?=$var['id']?>" value="2" <?php if(isset($var['rating']) && $var['rating'] === '2') echo 'checked';?>/>
                                <label for="radio2_<?=$counter?>" style="font-size: large;"><span></span>&#9733;&#9733;</label>
                            </div>
                            <div>
                                <input type="radio" id="radio1_<?=$counter?>" name="<?=$var['id']?>" value="1" <?php if(isset($var['rating']) && $var['rating'] === '1') echo 'checked';?>/>
                                <label for="radio1_<?=$counter?>" style="font-size: large;"><span></span>&#9733;</label>
                            </div>
                            <div class="text-center" style="margin-top: 10px"><input type="submit" name="radio-submit" value="Rate" class="btn btn-default"></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    <? } ?>

    <br/>
    <br/>

    <div id="footer">
        <p>Copyright &copy; <em>minimalistica</em> &middot; <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
    </div>



</div>
</body>
</html>


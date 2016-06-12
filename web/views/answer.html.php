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
    <h1>Answer</h1>

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
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 answer-form">
            <form role="form" class="answer-form-js">
                <div class="form-group">
                    <label for="author_name">Author:</label>
                    <input type="text" class="form-control" name="author_name" value="<?=$author?>" readonly>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" name="category" value="<?=$category?>" readonly>
                </div>
                <div class="form-group ">
                    <label for="question">Question:</label>
                    <div class="text-center"><textarea rows="5" cols="74" name="question" class="text-area-resize" readonly><?=$question?></textarea></div>
                </div>
                <?php if(null == $answer){ ?>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <div class="text-center"><textarea rows="5" cols="74" name="answer" class="text-area-resize answer-text"></textarea></div>
                </div>
                    <div class="text-center answer-div"><button type="submit" class="btn btn-default">Submit</button></div>
                <? } else { ?>
                    <div class="form-group">
                        <label for="answer">Answer:</label>
                        <div class="text-center"><textarea rows="5" cols="74" name="answer"
                                                           class="text-area-resize" readonly><?=$answer?></textarea></div>
                    </div>
                    <div class="text-center"><h4>This question already have an answer!</h4></div>
                <? } ?>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <br/>
    <br/>

    <div id="footer">
        <p>Copyright &copy; <em>minimalistica</em> &middot; <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
    </div>

</div>
</body>
</html>
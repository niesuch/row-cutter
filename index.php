<?php
include_once 'autoloader.php';

use Lib\CutRow as CutRow;
use Lib\Constants as Constants;

$cutRow = new CutRow();
$post = $_POST;
if (!empty($post)) {
    $cutRow->setText($post['text']);
    $cutRow->setCharsInRow($post['chars_in_row']);
    $cutRow->run();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Row Cutter</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h1>Row Cutter</h1>
            <form action="/" method="post" id="form">                
                <div id="section">  
                    <div class="row">
                        <div class="column">Number of characters in row:</div>
                        <div class="column">
                            <label>
                                <input name="chars_in_row" id="chars_in_row" type="number" 
                                       min="<?php echo Constants::MIN_CHARS_IN_ROW; ?>"  
                                       value="<?php echo $cutRow->getCharsInRow(); ?>"
                                       />
                            </label>
                        </div>
                    </div> 

                    <div class="row">
                        <label>
                            <textarea name="text" id="text"><?php echo $cutRow->getText(); ?></textarea>
                        </label>
                    </div>
                </div>

                <div id="section">
                    <div class="button custom_button" onclick="submit();">Parse</div>
                </div>

                <?php if (!empty($cutRow->getParsedText())) { ?>
                    <div id="section">
                        <b>Parsed text:</b> <br/>
                        <div id="parsed-text"><?php echo $cutRow->getParsedText(); ?></div>
                    </div>

                    <div id="section">
                        <div class="button custom_button" onclick="copyClipboard();">Copy to clipboard</div>
                    </div>
                <?php } ?>				
            </form>
        </div>
    </body>
</html>
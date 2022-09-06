<?php
    include "../config/config.php";
    $word = new COM("word.application") or die("Unable to instantiate Word");
    $word->Visible = 1;
    $word->Documents->Add();

    $word->Selection->TypeText("Jovana Bosnic
                                Date of birth: 18.12.1998.
                                Languages: Serbian, English
                                Current town: Kacarevo
                                Education
                                Internet Technologies at ICT college of applied studies 2018-present
                                High school: Economic and trade schools, Pancevo 2013-2017
                                Skills\nHTML 5, CSS 3\nAdvanced CSS (SASS, LESS)\nJavaScript\nC#\nPHP\nSQL\nResponsive design\nBootstrap, Materialize\nPhotoshop");

    $path = ABSOLUTE_PATH. "/data/author.docx";                        
    $word->Documents[1]->SaveAs($path);

    $word->Quit();

    $word = null;

    $file = file_get_contents($path);
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;filename=author.docx");
    echo($file);
   
    if(file_exists($path)) {
        unlink($path);
    }
   
?>
<?php
    include "../../config/connection.php";
    include "../functions.php";

    $excel_app = new COM("Excel.application");
    $excel_app->Visible = 1;
    $excel_app->DisplayAlerts = 1;
    $Workbook = $excel_app->Workbooks->Open(ABSOLUTE_PATH."/data/rooms.xlsx");
    $Worksheet = $Workbook->Worksheets("Sheet1");
    
    $field = $Worksheet->Range("A1");
    $field->activate;	
    $field->Value = "Room id:";
    
    $field = $Worksheet->Range("B1");
    $field->activate;	
    $field->Value = "Room name:";
    
    $field = $Worksheet->Range("C1");
    $field->activate;	
    $field->Value = "Description:";	
    
    $rooms = vratiSve("rooms");
    $num = 2;

    foreach($rooms as $room){
        $field = $Worksheet->Range("A$num");
        $field->activate;	
        $field->Value = $room->id_room;
        
        $field = $Worksheet->Range("B$num");
        $field->activate;	
        $field->Value = $room->room_name;
        
        $field = $Worksheet->Range("C$num");
        $field->activate;	
        $field->Value = $room->description;	

        $num++;
    }
    
    $Workbook->_SaveAs(ABSOLUTE_PATH."/rooms.xlsx", -4143);

    $Workbook->Save();
    $Workbook->Saved = true;
    $Workbook->Close;
    
    unset($Worksheet);
    unset($Workbook);	
    
    $excel_app->Workbooks->Close();
    $excel_app->Quit();
    
    unset($excel_app);

    header("Location: ../../index.php?page=admin");
?>
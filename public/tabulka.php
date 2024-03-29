<?php
    function vygenerujZahlavieTabulky($stlpce) {
        echo '<thead class="border2-black"><tr>';
        
        foreach ($stlpce as $stlpec) {
            //$sirka = isset($column->width) ? $column->width : '';
            echo '<th class="tac border1-black p4 white bg-lightgray" style="width:'. $stlpec->width .'px">'. $stlpec->name .'</th>';
        }
        
        echo '</tr></thead>';
    }

    function vygenerujTeloTabulky($columns, $obsah, $id_tabulky) {
        echo '<tbody>';
    
        foreach($obsah as $row) {
            echo '<tr data-record-id="'. $row->id .'">';
        
            foreach($columns as $column) {
                // Overenie, či objekt má vlastnosť, pred jej použitím
                if(property_exists($row, $column->riadok)) { 
                    echo '<td class="border1-black p2 black tac">'. $row->{$column->riadok} .'</td>';
                }
                elseif ($column->name === "Nastavenia" || $column->name === "Settings") {
                    if ($id_tabulky === "sprava-uzivatelov-tabulka") {
                        echo '<td class="border1-black tac"><a href="#" class="upravUzivatela hover mr2 p1" data-record-id="'.$row->id.'"><i class="fa-solid fa-user-pen fsz20"></i></a><a href="#" class="vymazUzivatela hover p1" data-record-id="'.$row->id.'"><i class="fa-solid fa-user-xmark fsz20"></i></a></td>';
                    }
                }
                else {
                    // Ak vlastnosť neexistuje, vytvorte prázdny stĺpec
                    echo '<td class="border1-black"></td>';
                }
                
            }
            echo '</tr>';
        }

        echo '</tbody>';
    }

    function vygenerujTabulku($id_tabulky, $stlpce, $obsah) {
        echo '<table id="'. $id_tabulky .'" class="border2-black">';

        vygenerujZahlavieTabulky($stlpce);
        vygenerujTeloTabulky($stlpce, $obsah, $id_tabulky);

        echo '</table>';
    }
?>
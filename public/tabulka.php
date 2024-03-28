<?php
    function vygenerujZahlavieTabulky($stlpce) {
        echo '<thead class="border2-black"><tr>';
        
        foreach ($stlpce as $stlpec) {
            //$sirka = isset($column->width) ? $column->width : '';
            echo '<th class="tac border1-black p4 white bg-lightgray" style="width:'. $stlpec->width .'px">'. $stlpec->name .'</th>';
        }
        
        echo '</tr></thead>';
    }

    function vygenerujTeloTabulky($columns, $obsah) {
        echo '<tbody>';

        foreach($obsah as $row) {
            echo '<tr data-record-id="'. $row->id .'">';
        
            foreach($columns as $column) {
                // Overenie, či objekt má vlastnosť, pred jej použitím
                if(property_exists($row, $column->riadok)) { 
                    echo '<td class="border1-black p2 black tac">'. $row->{$column->riadok} .'</td>';
                }
                elseif ($column->name === "Nastavenia" || $column->name === "Settings") {
                    $id_osoby = $row->id;
                    echo '<td class="border1-black tac">
                        <a href="#" class="hover mr2 p1" data-record-id="'.$id_osoby.'"><img src="user-edit.svg" class="w25" title="' . __('Upraviť') . '" alt="Edit"/></a>
                        <a href="#" class="vymazVykaz hover p1" data-record-id="'.$id_osoby.'"><img src="user-x.svg" class="w25" title="' . __('Vymazať') . '" alt="Delete"/></a>
                        </td>';
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
        vygenerujTeloTabulky($stlpce, $obsah);

        echo '</table>';
    }
?>
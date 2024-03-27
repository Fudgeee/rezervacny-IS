<!-- ADMINISTRATION -->
<?php 
    @include(public_path('tabulka.php'));

    $rolaTmp = include(public_path('nastavenia.php'));
    $rola = [];
    foreach ($rolaTmp['rola'] as $key => $value) {
        $rola[$key] = __($value);
    }

    $id_tabulky = 'sprava-uzivatelov-tabulka';

    class TableColumn {
        public $name;
        public $width;
        public $riadok;
    
        public function __construct($name, $width, $riadok) {
            $this->name = $name;
            $this->width = $width;
            $this->riadok = $riadok;
        }
    }

    $stlpce = [
        //nazov stlca, sirka stlpca, udaj z DB, centrovanie textu v hlavicke, filtrovanie
        new TableColumn(__('Meno'), 120, 'meno'),
        new TableColumn(__('Priezvisko'), 120, 'priezvisko'),
        new TableColumn(__('E-mail'), 220, 'email'),
        new TableColumn(__('Telefón'), 160, 'telefon'),
        new TableColumn(__('Rola'), 160, 'rola'),
        new TableColumn(__('Nastavenia'), 160, ''),
    ];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.5/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script>
    $(document).ready(function () {

        var table = $('#sprava-uzivatelov-tabulka').DataTable({
            dom: 'Blrftip',
            orderCellsTop: true,
            colReorder: true, // Povolí preťahovánie stlpcov
            lengthMenu: [5, 10, 25, 50, 100],
            language: {
                lengthMenu: '{{ __("Zobrazit _MENU_ položek") }}',
                info: '{{__("Zobrazuje se _START_ až _END_ z _TOTAL_ záznamů")}}',
                paginate: {
                    previous: "<",
                    next: ">"
                }
            },
            columnDefs: [{ 
                orderable: false, // Nastavenie, že stlpec nebude raditeľný
                targets: 5 // Index sltpca (počítanie od 0)
            }],
            buttons: [
                {
                extend: 'colvis', // Zobrazenie vybranych stlpcou
                text: '{{__("výběr zobrazených sloupců")}} '
            }]
        });



        var sortingState = []; // Uchovává stav radenia pre každý stlpec

        $('#sprava-uzivatelov-tabulka thead th').each(function (index) {
            $(this).append('<span class="sorting-status" style="float:right"></span>'); // Pridanie miesta pre popis stavu radenia
        });

        sortingState[0] = 'asc'; // Nastavenie predvoleného radenia pre prvý stĺpec

        $('#sprava-uzivatelov-tabulka thead th').on('click', function () {
            var columnIndex = $(this).index();
            var column = table.column(columnIndex);
            
            // Získanie aktuálneho stavu radenia pre tento stlpec
            var currentOrder = sortingState[columnIndex] || ''; // Pokud stav neni definovaný, použije sa prázdný reťazec

            // Nastavenie radenia pre tento stlpec
            if (currentOrder === '') {
                currentOrder = 'asc'; // Pokud je stav prázdný, nastavíme radenie na vzostupné
            } else if (currentOrder === 'asc') {
                currentOrder = 'desc'; // Pokud je stav vzostupný, nastavíme radenie na zostupné
            } else {
                currentOrder = ''; // Pokud je stav zostupný, vypneme radenie
            }

            sortingState[columnIndex] = currentOrder;

            // Vytvorenie pola s nastavením radenia pre všechny stlpce
            var orderArray = [];
            for (var i = 0; i < sortingState.length; i++) {
                if (sortingState[i]) {
                    orderArray.push([i, sortingState[i]]);
                }
            }

            // Radenie podla viacerých stlpcov
            table.order(orderArray).draw();
        });



        function replaceRolaText() {
            var rola = {!! json_encode($rola) !!};

            $('thead tr th').filter(function() {
                return $(this).text().trim() === 'Rola'; // Nájdenie th s textom "Rola"
            }).each(function() {
                var indexRola = $(this).index(); // Index stĺpca s rolou
                $('#sprava-uzivatelov-tabulka tbody tr').each(function() {
                    var cisloRole = $(this).find('td:eq(' + indexRola + ')').text(); // Číslo role
                    var textRole = rola[cisloRole]; // Text role
                    $(this).find('td:eq(' + indexRola + ')').text(textRole); // Nahraďte číslo role textovou hodnotou
                });
            });
        }

        // Zavolajte funkciu na nahradenie textu po načítaní nových údajov
        $('#sprava-uzivatelov-tabulka').on('draw.dt', function() {
            replaceRolaText();
        });

        // Počiatočné nahradenie textu
        replaceRolaText();
        
    });
</script>
@extends('layout')
@section('content')
<div class="container">
    <div class="administration-page">
        <h1 class="white">{{__('Správa užívatelov')}}</h1>
        <div class="medzera"></div>
        <?php echo vygenerujTabulku($id_tabulky, $stlpce, $barbers);?>
    </div>
</div>
@endsection
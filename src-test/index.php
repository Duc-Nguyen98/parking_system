<!DOCTYPE html>
<html>

<head>
    <title>Ajax Select Option</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <h2>Select an option:</h2>
    <select id="opStatus">
    </select>
    <select id="opEntries">
    </select>
    <select id="opParkingArena">
    </select>

    <br><br>
    <div id="result"></div>
    <script>
        $(document).ready(function() {

            //load option status
            loadStatus();

            function loadStatus() {
                $.ajax({
                    type: "POST",
                    url: "load_option_status.php",
                    success: function(opStatus) {
                        $("#opStatus").html(opStatus);
                    }
                });
            }

            loadEntries();

            function loadEntries() {
                $.ajax({
                    type: "POST",
                    url: "value_show_entries.php",
                    success: function(opEntries) {
                        $("#opEntries").html(opEntries);
                    }
                });
            }

            loadParkingArena();

            function loadParkingArena() {
                $.ajax({
                    type: "POST",
                    url: "load_option_parking_arena.php",
                    success: function(opParkingArena) {
                        $("#opParkingArena").html(opParkingArena);
                    }
                });
            }

            //!Handle action select option all

            $("#opStatus, #opEntries, #opParkingArena").change(function() {
                var opStatus = $("#opStatus").val();
                var opEntries = $("#opEntries").val();
                var opParkingArena = $("#opParkingArena").val();

                if (opStatus === '') {
                    loadTable();
                } else {
                    loadTable(opStatus, opEntries, opParkingArena);
                }
            });

            // load table 
            loadTable();

            function loadTable(opStatus = 0, opEntries = 10, opParkingArena  = 0 ) {
                console.log(` ${opStatus} - ${opEntries} - ${opParkingArena}`)
                $.ajax({
                    type: "POST",
                    url: "load_table.php",
                    data: {
                        opStatus: opStatus,
                        opEntries: opEntries,
                        opParkingArena: opParkingArena ,
                    },
                    success: function(result) {
                        $("#result").html(result);
                    }
                });
            }





            //load show entries


        });
    </script>
</body>

</html>
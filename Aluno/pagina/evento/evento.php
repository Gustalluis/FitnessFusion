<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logoFitnessvazio.svg" type="image/svg+xml">
    <title>CALENDARIO - ACADEMIA FITNESS FUSION</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main>
        <div id="calendar"></div>
    </main>
    <script>
        $(document).ready(function() {
            let eventos = <?php echo json_encode($eventos); ?>;

            $("#calendar").evoCalendar({
                theme: "Midnight Blue",
                language: "pt",
                format: "dd MM, yyyy",
                titleFormat: "MM",
                todayHighlight: true,
                sidebarDisplayDefault: false,
                eventDisplayDefault: true,
                eventListToggler: true,
                calendarEvents: eventos,
            });
        });
    </script>
    <script src="js/animaDash.js"></script>

</body>

</html>
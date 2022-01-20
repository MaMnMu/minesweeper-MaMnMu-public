// Runs when any cell in the board is clicked

function checkPosition(e) {
    if ((e.target.nodeName === 'TD') && (e.target.childElementCount === 0)) { // Checks if the cell is empty
        var box = e.target; // Extracts the table cell DOM object from the event
        $.ajax({// Sends the Ajax Request
            type: 'POST', // Type POST
            url: 'index.php', // to index.php script
            dataType: "json", // Data coded sent in JSON
            data: {// Coordinates sent to the server
                x: box.dataset.x,
                y: box.dataset.y
            },
            success: function (result) { // When the server response arrives correctly
                console.log(result);
                if (result.descub !== undefined) { // Si la respuesta JSON tiene la propiedad descub definida
                    for (var i = 0; i < result.descub.length; i++) { // Como la propiedad descub es un array que puede traer varias coordenadas de celdas desveladas lo recorremos
                        $(`#${result.descub[i][0]}${result.descub[i][1]}`).css("background-color", "lightblue"); // Cambiamos el fondo de las celdas descubiertas
                        switch (result.descub[i][2]) { // result.descub[i][2] representa el valor asociado a la celda (0,1,2,...,9)
                            case 0:
                                $(`#${result.descub[i][0]}${result.descub[i][1]}`).html();
                                break; // Si el valor es 0 dejamos la casilla vacia
                            case 9:
                                $(`#${result.descub[i][0]}${result.descub[i][1]}`).html(`<img src=${box.dataset.imgpath}>`);
                                break; // Si es 9 colocamos la imagen de una bomba
                            default:
                                $(`#${result.descub[i][0]}${result.descub[i][1]}`).html(result.descub[i][2]); // Y sino, añadimos el valor que trae desde el servidor
                        }
                    }
                }
                if (result.gameRes !== undefined) { // If the response info has a gameRes property
                    switch (result.gameRes) {
                        case 1: // If the value is 1 show You Win!!
                            $("#message").text("FLAWLESS VICTORY!!");
                            $("body").css("background-color", "lightgreen");
                            $("#myaudio").html(`<source src=${$("#myaudio").data("winaudiopath")}>`);
                            break;
                        case - 1: // If the value is 1 show You lost!!
                            $("#message").text("FATALITY!!");
                            $("body").css("background-color", "#ff7a7a");
                            $("#myaudio").html(`<source src=${$("#myaudio").data("loseaudiopath")}>`);
                            break;
                    }
                    $('table').unbind('click'); // Removes the event handler on the table
                }
            },
            error: function (xhr, status, error) { // If the ajax communication failed
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert('Error - ' + errorMessage); // Show an alert
            }
        });
    }
}
;

// Establish a handler to run when the DOM is loaded. 

$(document).ready(function () {
    $('table').click(checkPosition); // Establish a handler to run on all elements components of table
});

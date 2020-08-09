function printBarcode(value) {

    console.log($('#barcode'))
    var elem = 'parent-div';
    
    JsBarcode("#barcode", value);

    var uSvg = document.getElementById('barcode');
    
    var src = 'data:image/svg+xml;base64,' + window.btoa(uSvg.outerHTML);
    
    $('#ready-img').attr('src', src);

    var mywindow = window.open('', 'PRINT');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
	mywindow.focus(); // necessary for IE >= 10*/
	setTimeout(function() {
		mywindow.print();
		mywindow.close();
	});
}

function init() {
    var parentDiv = $('<div>').attr('id', 'parent-div').css({ display: 'none'})
    var img = $('<img>').attr('id', 'ready-img');
    parentDiv.append(img);
    var jsScript = $('<script>').attr('src', 'https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js');
    $('body').append(jsScript).append(parentDiv);


    let divDOM = document.getElementsByTagName("body")[0];
    let svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.id = "barcode";
    svg.style.display = "none";
    divDOM.appendChild(svg);

}

function printTicket(codigo) {

    /*if(data.productos) {
        data.productos = JSON.parse(data.productos);
    }
    console.log(data);*/


    var mywindow = window.open('vistas/modulos/print-ticket.php?codigo='+codigo, 'PRINT');

    /*mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('Hello World');
    //mywindow.document.write("<table><thead><tr><td>Cant.</td><td>Articulo</td><td>Precio</td><td>Importe</td></tr></thead></table>");
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10*/
	mywindow.focus(); // necessary for IE >= 10*/
	setTimeout(function() {
		mywindow.print();
		mywindow.close();
        window.location = "crear-venta";
	});
}

function printTicketApartado(idApartado) 
{
    var mywindow = window.open('vistas/modulos/print-ticketApartado.php?idApartado='+idApartado, 'PRINT');
    mywindow.focus(); 
    setTimeout(function() {
        mywindow.print();
        mywindow.close();
        window.location = "apartados";
    });
}

$(function() {
    init();

    $(document).on('click', '.btnPrintCode', function() {
        var code = $(this).attr('code');
        if(code) {
            printBarcode(code);
        }
    });
});
var datosColor = [];
var coloresFinales = [];

function colores() {
        var canvas = document.getElementById("CLogo");
        var ctx = canvas.getContext("2d");
        var img=new Image();

        datosColor.push({
                color: '#000000',
                cantidad: 1
        });

        for(let i = 1; i<=300; i++) {
                for (let x = 1; x<=100; x++) {
                        let rgb = ctx.getImageData(i, x, 1, 1).data; //<-- un pixel en las coordenadas  5 y 5

                        let color = ConvertRGBtoHex(rgb[0],rgb[1],rgb[2]);
                        
                        let res = buscaColor(color);
                        if(typeof res === 'undefined') {
                                datosColor.push({
                                        color: color,
                                        cantidad: 1
                                })
                        }
                        else {
                                datosColor[res].cantidad = datosColor[res].cantidad + 1;
                        }
                } 
        }

        for(let i = 1; i <= 5; i++) {
                let index = buscarMasAlto();
                let color = datosColor[index].color;
                coloresFinales.push(color);
                datosColor.splice(index,1);
        }

        //console.log(coloresFinales);
        document.getElementById("col1").style.backgroundColor = coloresFinales[1];
        document.getElementById("col2").style.backgroundColor = coloresFinales[2];
        document.getElementById("col3").style.backgroundColor = coloresFinales[3];
        document.getElementById("col4").style.backgroundColor = coloresFinales[4];
}

function ColorToHex(color) {
        var hexadecimal = color.toString(16);
        return hexadecimal.length == 1 ? "0" + hexadecimal : hexadecimal;

}

function ConvertRGBtoHex(red, green, blue) {
        return "#" + ColorToHex(red) + ColorToHex(green) + ColorToHex(blue);
}

function buscaColor(color) {
        let indice;
        let datos = datosColor;
        for(let i = 0; i < datos.length; i++) {
                if(datos[i].color == color){
                        return i;
                }
                else {
                }
        }
        return indice;
}

function buscarMasAlto() {
        let cant = 0;
        let index;
        for(let i = 0; i < datosColor.length; i++) {
                if(datosColor[i].cantidad > cant) {
                        cant = datosColor[i].cantidad;
                        index = i;
                }
        }

        return index;
}

